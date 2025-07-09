<?php
namespace app\models\EcolageModel;

use Flight;
use PDO;

class EcolageModel {

    public function insert($id_eleve, $montant, $date_paiement, $mois, $annee, $statut = 'non paye') {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO ecolage (id_eleve, montant, date_paiement, mois, annee, statut)
                                  VALUES (:id_eleve, :montant, :date_paiement, :mois, :annee, :statut)");
            $stmt->execute([
                ':id_eleve' => $id_eleve,
                ':montant' => $montant,
                ':date_paiement' => $date_paiement,
                ':mois' => $mois,
                ':annee' => $annee,
                ':statut' => $statut
            ]);
            return "Écolage inséré avec succès.";
        } catch (\PDOException $e) {
            return "Erreur d'insertion : " . $e->getMessage();
        }
    }

    public function getAll() {
        try {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM ecolage ORDER BY annee DESC, mois DESC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getById($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM ecolage WHERE id_ecolage = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function getByEleve($id_eleve) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM ecolage WHERE id_eleve = ? ORDER BY annee DESC, mois DESC");
            $stmt->execute([$id_eleve]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }
    public function update($id, $montant, $date_paiement, $mois, $annee, $statut) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("UPDATE ecolage 
                                  SET montant = :montant, date_paiement = :date_paiement, 
                                      mois = :mois, annee = :annee, statut = :statut 
                                  WHERE id_ecolage = :id");
            $stmt->execute([
                ':id' => $id,
                ':montant' => $montant,
                ':date_paiement' => $date_paiement,
                ':mois' => $mois,
                ':annee' => $annee,
                ':statut' => $statut
            ]);
            return "Mise à jour réussie.";
        } catch (\PDOException $e) {
            return "Erreur de mise à jour : " . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("DELETE FROM ecolage WHERE id_ecolage = ?");
            $stmt->execute([$id]);
            return "Suppression réussie.";
        } catch (\PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }
    }

    public function paiementEcolage($id_ecolage, $montant_paye) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("UPDATE ecolage 
                                  SET montant = :montant, 
                                      date_paiement = NOW(), 
                                      statut = 'paye' 
                                  WHERE id_ecolage = :id");
            $stmt->execute([
                ':montant' => $montant_paye,
                ':id' => $id_ecolage
            ]);
            return "Paiement enregistré avec succès.";
        } catch (\PDOException $e) {
            return "Erreur lors du paiement : " . $e->getMessage();
        }
    }
}
