<?php
namespace app\controllers\presence;

use app\models\presence\PresenceModel;
use Flight;
use PDO;
use Exception;
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
    public function showPresenceEleve() {
        Flight::render('professeur/presence_eleve');
    }

    public function getCoursAujourdhui() {
        $today = date('Y-m-d');
        $sql = "SELECT 
                    sc.id_seances,
                    c.label as cours_nom,
                    sc.date,
                    ph.heure_debut,
                    ph.heure_fin,
                    CONCAT(p.nom, ' ', p.prenom) as professeur
                FROM seances_cours sc
                JOIN cours c ON sc.id_cours = c.id_cours
                JOIN plage_horaire ph ON sc.id_plage = ph.id
                JOIN prof pr ON sc.id_prof = pr.id_prof
                JOIN personnel p ON pr.id_prof = p.id_personnel
                WHERE sc.date = :today
                ORDER BY ph.heure_debut";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(['today' => $today]);
        $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);

        Flight::json([
            'success' => true,
            'cours' => $cours,
            'date' => $today
        ]);
    }

    public function getElevesParSeance($id_seances) {
        // Récupérer les élèves qui ont déjà une présence enregistrée
        $sql = "SELECT 
                    e.id_eleve,
                    e.nom,
                    e.prenom,
                    COALESCE(p.present, false) as present,
                    COALESCE(p.remarque, '') as remarque,
                    p.id_presence
                FROM eleve e
                LEFT JOIN presence p ON e.id_eleve = p.id_eleve AND p.id_seances = :id_seances
                WHERE e.id_eleve IN (
                    SELECT DISTINCT id_eleve 
                    FROM gestion_groupe gg
                    JOIN planification_cours pc ON gg.groupe = pc.groupe
                    WHERE pc.id_seance = :id_seances
                    AND gg.mois = EXTRACT(MONTH FROM CURRENT_DATE)
                    AND gg.annee = EXTRACT(YEAR FROM CURRENT_DATE)
                )
                ORDER BY e.nom, e.prenom";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute(['id_seances' => $id_seances]);
        $eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);

        Flight::json([
            'success' => true,
            'eleves' => $eleves
        ]);
    }

    public function enregistrerPresence() {
        $data = Flight::request()->data->getData();
        $id_seances = $data['id_seances'];
        $presences = $data['presences'];

        try {
            $this->getDb()->beginTransaction();

            foreach ($presences as $presence) {
                // Ensure proper boolean conversion
                $present = isset($presence['present']) && $presence['present'] === true;

                $presenceData = [
                    'present' => $present ? 'true' : 'false', // Convert to string boolean for PostgreSQL
                    'remarque' => !empty($presence['remarque']) ? $presence['remarque'] : null
                ];

                if (isset($presence['id_presence']) && !empty($presence['id_presence'])) {
                    // Mise à jour
                    $this->presenceModel->update($presence['id_presence'], $presenceData);
                } else {
                    // Insertion
                    $presenceData['id_eleve'] = $presence['id_eleve'];
                    $presenceData['id_seances'] = $id_seances;
                    $this->presenceModel->insert($presenceData);
                }
            }

            $this->getDb()->commit();

            Flight::json([
                'success' => true,
                'message' => 'Présence enregistrée avec succès'
            ]);
        } catch (Exception $e) {
            $this->getDb()->rollBack();
            Flight::json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement: ' . $e->getMessage()
            ], 500);
        }
    }
}
?>
