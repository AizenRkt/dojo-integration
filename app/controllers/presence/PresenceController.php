<?php
namespace app\controllers\presence;

use app\models\presence\PresenceModel;
use Flight;
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
        $presences = $this->presenceModel->getAll();
        Flight::render('suivi/presence/index', ['presences' => $presences]);
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

    public function showFeuillePresence($id_seances) {
        $presences = $this->presenceModel->getBySeance($id_seances);
        Flight::render('suivi/presence/feuille', ['presences' => $presences, 'id_seances' => $id_seances]);
    }

    public function absencesEleve($id_eleve) {
        return $this->presenceModel->getAbsencesByEleve($id_eleve);
    }

    public function showAbsencesEleve($id_eleve) {
        $absences = $this->presenceModel->getAbsencesByEleve($id_eleve);
        Flight::render('suivi/presence/absences', ['absences' => $absences, 'id_eleve' => $id_eleve]);
    }

    public function absentsParDate($date_debut, $date_fin) {
        return $this->presenceModel->getAbsentByDate($date_debut, $date_fin);
    }

    public function showAbsentsParDate($date_debut, $date_fin) {
        $absents = $this->presenceModel->getAbsentByDate($date_debut, $date_fin);
        Flight::render('suivi/presence/absents', ['absents' => $absents, 'date_debut' => $date_debut, 'date_fin' => $date_fin]);
    }

    public function presentsParDate($date_debut, $date_fin) {
        return $this->presenceModel->getPresentByDate($date_debut, $date_fin);
    }

    public function showPresentsParDate($date_debut, $date_fin) {
        $presents = $this->presenceModel->getPresentByDate($date_debut, $date_fin);
        Flight::render('suivi/presence/presents', ['presents' => $presents, 'date_debut' => $date_debut, 'date_fin' => $date_fin]);
    }

    public function annulationPossible($id_seances) {
        return $this->presenceModel->annulationPossible($id_seances);
    }
    public function showSuiviPresence() {
        $data = $this->presenceModel->getAbsencesEleves();
        Flight::render('suivi/presence/suivi', [
            'data' => $data,
            'total' => count($data)
        ]);
    }
public function getAbsencesData() {
    $data = $this->presenceModel->getAbsencesEleves();
    Flight::json([
        'success' => true,
        'data' => $data,
        'total' => count($data)
    ]);
}

public function getAbsenceDetails() {
    $idEleve = Flight::request()->query['id_eleve'];
    $dateDebut = Flight::request()->query['date_debut'];
    $dateFin = Flight::request()->query['date_fin'];
    
    $details = $this->presenceModel->getAbsenceDetailsForStudent($idEleve, $dateDebut, $dateFin);
    
    Flight::json([
        'success' => true,
        'details' => $details
    ]);
}
}
?>
