<?php

namespace app\controllers;

use app\models\evolution\EvolutionModel;
use Flight;

class EvolutionController {

    public function listElevesEvolution() {
        $evolution = new EvolutionModel(Flight::db());
        $eleves = $evolution->getElevesAvecEtoile();
        Flight::render('professeur/evolution',['eleve' => $eleves]);
    }

    public function goToEvolutionForm() {
        $idEleve = 0;
        if(isset($_GET['idEleve'])) {
            $idEleve = $_GET['idEleve'];
        }
        $idProf = 1;
        // $idProf = $_SESSION['id_prof'];
        $evolution = new EvolutionModel(Flight::db());
        $eleve = $evolution->getEleveById($idEleve);
        Flight::render('evolution/evolutionForm', ['id_eleve' => $idEleve, 'id_prof' => $idProf, 'eleve' => $eleve]);
    }

    public function saveEvolution() {
        $params = Flight::request()->data->getData();
        var_dump($params);
        $evolution = new EvolutionModel(Flight::db());
        $insertion = $evolution->insertEvolution($params);
        Flight::redirect('/evolution');
    }

    public function detailsEvolution() {
        $idEleve = 0;
        if(isset($_GET['idEleve'])) {
            $idEleve = $_GET['idEleve'];
        }
        $evolution = new EvolutionModel(Flight::db());
        $historique = $evolution->getHistoriqueEleve($idEleve);
        $eleve = $evolution->getEleveById($idEleve);
        Flight::render('evolution/historique', ['history' => $historique, 'eleve' => $eleve]);
    }

    public function suppression() {
        $id = 0;
        $idEleve = 0;
        if(isset($_GET['id']) && isset($_GET['idEleve'])) {
            $id = $_GET['id'];
            $idEleve = $_GET['idEleve'];
        }
        $evolution = new EvolutionModel(Flight::db());
        $supp = $evolution->deleteEvolution($id);
        Flight::redirect('evolution/details?idEleve='.$idEleve);
    }

    public function goToModifForm() {
        $id = 0;
        $idEleve = 0;
        if(isset($_GET['idEleve']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $idEleve = $_GET['idEleve'];
        }
        $evolution = new EvolutionModel(Flight::db());
        $eleve = $evolution->getEleveById($idEleve);
        $progress = $evolution->getEvolutionById($id);
        Flight::render('evolution/modifEvolution',['id' => $id, 'idEleve' => $idEleve, 'eleve' => $eleve, 'progression' => $progress]);
    }

    public function modification() {
        $params = Flight::request()->data->getData();
        $idEleve = $params['idEleve'];
        $idProf = 2;
        // $idProf = $_SESSION['id_prof'];
        $evolution = new EvolutionModel(Flight::db());
        $update = $evolution->updateEvolution($idProf,$params);
        Flight::redirect('evolution/details?idEleve='.$idEleve);
    }

    public function retour() {
        Flight::redirect('/evolution');
    }

    public function showGlobalStats() {
        $selected_year = $_GET['year'] ?? null;
        
        $evolutionModel = new EvolutionModel(Flight::db());
        
        // Si aucune année n'est sélectionnée, on utilise la plus récente
        $mostRecentYear = $selected_year ?? $evolutionModel->getMostRecentYear();
        
        $stats = $evolutionModel->getGlobalEvolutionStats($mostRecentYear);
        $available_years = $evolutionModel->getAvailableYearsGlobal();
        
        Flight::render('evolution/stats_evolution', [
            'stats' => $stats,
            'available_years' => $available_years,
            'selected_year' => $mostRecentYear // On utilise toujours l'année la plus récente par défaut
        ]);
    }

    public static function getLastEvaluation($id) {
        $model = new EvolutionModel(Flight::db());
        $historique = $model->getHistoriqueEleve($id);

        if ($historique && count($historique) > 0) {
            Flight::json($historique[0]); // renvoie la plus récente
        } else {
            Flight::json(['note' => 0, 'avis' => '']);
        }
    }

    public static function saveEvaluation() {
        $data = Flight::request()->data->getData();

        $model = new EvolutionModel(Flight::db());
        $success = $model->insertEvolution($data);

        if ($success) {
            Flight::json(['status' => 'ok']);
        } else {
            Flight::halt(500, 'Erreur lors de l\'enregistrement');
        }
    }
}
