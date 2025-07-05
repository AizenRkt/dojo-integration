<?php

namespace app\controllers\GroupesControllers;

use app\models\GroupeModels\GroupeModel;
use Flight;

class GroupeController {

    private GroupeModel $model;

    public function __construct() {
        $this->model = new GroupeModel();
    }

    public function formGroupe() {
        $message = "ok";

        Flight::render('GroupeViews/InsertGroupe', [
            'message' => $message
        ]);
    }

    public function InsertGroupe() {
        $data = Flight::request()->data;
        $message = $this->model->insert($data->nom_responsable, $data->contact, $data->nombre, $data->discipline);

        Flight::render('GroupeViews/InsertGroupe', [
            'message' => $message
        ]);
    }

    public function GetAllGroupes() {
        $groupes = $this->model->getAll();

        Flight::render('GroupeViews/ListGroupes', [
            'groupes' => $groupes
        ]);
    }

    public function GetGroupeById($id) {
        $groupe = $this->model->getById($id);

        Flight::render('GroupeViews/UpdateGroupe', [
            'groupe' => $groupe
        ]);
    }

    public function UpdateGroupe($id) {
        $groupe = $this->model->getById($id);
        $data = Flight::request()->data;
        $message = $this->model->update($id, $data->nom_responsable, $data->contact, $data->nombre);

        Flight::render('GroupeViews/UpdateGroupe', [
            'message' => $message,
            'groupe' => $groupe
        ]);

    }

    public function DeleteGroupe($id) {
        $message = $this->model->delete($id);

        Flight::render('GroupeViews/DeleteGroupe', [
            'message' => $message
        ]);
    }
}