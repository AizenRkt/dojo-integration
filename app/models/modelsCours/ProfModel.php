<?php

namespace app\models\modelsCours;
use PDO;

class ProfModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
    $sql = "SELECT p.id_prof,
                   pers.nom,
                   pers.prenom,
                   pers.date_naissance,
                   pers.adresse,
                   pers.contact,
                   pers.type_personnel,
                   pers.id_genre
            FROM prof p
            JOIN personnel pers ON p.id_prof = pers.id_personnel
            ORDER BY pers.nom ASC";
    
    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getById($id) {
    $sql = "SELECT p.id_prof,
                   pers.nom,
                   pers.prenom,
                   pers.date_naissance,
                   pers.adresse,
                   pers.contact,
                   pers.type_personnel,
                   pers.id_genre
            FROM prof p
            JOIN personnel pers ON p.id_prof = pers.id_personnel
            WHERE p.id_prof = ?";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}