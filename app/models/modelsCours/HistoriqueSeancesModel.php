<?php
namespace app\models\modelsCours;
use PDO;

class HistoriqueSeancesModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
    $sql = "SELECT hs.id_historique,
                   hs.id_seances,
                   hs.date,
                   hs.statut,
                   sc.date AS date_seance,
                   ph.heure_debut,
                   ph.heure_fin,
                   c.label AS cours_label,
                   pers.nom AS prof_nom,
                   pers.prenom AS prof_prenom
            FROM historique_seances hs
            JOIN seances_cours sc ON hs.id_seances = sc.id_seances
            JOIN plage_horaire ph ON sc.id_plage = ph.id
            JOIN cours c ON sc.id_cours = c.id_cours
            JOIN prof p ON sc.id_prof = p.id_prof
            JOIN personnel pers ON p.id_prof = pers.id_personnel
            ORDER BY hs.date DESC";

        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}