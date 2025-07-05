<?php

namespace app\models\individu;

use PDO;
use Flight;

class ProfModel {
    public function insert($nom, $prenom, $date_naissance, $adresse, $contact, $id_genre) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO prof (nom, prenom, date_naissance, adresse, contact, id_genre) VALUES (:nom, :prenom, :date_naissance, :adresse, :contact, :id_genre)");
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':date_naissance' => $date_naissance,
                ':adresse' => $adresse,
                ':contact' => $contact,
                ':id_genre' => $id_genre
            ]);
            return "Insertion réussie !";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function update($id, $nom, $prenom, $date_naissance, $adresse, $contact, $id_genre) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("UPDATE prof SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, adresse = :adresse, contact = :contact, id_genre = :id_genre WHERE id_prof = :id");
            $stmt->execute([
                ':id' => $id,
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':date_naissance' => $date_naissance,
                ':adresse' => $adresse,
                ':contact' => $contact,
                ':id_genre' => $id_genre
            ]);
            return "Mise à jour réussie !";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getAll() {
        $db = Flight::db();
        $sql = "SELECT 
                    id_prof as id, 
                    nom, 
                    prenom, 
                    TO_CHAR(date_naissance, 'YYYY-MM-DD') as date_naissance,
                    adresse, 
                    contact, 
                    id_genre, 
                    'professeur' as type,
                    prenom as firstName,
                    nom as lastName,
                    adresse as address,
                    id_genre as gender
                FROM prof 
                ORDER BY nom, prenom";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_prof) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM prof WHERE id_prof = :id_prof");
            $stmt->execute([':id_prof' => $id_prof]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }


    public function delete($id_prof) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("DELETE FROM prof WHERE id_prof = :id_prof");
            $stmt->execute([':id_prof' => $id_prof]);
            return $stmt->rowCount() > 0 ? "Suppression réussie." : "Aucun prof trouvé.";
        } catch (\PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }
    }
}

