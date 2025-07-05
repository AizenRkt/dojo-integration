<?php

namespace app\models\individu;

use PDO;
use Flight;

class SuperviseurModel {
    public function insert($nom, $prenom, $date_naissance, $adresse, $contact, $id_genre) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO superviseur (nom, prenom, date_naissance, adresse, contact, id_genre) VALUES (:nom, :prenom, :date_naissance, :adresse, :contact, :id_genre)");
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
            $stmt = $db->prepare("UPDATE superviseur SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, adresse = :adresse, contact = :contact, id_genre = :id_genre WHERE id_superviseur = :id");
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
                    id_superviseur as id, 
                    nom, 
                    prenom, 
                    TO_CHAR(date_naissance, 'YYYY-MM-DD') as date_naissance,
                    adresse, 
                    contact, 
                    id_genre, 
                    'superviseur' as type,
                    prenom as firstName,
                    nom as lastName,
                    adresse as address,
                    id_genre as gender
                FROM superviseur 
                ORDER BY nom, prenom";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_superviseur) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM superviseur WHERE id_superviseur = :id_superviseur");
            $stmt->execute([':id_superviseur' => $id_superviseur]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }


    public function delete($id_superviseur) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("DELETE FROM superviseur WHERE id_superviseur = :id_superviseur");
            $stmt->execute([':id_superviseur' => $id_superviseur]);
            return $stmt->rowCount() > 0 ? "Suppression réussie." : "Aucun superviseur trouvé.";
        } catch (\PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }
    }
}

