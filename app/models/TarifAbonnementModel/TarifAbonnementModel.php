<?php
namespace app\models\TarifAbonnementModel;

use Flight;
use PDO;

class TarifAbonnementModel {
    public function insert($montant) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO tarif_abonnement (montant, date_modif) VALUES (:montant, NOW())");
            $stmt->execute([':montant' => $montant]);
            return "Insertion réussie !";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getCurrentTarif() {
        try {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM tarif_abonnement ORDER BY date_modif DESC LIMIT 1");

            return ($stmt && ($result = $stmt->fetch(PDO::FETCH_ASSOC))) ? $result : null;

        } catch (\PDOException $e) {
            return null;
        }
    }

}
?>