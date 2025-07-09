<?php
namespace app\controllers\statistique;

use Flight;
use PDO;

class SortieStatController {
    
    /**
     * Affiche la vue des statistiques de sortie
     */
    public function index() {
        Flight::render('statistique/sortie_stat');
    }
    
    /**
     * Récupère les statistiques des sorties par catégorie
     */
    public function getStatsByCategorie() {
        try {
            $query = "
                SELECT 
                    categorie,
                    COUNT(*) as total_sorties,
                    SUM(montant) as montant_total
                FROM suivi_depense
                GROUP BY categorie
                ORDER BY montant_total DESC
            ";
            
            $stmt = Flight::db()->prepare($query);
            $stmt->execute();
            $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            Flight::json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Flight::json([
                'success' => false,
                'message' => 'Erreur lors du chargement des statistiques par catégorie: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Récupère les statistiques des sorties par statut
     */
    public function getStatsByStatut() {
        try {
            $query = "
                SELECT 
                    ss.libelle as statut,
                    ss.couleur,
                    COUNT(*) as total_sorties,
                    SUM(sd.montant) as montant_total
                FROM suivi_depense sd
                JOIN statut_sortie ss ON sd.id_statut = ss.id_statut
                GROUP BY ss.libelle, ss.couleur
                ORDER BY montant_total DESC
            ";
            
            $stmt = Flight::db()->prepare($query);
            $stmt->execute();
            $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            Flight::json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Flight::json([
                'success' => false,
                'message' => 'Erreur lors du chargement des statistiques par statut: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Récupère les statistiques des sorties par motif
     */
    public function getStatsByMotif() {
        try {
            $query = "
                SELECT 
                    ms.libelle as motif,
                    ms.categorie,
                    COUNT(*) as total_sorties,
                    SUM(sd.montant) as montant_total
                FROM suivi_depense sd
                JOIN motif_sortie ms ON sd.id_motif = ms.id_motif
                GROUP BY ms.libelle, ms.categorie
                ORDER BY montant_total DESC
                LIMIT 10
            ";
            
            $stmt = Flight::db()->prepare($query);
            $stmt->execute();
            $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            Flight::json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Flight::json([
                'success' => false,
                'message' => 'Erreur lors du chargement des statistiques par motif: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Récupère les statistiques des sorties par période
     */
    public function getStatsByPeriode() {
        try {
            $query = "
                SELECT 
                    TO_CHAR(date_depense, 'YYYY-MM') as periode,
                    COUNT(*) as total_sorties,
                    SUM(montant) as montant_total
                FROM suivi_depense
                GROUP BY TO_CHAR(date_depense, 'YYYY-MM')
                ORDER BY periode DESC
                LIMIT 12
            ";
            
            $stmt = Flight::db()->prepare($query);
            $stmt->execute();
            $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            Flight::json([
                'success' => true,
                'stats' => $stats
            ]);
        } catch (\Exception $e) {
            Flight::json([
                'success' => false,
                'message' => 'Erreur lors du chargement des statistiques par période: ' . $e->getMessage()
            ], 500);
        }
    }
}
