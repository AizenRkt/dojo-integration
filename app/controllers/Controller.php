<?php

namespace app\controllers;

use app\controllers\statistique\ReportController;
use app\models\TarifAbonnementModel\TarifAbonnementModel;
use app\models\TarifClubModel\TarifClubModel;
use app\models\TarifEcolageModel\TarifEcolageModel;
use app\models\individu\LoginModel;
use app\models\evolution\EvolutionModel;
use app\models\GroupeModels\GroupeModel;

use Flight;

class Controller {

    public function __construct() {
    }

    public function acceuil() {
        Flight::render('acceuil');
    }

    public function login() {
        Flight::render('template/auth/login');

    }
    public function handleLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            $user = LoginModel::verifyCredentials($username, $password);
    
            if ($user) {
                // Stocker les informations de l'utilisateur en session
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $user['role'];
                // Rediriger en fonction du rôle
                switch ($user['role']) {
                    case 'admin':
                    case 'superviseur':
                        Flight::redirect('/acceuil');
                        break;
                    case 'prof':
                        Flight::redirect('/presence');
                        break;
                    default:
                        Flight::redirect('/');
                }
            } else {
                Flight::redirect('/?error=1');
            }
        }
    }
    
    public function logout() {
        session_destroy();
        Flight::redirect('/');
    }
    public function signin() {
        Flight::render('template/auth/sigin');

    }

    public function demographie() {
        Flight::render('statistique/demographie');
    }

    //Controller pour les pages des professeurs
    public function professeurSidebar() {
        Flight::render('template/menu/professeurSidebar');
    }

    public function evolution() {
        $evolution = new EvolutionModel(Flight::db());
        $eleves = $evolution->getElevesAvecEtoile();
        Flight::render('professeur/evolution',['eleve' => $eleves]);
    }

    public function emploi_temps() {
        Flight::render('professeur/emploi_temps');
    }

    public function presence_eleve() {
        Flight::render('professeur/presence_eleve');
    }

    public function compte() {
        Flight::render('professeur/compte');
    }

    // en utilisation
    public function abonnement() {
        $reportController = new ReportController();
        
        // Paramètres de date
        $year = $_GET['year'] ?? date('Y');
        $month = $_GET['month'] ?? date('m');
        $week = $_GET['week'] ?? date('W');
        
        // Données d'abonnement
        $inscriptions = $reportController->getInscriptionsData($year, $month);
        $renewalRate = $reportController->getRenewalRateData($year, $month);
        $newSubscriptions = $inscriptions['total'] - ($inscriptions['total'] * $renewalRate['rate'] / 100);
        
        // Données mensuelles
        $monthlyData = $reportController->getMonthlySubscriptionData($year, $month);
        
        // Données de présence
        $attendanceData = $reportController->getAttendanceData($year, $week);
        
        // Données de revenus
        $revenueData = $reportController->getRevenueData($year, $month);
        
        // Alertes
        $occupancyAlert = $reportController->getOccupancyAlert($year, $week);
        $unsubscribeAlert = $reportController->getUnsubscribeAlert($year, $month);
        
        // Rentabilité
        $profitability = $reportController->getProfitabilityData($year, $month);
        
        // Rendre la vue avec toutes les données
        Flight::render('statistique/abonnement', [
            // Données abonnement
            'totalClients' => $inscriptions['total'],
            'totalReabonnement' => round($inscriptions['total'] * $renewalRate['rate'] / 100),
            'totalNouveau' => round($newSubscriptions),
            'reabonnementPourcentage' => round($renewalRate['rate'], 2),
            'nouveauPourcentage' => round(100 - $renewalRate['rate'], 2),
            'monthlyData' => $monthlyData,
            
            // Données présence
            'attendanceData' => $attendanceData,
            'occupancyRate' => $occupancyAlert['occupancy'],
            'occupancyAlert' => $occupancyAlert['alert'],
            
            // Données financières
            'revenue' => $revenueData['revenue'],
            'unsubscribeRate' => $unsubscribeAlert['unsubscribe_rate'],
            'unsubscribeAlert' => $unsubscribeAlert['alert'],
            'profit' => $profitability['profit'],
            'cost' => $profitability['cost'],
            
            // Paramètres date
            'year' => $year,
            'month' => $month,
            'week' => $week
        ]);
    }

    public function presence() {
        Flight::render('suivi/presence');
    }

    public function personnel() {
        Flight::render('suivi/personnel');
    }

    public function club() {
    $model = new GroupeModel();

    $year = Flight::request()->query->year ?? date('Y');
    $month = Flight::request()->query->month ?? date('m');

    $scheduleData = $model->getScheduleData($year, $month);
    $monthlyStats = $model->getMonthlyStats($year, $month);
    $groupes = $model->getAll();

    $formattedSchedule = $this->formatScheduleForCalendar($scheduleData);
    

    Flight::render('suivi/club', [
        'scheduleData' => $formattedSchedule,
        'monthlyStats' => $monthlyStats,
        'currentYear' => $year,
        'currentMonth' => $month,
        'groupes' => $groupes
    ]);
}

    // en utilisation
    public function tarif() {
        $m1 = new TarifAbonnementModel();
        $m2 = new TarifEcolageModel();
        $m3 = new TarifClubModel();

        $tarifAbo = $m1->getCurrentTarif();
        $tarifEcoEnfant = $m2->getCurrentTarifEnfant();
        $tarifEcoAdult = $m2->getCurrentTarifAdulte();
        $tarifClub = $m3->getCurrentTarif();

        Flight::render('gestion/tarif', [
            'abonnement' => isset($tarifAbo['montant']) ? $tarifAbo['montant'] : null,
            'ecolageEnfant' => isset($tarifEcoEnfant['montant']) ? $tarifEcoEnfant['montant'] : null,
            'ecolageAdult' => isset($tarifEcoAdult['montant']) ? $tarifEcoAdult['montant'] : null,
            'club' => isset($tarifClub['montant_par_heure']) ? $tarifClub['montant_par_heure'] : null,
        ]);
    }


    // public function edt() {
    //     Flight::render('gestion/edt');
    // }

    public function finance() {
        Flight::render('gestion/finance');
    }
    private function getDayStatus(array $slots, array $available) {
    if (empty($slots)) {
        return 'free';  // Libre
    }
    if (empty($available)) {
        return 'full';  // Complet
    }
    return 'partial';  // Partiel
}

private function formatScheduleForCalendar($scheduleData) {
    $model= new GroupeModel();
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

    foreach ($formatted as $date => &$dayData) {
        $availability = $model->getDayAvailability($date);

        $dayData['available'] = isset($availability['available']) && is_array($availability['available']) 
                                ? $availability['available'] 
                                : [];

        // Ajout du préfixe "day-" ici
        $status = $this->getDayStatus($dayData['slots'], $dayData['available']);
        $dayData['status'] = "day-" . $status;
    }

    return $formatted;
}




}
