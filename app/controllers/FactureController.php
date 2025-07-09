<?php

namespace app\controllers;

use app\fpdf\FPDF;
use app\models\facture\FactureModel;
use Flight;

class FactureController {
    public static function factureSalaire($id_suivi) {
        try {
            // Récupérer la connexion à la DB depuis Flight
            $db = Flight::db();
            
            // Passer la connexion DB au constructeur
            $factureModel = new FactureModel($db);
            
            $data = $factureModel->getSalaireFactureData($id_suivi);
            
            if (!$data) {
                Flight::halt(404, json_encode(['error' => 'Paiement de salaire non trouve']));
                return;
            }

            // Ici vous générerez le PDF avec les données...
            // Création du PDF
        $pdf = new FPDF();
        $pdf->AddPage();

        // Titre
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'FACTURE', 0, 1, 'C');

        // Infos en-tête
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(100, 10, 'Date de la facture: ' . date('d/m/Y'), 0, 0);
        $pdf->Cell(0, 10, 'Numero Facture: SAL-' . str_pad($id_suivi, 5, '0', STR_PAD_LEFT), 0, 1);
        $pdf->Cell(100, 10, 'Date de paiement: ' . date('d/m/Y', strtotime($data['date_paiement'])), 0, 0);
        $pdf->Cell(0, 10, 'Date d echeance: ' . date('d/m/Y', strtotime($data['date_paiement'] . ' +15 days')), 0, 1);

        // Infos Employé
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, 'Employe:', 0, 1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 8, "{$data['nom']} {$data['prenom']}", 0, 1);
        $pdf->Cell(0, 8, "Profession: {$data['type_employe']}", 0, 1);

        // Tableau de salaire
        $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(50, 10, 'Mois', 1);
        $pdf->Cell(50, 10, 'Mode Paiement', 1);
        $pdf->Cell(40, 10, 'Montant HT', 1);
        $pdf->Cell(40, 10, 'Montant TTC', 1);
        $pdf->Ln();

        // Données
        $pdf->SetFont('Arial', '', 12);
        $tva = 0.20; // 20%
        $ht = $data['montant'] / (1 + $tva);
        $ttc = $data['montant'];

        $pdf->Cell(50, 10, "{$data['mois_a_payer']}/{$data['annee_a_payer']}", 1);
        $pdf->Cell(50, 10, ucfirst($data['mode_paiement']), 1);
        $pdf->Cell(40, 10, number_format($ht, 2, ',', ' ') . ' Ar', 1);
        $pdf->Cell(40, 10, number_format($ttc, 2, ',', ' ') . ' Ar', 1);
        $pdf->Ln();

        // Total
        $pdf->Ln(5);
        $pdf->Cell(0, 10, "Total HT : " . number_format($ht, 2, ',', ' ') . " Ar", 0, 1);
        $pdf->Cell(0, 10, "TVA (20%) : " . number_format($ttc - $ht, 2, ',', ' ') . " Ar", 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 10, "Total TTC : " . number_format($ttc, 2, ',', ' ') . " Ar", 0, 1);

        // Signature
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Signature : Jean Dupont - Gestionnaire de comptes', 0, 1);

        $pdf->Output('I', "facture_salaire_{$id_suivi}.pdf");
          
        } catch (Exception $e) {
            Flight::halt(500, json_encode(['error' => $e->getMessage()]));
        }
    }
}

?>