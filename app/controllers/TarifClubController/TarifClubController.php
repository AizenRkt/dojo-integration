<?php
namespace app\controllers\TarifClubController;

use app\models\TarifClubModel\TarifClubModel;
use Flight;

class TarifClubController {
    public function updateTarifClub() {
    $montant = floatval($_POST['montant'] ?? 0);
    $m = new TarifClubModel();
    $m->insert($montant);
}

}
?>