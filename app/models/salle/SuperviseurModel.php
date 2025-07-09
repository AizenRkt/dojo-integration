<?php
namespace app\models\salle;
use PDO;

class SuperviseurModel {
    private $db;
    private $table = 'superviseur';

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function all() {
    $sql = "
        SELECT s.id_superviseur,
               p.nom,
               p.prenom,
               p.date_naissance,
               p.adresse,
               p.contact,
               p.type_personnel,
               p.id_genre
        FROM superviseur s
        JOIN personnel p ON s.id_superviseur = p.id_personnel
        ORDER BY p.nom ASC
    ";
    $stmt = $this->db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
