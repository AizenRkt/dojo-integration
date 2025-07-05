<?php
namespace app\models\TarifClubModel;

use Flight;
use PDO;

class TarifClubModel {
    public function insert($montant_par_heure) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("INSERT INTO tarif_club (montant_par_heure, date_modif) VALUES (:montant, NOW())");
            $stmt->execute([':montant' => $montant_par_heure]);
            return "Insertion réussie !";
        } catch (\PDOException $e) {
            return "Erreur : " . $e->getMessage();
        }
    }

    public function getCurrentTarif() {
        try {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM tarif_club ORDER BY date_modif DESC LIMIT 1");

            return ($stmt && ($result = $stmt->fetch(PDO::FETCH_ASSOC))) ? $result : null;

        } catch (\PDOException $e) {
            return null;
        }
    }

}
