<?php

//importation de controller
use app\controllers\Controller;

//presence
use app\controllers\presence\PresenceController;

// salle use
use app\controllers\salle\FacturationController;
use app\controllers\salle\HistoriqueGardeController;
use app\controllers\salle\MaterielTypeController;
use app\controllers\salle\StockMaterielController;
use app\controllers\salle\SuiviSalleController;
use app\controllers\salle\DashboardController;

// salle rapport
use app\controllers\statistique\ReportController;

// emploi du temps
use app\controllers\controllersCours\CoursController;
use app\controllers\controllersCours\SeancesController;
use app\controllers\controllersCours\CalendrierController;

//importation lié flight
use flight\Engine;
use flight\net\Router;

//use Flight;

/** 
 * @var Router $router 
 * @var Engine $app
 */
/*$router->get('/', function() use ($app) {
	$Welcome_Controller = new WelcomeController($app);
	$app->render('welcome', [ 'message' => 'It works!!' ]);
});*/

$Controller = new Controller();
// exemple de base
$router->get('/', [ $Controller, 'acceuil' ]);
$router->get('/login', [ $Controller, 'login' ]);
$router->get('/signin', [ $Controller, 'login' ]);

// page statistique
$router->get('/demographie', [ $Controller, 'demographie' ]);
$router->get('/abonnement', [ $Controller, 'abonnement' ]);

// page suivi
$router->get('/presence', [ $Controller, 'presence' ]);
$router->get('/personnel', [ $Controller, 'personnel' ]);
$router->get('/club', [ $Controller, 'club' ]);

$router->get('/salle', [ $Controller, 'club' ]);

// page gestion
$router->get('/tarif', [ $Controller, 'tarif' ]);
$router->get('/edt', [ $Controller, 'edt' ]);
$router->get('/finance', [ $Controller, 'finance' ]);

// $router->get('/', \app\controllers\salle\WelcomeController::class.'->home'); 

// $router->get('/hello-world/@name', function($name) {
// 	echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
// });

// $router->group('/api', function() use ($router, $app) {
// 	$Api_Example_Controller = new ApiExampleController($app);
// 	$router->get('/users', [ $Api_Example_Controller, 'getUsers' ]);
// 	$router->get('/users/@id:[0-9]', [ $Api_Example_Controller, 'getUser' ]);
// 	$router->post('/users/@id:[0-9]', [ $Api_Example_Controller, 'updateUser' ]);
// });

//presences

$presenceController = new PresenceController();

$router->get('/presences', [ $presenceController, 'index' ]);
$router->get('/presence/seance/@id_seances:[0-9]+', [ $presenceController, 'showFeuillePresence' ]);
$router->post('/presence', function() use ($presenceController) {
    $data = $_POST;
    return $presenceController->store($data);
});

$router->post('/presence/update/@id:[0-9]+', function($id) use ($presenceController) {
    $data = $_POST;
    return $presenceController->update($id, $data);
});

$router->post('/presence/delete/@id:[0-9]+', function($id) use ($presenceController) {
    return $presenceController->delete($id);
});

$router->get('/presence/absences/@id_eleve:[0-9]+', [ $presenceController, 'showAbsencesEleve' ]);
$router->get('/presence/absents/@date_debut:[0-9]{4}-[0-9]{2}-[0-9]{2}/@date_fin:[0-9]{4}-[0-9]{2}-[0-9]{2}', [ $presenceController, 'showAbsentsParDate' ]);
$router->get('/presence/presents/@date_debut:[0-9]{4}-[0-9]{2}-[0-9]{2}/@date_fin:[0-9]{4}-[0-9]{2}-[0-9]{2}', [ $presenceController, 'showPresentsParDate' ]);
$router->get('/presence/annulation-possible/@id_seances:[0-9]+', function($id_seances) use ($presenceController) {
    return $presenceController->annulationPossible($id_seances) ? 'true' : 'false';
});


// emploi du temps
$coursController = new CoursController();
$seancesController = new SeancesController();
$calendrierController = new CalendrierController();
$router->get('/formHistorique', [$coursController, 'afficherHistorique']);
$router->get('/formEmploi', [$coursController, 'genererEmploiDuTemps']);
// Cours
$router->get('/listeCours',[$coursController,'getAllCours']);
$router->get('/formCours', [$coursController, 'getFormCours']);
$router->post('/insertCours', [$coursController, 'insertCours']);
$router->post('/updateCours', [$coursController, 'updateCours']);
$router->get('/deleteCours', [$coursController, 'deleteCours']);
// Seances
$router->get('/formSeance', [$seancesController, 'getFormSeance']);
$router->post('/insertSeance', [$seancesController, 'insertSeance']);
$router->post('/updateSeance', [$seancesController, 'updateSeance']);
$router->get('/deleteSeance', [$seancesController, 'deleteSeance']);
$router->get('/listeSeances', [$seancesController, 'getAllSeances']);
$router->get('/historiqueSeances', [$seancesController, 'historiqueSeances']);
// EDT
$router->get('/calendrier', [$calendrierController, 'afficherMois']);
$router->get('/calendrier/details', [$calendrierController, 'detailsGroupe']);


