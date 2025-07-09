<?php

namespace app\models\facture;
use PDO;
use Exception;

class FactureModel {
    private $db;
    private $table = 'facturation';

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

    /**
     * Insère une nouvelle facture dans la table `facturation`
     * @param array $data Données de la facture
     * @return int ID de la facture créée
     * @throws Exception Si erreur SQL ou validation
     */
    public function insert(array $data): int {
        // Validation des données requises
        $requiredFields = ['numero_facture', 'fournisseur', 'date_facture', 'montant_ttc'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                throw new Exception("Le champ $field est obligatoire");
            }
        }

        // Calcul du montant HT si non fourni (à partir du TTC et du taux de TVA)
        if (!isset($data['montant_ht']) && isset($data['id_taxe'])) {
            $tauxTva = $this->getTauxTva($data['id_taxe']);
            $data['montant_ht'] = $data['montant_ttc'] / (1 + ($tauxTva / 100));
        }

        // Requête SQL
        $sql = "INSERT INTO facturation (
                    numero_facture, 
                    id_depense, 
                    fournisseur, 
                    date_facture, 
                    montant_ht, 
                    montant_ttc, 
                    id_taxe, 
                    statut_facture, 
                    date_echeance, 
                    notes
                ) VALUES (
                    :numero_facture, 
                    :id_depense, 
                    :fournisseur, 
                    :date_facture, 
                    :montant_ht, 
                    :montant_ttc, 
                    :id_taxe, 
                    :statut_facture, 
                    :date_echeance, 
                    :notes
                ) RETURNING id_facture";

        $stmt = $this->db->prepare($sql);
        
        // Valeurs par défaut
        $defaults = [
            'id_depense' => null,
            'montant_ht' => null,
            'id_taxe' => null,
            'statut_facture' => 'en_attente',
            'date_echeance' => null,
            'notes' => null
        ];
        
        $params = array_merge($defaults, $data);

        try {
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC)['id_facture'];
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'insertion de la facture: " . $e->getMessage());
        }
    }

    /**
     * Récupère le taux de TVA depuis la table gestion_taxe
     * @param int $id_taxe
     * @return float
     * @throws Exception Si le taux n'existe pas
     */
    private function getTauxTva(int $id_taxe): float {
        $stmt = $this->db->prepare("SELECT taux_tva FROM gestion_taxe WHERE id_taxe = ?");
        $stmt->execute([$id_taxe]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            throw new Exception("Taux de TVA introuvable pour l'ID $id_taxe");
        }

        return (float)$result['taux_tva'];
    }

    // Dans app/models/facture/FactureModel.php

    /**
     * Vérifie si une facture existe déjà par son numéro
     * @param string $numero_facture
     * @return bool
     */
    public function factureExists($numero_facture) {
        $sql = "SELECT COUNT(*) FROM facturation WHERE numero_facture = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$numero_facture]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Récupère une facture par son numéro
     * @param string $numero_facture
     * @return array
     */
    public function getFactureByNumber($numero_facture) {
        $sql = "SELECT * FROM facturation WHERE numero_facture = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$numero_facture]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}