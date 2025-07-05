<?php
namespace app\controllers\individu;

use app\models\individu\SuperviseurModel;
use Flight;

class SuperviseurController {
    private $model;
    public function __construct() {
        $this->model = new SuperviseurModel();
    }

    public function getAll() {
        $superviseurs = $this->model->getAll();
        Flight::json($superviseurs);
    }

    public function getById($id) {
        $superviseur = $this->model->getById($id);
        Flight::json($superviseur);
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

