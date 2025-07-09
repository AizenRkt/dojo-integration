<?php

namespace app\controllers;

use app\models\paiement\EcolageModel;
use Exception;
use Flight;

class EcolageController {
    private $ecolageModel;

    public function __construct() {
        $this->ecolageModel = new EcolageModel();
    }

    // Récupérer tous les élèves avec leur tarif
    public function getAllEleves() {
        try {
            $eleves = $this->ecolageModel->getAllEleves();
            Flight::json($eleves);
        } catch (Exception $e) {
            Flight::json(['error' => $e->getMessage()], 500);
        }
    }


    public function getEleveById($id) {
        try {
            $eleve = $this->ecolageModel->find($id);
            
            if (!$eleve) {
                Flight::json(['error' => 'Élève non trouvé'], 404);
                return;
            }
    
            $historique = $this->ecolageModel->getHistoriqueEcolage($id);
    
            Flight::json([
                'eleve' => $eleve,
                'historique' => $historique
            ]);
        } catch (Exception $e) {
            Flight::json(['error' => $e->getMessage()], 500);
        }
    }

    // Créer un paiement d’écolage
    public function payerEcolage() {
        try {
            $data = Flight::request()->data;

            if (empty($data->id_eleve) || empty($data->mois) || empty($data->annee) || empty($data->montant)) {
                Flight::json(['error' => 'Données incomplètes pour le paiement'], 400);
                return;
            }

            $success = $this->ecolageModel->create([
                'id_eleve' => $data->id_eleve,
                'mois' => $data->mois,
                'annee' => $data->annee,
                'montant' => $data->montant
            ]);

            if ($success) {
                Flight::json(['success' => true, 'message' => 'Paiement enregistré avec succès']);
            } else {
                Flight::json(['error' => 'Échec de l’enregistrement du paiement'], 500);
            }
        } catch (Exception $e) {
            Flight::json(['error' => $e->getMessage()], 500);
        }
    }

    // Récupérer le prochain mois à payer pour un élève
    public function getProchainMois($id_eleve) {
        try {
            $prochain = $this->ecolageModel->getProchainMoisA_Payer($id_eleve);
            Flight::json($prochain);
        } catch (Exception $e) {
            Flight::json(['error' => $e->getMessage()], 500);
        }
    }

    // Vérifie le reste à payer pour un élève à un mois/année donnés
    public function getResteEcolage() {
        try {
            $data = Flight::request()->query;

            if (empty($data['id_eleve']) || empty($data['mois']) || empty($data['annee']) || empty($data['tarif_total'])) {
                Flight::json(['error' => 'Paramètres requis manquants'], 400);
                return;
            }

            $reste = $this->ecolageModel->resteEcolageApayer(
                $data['id_eleve'],
                $data['mois'],
                $data['annee'],
                $data['tarif_total']
            );

            Flight::json(['reste' => $reste]);
        } catch (Exception $e) {
            Flight::json(['error' => $e->getMessage()], 500);
        }
    }
}
