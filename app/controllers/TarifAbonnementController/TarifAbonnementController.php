<?php
namespace app\controllers\TarifAbonnementController;

use app\models\TarifAbonnementModel\TarifAbonnementModel;
use Flight;

class TarifAbonnementController {
    public function updateTarifAbonnement() {
        $montant = floatval($_POST['montant'] ?? 0);
        $m = new TarifAbonnementModel();
        $m->insert($montant);

    }
}
?>
