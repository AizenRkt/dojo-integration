<?php

namespace app\models\facture;
use PDO;
use Exception;

class FactureModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getSalaireFactureData($id_suivi) {
        $sql = "SELECT s.*, e.type_employe, p.nom, p.prenom
                FROM suivi_salaire s
                JOIN employe e ON e.id_employe = s.id_employe
                JOIN personnel p ON p.id_personnel = e.id_personnel
                WHERE s.id_suivi_salaire = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id_suivi]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
