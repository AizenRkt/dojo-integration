<?php
namespace app\controllers\individu;

use app\models\individu\ProfModel;
use Flight;

class ProfController {
    private $model;
    public function __construct() {
        $this->model = new ProfModel();
    }

    public function getAll() {
        $profs = $this->model->getAll();
        Flight::json($profs);
    }

    public function getById($id) {
        $prof = $this->model->getById($id);
        Flight::json($prof);
    }

    // In ProfController.php and SuperviseurController.php
    public function insert() {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            $input = Flight::request()->data->getData();
        }

        // Handle missing date_naissance
        $dateNaissance = isset($input['date_naissance']) ? $input['date_naissance'] : null;

        $result = $this->model->insert(
            $input['nom'],
            $input['prenom'],
            $dateNaissance,
            $input['adresse'],
            $input['contact'],
            $input['id_genre']
        );
        Flight::json(['success' => true, 'message' => $result]);
    }

    public function update($id) {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) {
            $input = Flight::request()->data->getData();
        }

        // Handle missing date_naissance
        $dateNaissance = isset($input['date_naissance']) ? $input['date_naissance'] : null;

        $result = $this->model->update(
            $id,
            $input['nom'],
            $input['prenom'],
            $dateNaissance, // Add this parameter
            $input['adresse'],
            $input['contact'],
            $input['id_genre']
        );
        Flight::json(['success' => true, 'message' => $result]);
    }

    public function delete($id) {
        $result = $this->model->delete($id);
        Flight::json(['message' => $result]);
    }
}

