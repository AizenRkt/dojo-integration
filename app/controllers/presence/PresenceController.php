<?php
namespace app\controllers;

use app\models\presence\PresenceModel;
use PDO;

class PresenceController {
    private $presenceModel;

    public function __construct() {
        $this->presenceModel = new PresenceModel($this->getDb());
    }

    public function getDb() {
        return Flight::db();
    }

    public function index() {
        return $this->presenceModel->getAll();
    }
    public function store($data) {
        return $this->presenceModel->insert($data);
    }

    public function update($id, $data) {
        return $this->presenceModel->update($id, $data);
    }

    public function delete($id) {
        return $this->presenceModel->delete($id);
    }

    public function feuillePresence($id_seances) {
        return $this->presenceModel->getBySeance($id_seances);
    }

    public function absencesEleve($id_eleve) {
        return $this->presenceModel->getAbsencesByEleve($id_eleve);
    }

    public function absentsParDate($date_debut, $date_fin) {
        return $this->presenceModel->getAbsentByDate($date_debut, $date_fin);
    }


    public function presentsParDate($date_debut, $date_fin) {
        return $this->presenceModel->getPresentByDate($date_debut, $date_fin);
    }

    public function annulationPossible($id_seances) {
        return $this->presenceModel->annulationPossible($id_seances);
    }
}
?>
