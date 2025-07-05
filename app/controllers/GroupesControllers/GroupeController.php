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

        Flight::render('gestion/GroupeViews/InsertGroupe', [
            'message' => $message
        ]);
    }

    public function InsertGroupe() {
        $data = Flight::request()->data;
        $message = $this->model->insert($data->nom_responsable, $data->contact, $data->nombre, $data->discipline);

        Flight::render('gestion/GroupeViews/InsertGroupe', [
            'message' => $message
        ]);
    }

    public function GetAllGroupes() {
        $groupes = $this->model->getAll();

        Flight::render('gestion/GroupeViews/ListGroupes', [
            'groupes' => $groupes
        ]);
    }

    public function GetGroupeById($id) {
        $groupe = $this->model->getById($id);

        Flight::render('gestion/GroupeViews/UpdateGroupe', [
            'groupe' => $groupe
        ]);
    }

    public function UpdateGroupe($id) {
        $groupe = $this->model->getById($id);
        $data = Flight::request()->data;
        $message = $this->model->update($id, $data->nom_responsable, $data->contact, $data->nombre, $data->discipline);

        Flight::render('gestion/GroupeViews/UpdateGroupe', [
            'message' => $message,
            'groupe' => $groupe
        ]);
    }

    public function DeleteGroupe($id) {
        $message = $this->model->delete($id);

        Flight::render('gestion/GroupeViews/DeleteGroupe', [
            'message' => $message
        ]);
    }

    // Nouvelle méthode pour afficher le suivi des clubs
    public function showClubTracking() {
        $year = Flight::request()->query->year ?? date('Y');
        $month = Flight::request()->query->month ?? date('m');

        // Récupérer les données du planning
        $scheduleData = $this->model->getScheduleData($year, $month);
        $monthlyStats = $this->model->getMonthlyStats($year, $month);

        // Formatter les données pour le template
        $formattedSchedule = $this->formatScheduleForCalendar($scheduleData);

        Flight::render('suivi/club', [
            'scheduleData' => $formattedSchedule,
            'monthlyStats' => $monthlyStats,
            'currentYear' => $year,
            'currentMonth' => $month
        ]);
    }

    // API pour récupérer les données d'un jour spécifique
    // API pour récupérer les données d'un jour spécifique
    public function getDayDetails($date) {
        try {
            $db = Flight::db();

            $stmt = $db->prepare("
            SELECT 
                r.heure_debut,
                r.heure_fin,
                g.nom_responsable as group_name,
                g.discipline,
                g.nombre as participants
            FROM reservation r
            JOIN club_groupe g ON r.id_club = g.id
            WHERE r.date_reserve = :date
            AND r.valeur = 'confirme'
            ORDER BY r.heure_debut
        ");

            $stmt->execute([':date' => $date]);
            $slots = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $availability = $this->model->getDayAvailability($date);

            $dayData = [
                'status' => $this->getDayStatus($slots, $availability),
                'slots' => array_map(function($slot) {
                    return [
                        'time' => $slot['heure_debut'] . ' - ' . $slot['heure_fin'],
                        'group' => $slot['group_name'],
                        'discipline' => $slot['discipline'],
                        'participants' => (int)$slot['participants']
                    ];
                }, $slots),
                'available' => $availability['available']
            ];

            Flight::json($dayData);
        } catch (\Exception $e) {
            Flight::json(['error' => $e->getMessage()], 500);
        }
    }

    private function formatScheduleForCalendar($scheduleData) {
        $formatted = [];

        foreach ($scheduleData as $reservation) {
            $date = $reservation['date_reserve'];

            if (!isset($formatted[$date])) {
                $formatted[$date] = [
                    'status' => 'partial',
                    'slots' => [],
                    'available' => []
                ];
            }

            $formatted[$date]['slots'][] = [
                'time' => $reservation['heure_debut'] . ' - ' . $reservation['heure_fin'],
                'group' => $reservation['group_name'],
                'discipline' => $reservation['discipline'],
                'participants' => (int)$reservation['participants']
            ];
        }

        // Déterminer le statut de chaque jour et les créneaux disponibles
        foreach ($formatted as $date => &$dayData) {
            $availability = $this->model->getDayAvailability($date);
            $dayData['available'] = $availability['available'];
            $dayData['status'] = $this->getDayStatus($dayData['slots'], $availability);
        }

        return $formatted;
    }

    private function getDayStatus($slots, $availability) {
        if (empty($slots)) {
            return 'free';
        } elseif (empty($availability['available'])) {
            return 'full';
        } else {
            return 'partial';
        }
    }

    // API pour les statistiques du mois
    public function getMonthlyData($year, $month) {
        try {
            $scheduleData = $this->model->getScheduleData($year, $month);
            $monthlyStats = $this->model->getMonthlyStats($year, $month);
            $formattedSchedule = $this->formatScheduleForCalendar($scheduleData);

            Flight::json([
                'schedule' => $formattedSchedule,
                'stats' => $monthlyStats
            ]);
        } catch (\Exception $e) {
            Flight::json(['error' => $e->getMessage()], 500);
        }
    }
}