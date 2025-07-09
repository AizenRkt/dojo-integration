<?php

namespace app\models\evolution;

use PDO;
use PDOException;
use Exception;
use Flight;

class EvolutionModel {
    // private $db;

    // public function __construct($db)
    // {
    //     $this->db = $db;
    // }

    public function getElevesAvecEtoile() {
        try {
            $db = Flight::db();
            $sql = "SELECT e.*, COALESCE(ROUND(AVG(ev.note)::NUMERIC, 1), 0) as note
                FROM eleve e
                LEFT JOIN evolution ev ON e.id_eleve = ev.id_eleve
                GROUP BY e.id_eleve, e.nom, e.prenom, e.date_naissance, e.adresse, e.contact, e.date_inscription, e.id_genre
                ORDER BY e.nom
            ";
            $stmt = $db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function getLastEvaluation($id_eleve) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT * FROM evolution WHERE id_eleve = ? ORDER BY date_evolution DESC LIMIT 1");
        $stmt->execute([$id_eleve]);
        return $stmt->fetch();
    }

    public static function insertEvaluation($id_prof, $id_eleve, $note, $avis) {
        $db = Flight::db();
        $stmt = $db->prepare("INSERT INTO evolution (id_prof, id_eleve, note, avis, date_evolution) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([$id_prof, $id_eleve, $note, $avis]);
    }

    public function updateEvolution($prof, $params) {
        try {
            $db = Flight::db();
            $sql = "UPDATE evolution SET id_prof = ?, avis = ?, note = ? WHERE id_evolution = ? ";
            $stmt = $db->prepare($sql);
            return $stmt->execute([$prof, $params['avis'], $params['note'], $params['evolution']]);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getEvolutionById($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT id_evolution, id_eleve, note, avis FROM evolution WHERE id_evolution = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function deleteEvolution($id) {
        try {
            $db = Flight::db();
            $sql = "DELETE FROM evolution WHERE id_evolution = :id";
            $stmt = $db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            return null;
        }
    }

    public static function getHistoriqueEvaluations($id_eleve) {
        $db = Flight::db();
        $stmt = $db->prepare("SELECT id_evolution, nom, prenom, date_inscription, note, avis, date_evolution FROM evolution JOIN eleve ON eleve.id_eleve = evolution.id_eleve WHERE evolution.id_eleve = ? ORDER BY date_evolution DESC");
        $stmt->execute([$id_eleve]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    // public function getGlobalEvolutionStats($year = null) {
    //     try {
    //         // Si aucune année n'est spécifiée, on prend la plus récente
    //         if (!$year) {
    //             $year = $this->getMostRecentYear();
    //         }
    
    //         // Requête pour récupérer les données existantes
    //         $sql = "SELECT 
    //                     EXTRACT(YEAR FROM date_evolution) as year,
    //                     EXTRACT(MONTH FROM date_evolution) as month,
    //                     AVG(note) as avg_note,
    //                     COUNT(DISTINCT id_eleve) as student_count,
    //                     COUNT(*) as evaluation_count
    //                 FROM evolution
    //                 WHERE EXTRACT(YEAR FROM date_evolution) = ?
    //                 GROUP BY year, month
    //                 ORDER BY month";
            
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->execute([$year]);
    //         $existingData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //         // Créer un tableau complet pour les 12 mois
    //         $completeData = [];
    //         for ($month = 1; $month <= 12; $month++) {
    //             $found = false;
    //             foreach ($existingData as $data) {
    //                 if ($data['month'] == $month) {
    //                     $completeData[] = $data;
    //                     $found = true;
    //                     break;
    //                 }
    //             }
    //             if (!$found) {
    //                 $completeData[] = [
    //                     'year' => $year,
    //                     'month' => $month,
    //                     'avg_note' => null,
    //                     'student_count' => 0,
    //                     'evaluation_count' => 0
    //                 ];
    //             }
    //         }
    
    //         return $completeData;
            
    //     } catch (PDOException $e) {
    //         error_log("Erreur dans getGlobalEvolutionStats: " . $e->getMessage());
    //         return [];
    //     }
    // }
    
    // public function getMostRecentYear() {
    //     try {
    //         $sql = "SELECT EXTRACT(YEAR FROM date_evolution) as year
    //                 FROM evolution
    //                 ORDER BY date_evolution DESC
    //                 LIMIT 1";
            
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->execute();
    //         return $stmt->fetchColumn();
            
    //     } catch (PDOException $e) {
    //         error_log("Erreur dans getMostRecentYear: " . $e->getMessage());
    //         return date('Y'); // Retourne l'année courante si erreur
    //     }
    // }
    
    // public function getAvailableYearsGlobal() {
    //     try {
    //         $sql = "SELECT DISTINCT EXTRACT(YEAR FROM date_evolution) as year
    //                 FROM evolution
    //                 ORDER BY year DESC";
            
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->execute();
    //         return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
            
    //     } catch (PDOException $e) {
    //         error_log("Erreur dans getAvailableYearsGlobal: " . $e->getMessage());
    //         return [date('Y')];
    //     }
    // }
}
    
?>
