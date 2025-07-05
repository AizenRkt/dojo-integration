<?php
namespace app\controllers\TarifEcolageController;

use app\models\TarifEcolageModel\TarifEcolageModel;
use Flight;

class TarifEcolageController {
    public function updateTarifEnfant() {
        $montant = floatval($_POST['montant'] ?? 0);
        $m = new TarifEcolageModel();
        $m->insert($montant, 0);
    }

    public function updateTarifAdulte() {
        $montant = floatval($_POST['montant'] ?? 0);
        $m = new TarifEcolageModel();
        $m->insert($montant, 1);
    }
}
?>
