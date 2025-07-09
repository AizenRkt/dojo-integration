<?php

namespace app\models\individu;

use PDO;
use Flight;

class EleveModel {
    public function insert($nom, $prenom, $date_naissance, $adresse, $contact, $date_inscription, $id_genre) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO eleve (nom, prenom, date_naissance, adresse, contact, date_inscription, id_genre) VALUES (:nom, :prenom, :date_naissance, :adresse, :contact, :date_inscription, :id_genre)");
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':date_naissance' => $date_naissance,
                ':adresse' => $adresse,
                ':contact' => $contact,
                ':date_inscription' => $date_inscription,
                ':id_genre' => $id_genre
            ]);
            return "Insertion réussie !";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getAll() {
        try {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM eleve");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getById($id_eleve) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM eleve WHERE id_eleve = :id_eleve");
            $stmt->execute([':id_eleve' => $id_eleve]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function update($id_eleve, $nom, $prenom, $date_naissance, $adresse, $contact, $date_inscription, $id_genre) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("UPDATE eleve SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance, adresse = :adresse, contact = :contact, date_inscription = :date_inscription, id_genre = :id_genre WHERE id_eleve = :id_eleve");
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':date_naissance' => $date_naissance,
                ':adresse' => $adresse,
                ':contact' => $contact,
                ':date_inscription' => $date_inscription,
                ':id_genre' => $id_genre,
                ':id_eleve' => $id_eleve
            ]);
            return $stmt->rowCount() > 0 ? "Mise à jour réussie." : "Aucune modification effectuée.";
        } catch (\PDOException $e) {
            return "Erreur de mise à jour : " . $e->getMessage();
        }
    }

    public function delete($id_eleve) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("DELETE FROM eleve WHERE id_eleve = :id_eleve");
            $stmt->execute([':id_eleve' => $id_eleve]);
            return $stmt->rowCount() > 0 ? "Suppression réussie." : "Aucun élève trouvé.";
        } catch (\PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }
    }
    public function getWithParents() {
        try {
            $db = Flight::db();
            $stmt = $db->query("
                SELECT e.*, g.label as genre_label 
                FROM eleve e 
                LEFT JOIN genre g ON e.id_genre = g.id_genre 
                ORDER BY e.nom, e.prenom
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getByIdWithParents($id_eleve) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("
                SELECT e.*, g.label as genre_label 
                FROM eleve e 
                LEFT JOIN genre g ON e.id_genre = g.id_genre 
                WHERE e.id_eleve = :id_eleve
            ");
            $stmt->execute([':id_eleve' => $id_eleve]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function getParentsByEleveId($id_eleve) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("
                SELECT p.* 
                FROM parent p 
                JOIN parent_eleve pe ON p.id_parent = pe.id_parent 
                WHERE pe.id_eleve = :id_eleve
            ");
            $stmt->execute([':id_eleve' => $id_eleve]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function associateParent($id_eleve, $id_parent) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO parent_eleve (id_eleve, id_parent) VALUES (:id_eleve, :id_parent)");
            $stmt->execute([':id_eleve' => $id_eleve, ':id_parent' => $id_parent]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function countByGenre() {
        try {
            $sql = "SELECT g.label, COUNT(*) AS total
                    FROM eleve e
                    JOIN genre g ON e.id_genre = g.id_genre
                    GROUP BY g.label";
            $db = Flight::db();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function countByAgeRangeAndGenre() {
        try {
            $sql = "
                SELECT
                    g.label AS genre,
                    CASE
                        WHEN age < 10 THEN '0-10'
                        WHEN age BETWEEN 10 AND 12 THEN '10-12'
                        WHEN age BETWEEN 16 AND 18 THEN '16-18'
                        WHEN age BETWEEN 20 AND 30 THEN '20-30'
                        WHEN age BETWEEN 30 AND 40 THEN '30-40'
                        WHEN age BETWEEN 40 AND 60 THEN '40-60'
                        ELSE '60+'
                    END AS age_range,
                    COUNT(*) AS total
                FROM (
                    SELECT id_genre, DATE_PART('year', AGE(date_naissance)) AS age
                    FROM eleve
                ) AS sub
                JOIN genre g ON sub.id_genre = g.id_genre
                GROUP BY age_range, g.label
                ORDER BY age_range, g.label;
            ";
            $db = Flight::db();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }
}

