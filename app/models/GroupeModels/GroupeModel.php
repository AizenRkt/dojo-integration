<?php

namespace app\models\GroupeModels;

use app\models\GroupeModels\HoraireModel;

use PDO;
use Flight;

class GroupeModel {

    public function insert($nom_responsable, $contact, $nombre, $discipline) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO club_groupe (nom_responsable, contact, nombre, discipline) VALUES (:nom_responsable, :contact, :nombre, :discipline)");
            $stmt->execute([
                ':nom_responsable' => $nom_responsable,
                ':contact' => $contact,
                ':nombre' => $nombre,
                'discipline' => $discipline
            ]);
            return "Insertion réussie !";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getAll() {
        try {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM club_groupe");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getById($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM club_groupe WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function delete($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("DELETE FROM club_groupe WHERE id = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->rowCount() > 0 ? "Suppression réussie." : "Aucun groupe trouvé.";
        } catch (\PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }
    }

    public function update($id, $nom_responsable, $contact, $nombre, $discipline) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("UPDATE club_groupe SET nom_responsable = :nom_responsable, contact = :contact, nombre = :nombre, discipline = :discipline WHERE id = :id");
            $stmt->execute([
                ':nom_responsable' => $nom_responsable,
                ':contact' => $contact,
                ':nombre' => $nombre,
                ':id' => $id,
                ':discipline' => $discipline
            ]);
            return $stmt->rowCount() > 0 ? "Mise à jour réussie." : "Aucune modification effectuée.";
        } catch (\PDOException $e) {
            return "Erreur de mise à jour : " . $e->getMessage();
        }
    }
}