// abonnement 
$router->get('/api/reports/inscriptions', [ReportController::class, 'getInscriptions']);
$router->get('/api/reports/renewal', [ReportController::class, 'getRenewalRate']);
$router->get('/api/reports/attendance', [ReportController::class, 'getAttendance']);
$router->get('/api/reports/revenue', [ReportController::class, 'getRevenueByActivity']);
$router->get('/api/reports/occupancy_alerts', [ReportController::class, 'checkOccupancyAlerts']);
$router->get('/api/reports/unsubscribe_alerts', [ReportController::class, 'checkUnsubscribeAlerts']);
$router->get('/api/reports/profitability', [ReportController::class, 'getProfitability']);


// salle
define('BASE', '/materiel');
Flight::route("GET " . BASE,                ['app\\controllers\\salle\\MaterielTypeController', 'index']);
Flight::route("GET " . BASE . "/create",    ['app\\controllers\\salle\\MaterielTypeController', 'create']);
Flight::route("POST " . BASE . "/store",    ['app\\controllers\\salle\\MaterielTypeController', 'store']);
Flight::route("GET " . BASE . "/@id",       ['app\\controllers\\salle\\MaterielTypeController', 'show']);
Flight::route("GET " . BASE . "/@id/edit",  ['app\\controllers\\salle\\MaterielTypeController', 'edit']);
Flight::route("POST " . BASE . "/@id/update", ['app\\controllers\\salle\\MaterielTypeController', 'update']);
Flight::route("GET " . BASE . "/@id/delete", ['app\\controllers\\salle\\MaterielTypeController', 'delete']);


Flight::route('GET /stock', ['app\\controllers\\salle\\StockMaterielController', 'index']);
Flight::route('POST /stock/add', ['app\\controllers\\salle\\StockMaterielController', 'store']);
Flight::route('GET /stock/delete/@id', function($id) {
    (new app\controllers\salle\StockMaterielController())->delete($id);
});
Flight::route('GET /stock/confirmation/@mouvement/@id_type/@quantite', function($mouvement, $id_type, $quantite){
    (new app\controllers\salle\StockMaterielController())->confirm($mouvement, $id_type, $quantite);
});
Flight::route('POST /stock/insert-series', ['app\\controllers\\salle\\StockMaterielController', 'insertSeries']);
Flight::route('POST /stock/remove-items', ['app\\controllers\\salle\\StockMaterielController', 'removeItems']);


$c = new SuiviSalleController();
Flight::route('GET /suivi-salle', [$c, 'index']);
Flight::route('POST /suivi-salle/add', [$c, 'store']);
Flight::route('GET /suivi-salle/delete/@id', function($id) {
    (new SuiviSalleController())->delete($id);
});


$facturationController = new  FacturationController();
Flight::route('GET /facturation/creer/@id_suivi_salle', function($id) {
    (new  FacturationController())->create($id);
});
Flight::route('POST /facturation/valider', [$facturationController, 'store']);
Flight::route('/facturation/pdf/@id', [$facturationController, 'generatePdf']);
Flight::route('GET /facturation/liste', [$facturationController, 'liste']);
Flight::route('GET /facturation/valider/@id_facture', [$facturationController, 'valider']);


// Liste des historiques
Flight::route('GET /historique-garde', ['app\\controllers\\salle\\HistoriqueGardeController', 'index']);
// Formulaire création
Flight::route('GET /historique-garde/create', ['app\\controllers\\salle\\HistoriqueGardeController', 'createForm']);
// Soumission création
Flight::route('POST /historique-garde/create', ['app\\controllers\\salle\\HistoriqueGardeController', 'create']);
// Formulaire modification
Flight::route('GET /historique-garde/edit/@id', ['app\\controllers\\salle\\HistoriqueGardeController', 'editForm']);
// Soumission modification
Flight::route('POST /historique-garde/edit/@id', ['app\\controllers\\salle\\HistoriqueGardeController', 'update']);
// Suppression
Flight::route('GET /historique-garde/delete/@id', ['app\\controllers\\salle\\HistoriqueGardeController', 'delete']);


$dashboardController = new  DashboardController();
Flight::route('GET /dashboard', [$dashboardController, 'index']);
?>