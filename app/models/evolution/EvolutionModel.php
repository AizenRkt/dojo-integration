<?php

namespace app\models;

use PDO;
use PDOException;
use Exception;
// use Flight;

class EvolutionModel {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getElevesAvecEtoile() {
        try {
            $sql = "SELECT e.*, ev.* 
            FROM eleve e
            JOIN evolution ev ON e.id_eleve = ev.id_eleve
            JOIN (
                SELECT id_eleve, MAX(date_evolution) as max_date
                FROM evolution
                GROUP BY id_eleve
            ) latest ON ev.id_eleve = latest.id_eleve AND ev.date_evolution = latest.max_date";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function insertEvolution($params) {
        try {
            $sql = "INSERT INTO evolution(id_prof,id_eleve,avis,note,date_evolution) VALUES (?,?,?,?,NOW())";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$params['prof'], $params['eleve'], $params['avis'], $params['note']]);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function updateEvolution($prof, $params) {
        try {
            $sql = "UPDATE evolution SET id_prof = ?, avis = ?, note = ? WHERE id_evolution = ? ";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([$prof, $params['avis'], $params['note'], $params['evolution']]);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getEvolutionById($id) {
        try {
            $sql = "SELECT * FROM evolution WHERE id_evolution = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function deleteEvolution($id) {
        try {
            $sql = "DELETE FROM evolution WHERE id_evolution = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute(['id' => $id]);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getEleveById($id) {
        try {
            $sql = "SELECT * FROM eleve WHERE id_eleve = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getHistoriqueEleve($id) {
        try {
            $sql = "SELECT id_evolution, evolution.id_prof as prof, evolution.id_eleve as eleve, eleve.nom as enom, eleve.prenom as epnom, prof.nom as pnom, prof.prenom as ppnom, date_evolution, avis, note
             FROM evolution JOIN eleve ON eleve.id_eleve = evolution.id_eleve JOIN prof ON prof.id_prof = evolution.id_prof WHERE evolution.id_eleve = ? ORDER BY date_evolution DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getGlobalEvolutionStats($year = null) {
        try {
            // Si aucune année n'est spécifiée, on prend la plus récente
            if (!$year) {
                $year = $this->getMostRecentYear();
            }
    
            // Requête pour récupérer les données existantes
            $sql = "SELECT 
                        EXTRACT(YEAR FROM date_evolution) as year,
                        EXTRACT(MONTH FROM date_evolution) as month,
                        AVG(note) as avg_note,
                        COUNT(DISTINCT id_eleve) as student_count,
                        COUNT(*) as evaluation_count
                    FROM evolution
                    WHERE EXTRACT(YEAR FROM date_evolution) = ?
                    GROUP BY year, month
                    ORDER BY month";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$year]);
            $existingData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            // Créer un tableau complet pour les 12 mois
            $completeData = [];
            for ($month = 1; $month <= 12; $month++) {
                $found = false;
                foreach ($existingData as $data) {
                    if ($data['month'] == $month) {
                        $completeData[] = $data;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $completeData[] = [
                        'year' => $year,
                        'month' => $month,
                        'avg_note' => null,
                        'student_count' => 0,
                        'evaluation_count' => 0
                    ];
                }
            }
    
            return $completeData;
            
        } catch (PDOException $e) {
            error_log("Erreur dans getGlobalEvolutionStats: " . $e->getMessage());
            return [];
        }
    }
    
    public function getMostRecentYear() {
        try {
            $sql = "SELECT EXTRACT(YEAR FROM date_evolution) as year
                    FROM evolution
                    ORDER BY date_evolution DESC
                    LIMIT 1";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchColumn();
            
        } catch (PDOException $e) {
            error_log("Erreur dans getMostRecentYear: " . $e->getMessage());
            return date('Y'); // Retourne l'année courante si erreur
        }
    }
    
    public function getAvailableYearsGlobal() {
        try {
            $sql = "SELECT DISTINCT EXTRACT(YEAR FROM date_evolution) as year
                    FROM evolution
                    ORDER BY year DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            
        } catch (PDOException $e) {
            error_log("Erreur dans getAvailableYearsGlobal: " . $e->getMessage());
            return [date('Y')];
        }
    }

    // public function getMoyenneMensuelle($annee) {
    //     $query = "
    //         SELECT 
    //             EXTRACT(MONTH FROM date_evolution) AS mois,
    //             AVG(note) AS moyenne,
    //             COUNT(id_evolution) AS nb_evaluations
    //         FROM evolution
    //         WHERE EXTRACT(YEAR FROM date_evolution) = :annee
    //         GROUP BY EXTRACT(MONTH FROM date_evolution)
    //         ORDER BY mois
    //     ";

    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute([':annee' => $annee]);
    //     $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //     // Créer un tableau complet pour les 12 mois
    //     $stats = [];
    //     for ($mois = 1; $mois <= 12; $mois++) {
    //         $stats[$mois] = [
    //             'moyenne' => 0,
    //             'nb_evaluations' => 0,
    //             'mois_nom' => $this->getNomMois($mois)
    //         ];
    //     }

    //     // Remplir avec les données existantes
    //     foreach ($resultats as $row) {
    //         $mois = (int)$row['mois'];
    //         $stats[$mois] = [
    //             'moyenne' => round((float)$row['moyenne'], 2),
    //             'nb_evaluations' => (int)$row['nb_evaluations'],
    //             'mois_nom' => $this->getNomMois($mois)
    //         ];
    //     }

    //     return $stats;
    // }

    // private function getNomMois($mois) {
    //     $mois_noms = [
    //         1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
    //         5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
    //         9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
    //     ];
    //     return $mois_noms[$mois] ?? '';
    // }
   
}
    
?>
