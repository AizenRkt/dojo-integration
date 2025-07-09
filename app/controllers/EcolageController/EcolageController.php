<?php

namespace app\controllers\EcolageController;

use app\models\EcolageModel\EcolageModel;
use Flight;

class EcolageController {

    private $model;

    public function __construct() {
        $this->model = new EcolageModel();
    }

    public function getAll() {
        $result = $this->model->getAll();
        Flight::json($result);
    }

    public function getById($id) {
        $result = $this->model->getById($id);
        Flight::json($result);
    }


    public function getByEleve($id_eleve) {
        $result = $this->model->getByEleve($id_eleve);
        Flight::json($result);
    }


    public function insert() {
        $data = Flight::request()->data;
        $message = $this->model->insert(
            $data['id_eleve'],
            $data['montant'],
            $data['date_paiement'],
            $data['mois'],
            $data['annee'],
            $data['statut'] ?? 'non paye'
        );
        Flight::json(['message' => $message]);
    }

    public function update($id) {
        $data = Flight::request()->data;
        $message = $this->model->update(
            $id,
            $data['montant'],
            $data['date_paiement'],
            $data['mois'],
            $data['annee'],
            $data['statut']
        );
        Flight::json(['message' => $message]);
    }

 
    public function delete($id) {
        $message = $this->model->delete($id);
        Flight::json(['message' => $message]);
    }

  
    public function paiement($id) {
        $data = Flight::request()->data;
        $message = $this->model->paiementEcolage($id, $data['montant']);
        Flight::json(['message' => $message]);
    }
}
