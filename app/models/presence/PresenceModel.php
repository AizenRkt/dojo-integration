<?php

namespace app\models\presence;

use PDO;

class PresenceModel
{
    private $db;
    private $table = 'presence';
    private $primaryKey = 'id_presence';

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table}";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function insert(array $data) {
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ":$col", $columns);
        $sql = "INSERT INTO {$this->table} (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, array $data) {
        $setPart = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $sql = "UPDATE {$this->table} SET $setPart WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function getBySeance($id_seances) {
        $sql = "SELECT * FROM {$this->table} WHERE id_seances = :id_seances";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_seances' => $id_seances]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //maka eleves absents entre deux dates
    public function getAbsentByDate($date_debut, $date_fin) {
        $sql = "SELECT DISTINCT 
                            e.nom,
                            e.prenom,
                            COUNT(p.id_presence) AS nb_absences  
                        FROM presence AS p 
                        JOIN eleve AS e ON p.id_eleve = e.id_eleve
                        AND p.id_seances IN (
                            SELECT id_seances 
                            FROM seances_cours 
                            WHERE date BETWEEN :date_debut AND :date_fin
                        ) GROUP BY e.nom, e.prenom";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //maka ireo presents entre deux dates
    public function getPresentByDate($date_debut, $date_fin) {
        $sql = "SELECT DISTINCT id_eleve 
                FROM {$this->table} 
                WHERE present = TRUE 
                AND id_seances IN (
                    SELECT id_seances FROM seances_cours WHERE date BETWEEN :date_debut AND :date_fin
                )";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function getAbsencesByEleve($id_eleve) {
        $sql = "SELECT * FROM {$this->table} WHERE id_eleve = :id_eleve AND present = FALSE";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_eleve' => $id_eleve]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function annulationPossible($id_seances) {
        $sql = "SELECT date, heure_debut FROM seances_cours WHERE id_seances = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id_seances]);
        $seance = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$seance) return false;
        $now = new \DateTime();
        $seanceDateTime = new \DateTime($seance['date'] . ' ' . $seance['heure_debut']);
        return $now < $seanceDateTime;
    }
    public function getAbsencesEleves() {
        $sql = "
        SELECT 
            e.id_eleve,
            e.nom,
            e.prenom,
            COUNT(CASE WHEN p.present = FALSE THEN 1 END) AS nb_absences
        FROM eleve AS e
        LEFT JOIN presence AS p ON p.id_eleve = e.id_eleve
        GROUP BY e.id_eleve, e.nom, e.prenom
        ORDER BY nb_absences DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAbsenceDetailsForStudent($idEleve, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT 
                sc.date,
                c.label AS cours,
                p.remarque
            FROM 
                presence p
            JOIN 
                seances_cours sc ON p.id_seances = sc.id_seances
            JOIN 
                cours c ON sc.id_cours = c.id_cours
            WHERE 
                p.id_eleve = :id_eleve
                AND p.present = false
        ";

        $params = ['id_eleve' => $idEleve];

        if ($dateDebut && $dateFin) {
            $sql .= " AND sc.date BETWEEN :date_debut AND :date_fin";
            $params['date_debut'] = $dateDebut;
            $params['date_fin'] = $dateFin;
        }

        $sql .= " ORDER BY sc.date";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

