<?php
namespace app\controllers\AbonnementController;
use app\models\AbonnementModel\AbonnementModel;
use Abonnement;
use Flight;

class AbonnementController {

    public function createForm() {
        Flight::render('abonnement/create'); // Vue pour le formulaire de création
    }

    public function index() {
        $abonnements = new AbonnementModel();
        $abonnements = $abonnements->getAll();
        Flight::render('abonnement/listes', ['abonnements' => $abonnements]);
    }

    public function show($id) {
        $abonnement = new AbonnementModel();
        $abonnement = $abonnement->getById($id);
        Flight::render('abonnement/show', ['abonnement' => $abonnement]);
    }


    public function create() {
        $data = Flight::request()->data;
        $success = new AbonnementModel();
        $success = $success->create([
            'id_club' => $data->id_club,
            'jour' => $data->jour,
            'mois' => $data->mois,
            'actif' => $data->actif
        ]);
        $message = $success ? "Création réussie." : "Échec de création.";
        Flight::render('abonnement/create', ['message' => $message]);
    }
    public function editForm($id) {
        $abonnement = new AbonnementModel();
        $abonnement = $abonnement->getById($id);
        Flight::render('abonnement/edit', ['abonnement' => $abonnement]); // Vue pour l'édition
    }
    public function update($id) {
        $data = Flight::request()->data;
        $success = new AbonnementModel();
        $success = $success->update($id, [
            'id_club' => $data->id_club,
            'jour' => $data->jour,
            'mois' => $data->mois,
            'actif' => $data->actif
        ]);
   
        $message = (strpos($success, 'réussie') !== false) ? "Mise à jour réussie." : "Échec de mise à jour.";

    
        if (strpos($success, 'réussie') !== false) {
            $abonnement = $abonnementModel->getById($id);
            Flight::render('abonnement/edit', ['abonnement' => $abonnement, 'message' => $message]);
        } else {
            Flight::render('abonnement/edit', ['message' => $message]);
        }
        }

    public function delete($id) {
        $success = new AbonnementModel();
        $success = $success->delete($id);
        $message = (strpos($success, 'réussie') !== false) ? "Suppression réussie." : "Échec de suppression.";
        if (!$success) {
            Flight::json(['error' => 'Échec de la suppression'], 500);
            return;
        }
        if (strpos($success, 'réussie') !== false) {
            $all = $success->getAll();
            Flight::render('abonnement/listes', ['abonnements' => $all, 'message' => $message]);
        } else {
            Flight::json(['error' => 'Échec de la suppression'], 500);
        }

    }

  public function renouveler($id, $nom, $prix, $duree) {
        $abonnement = new AbonnementModel();
        $success = $abonnement->renouveler($id, $nom, $prix, $duree);
        if ($success) {
            Flight::render('', ['message' => "Renouvellement réussi."]);
        } else {
            Flight::json(['error' => 'Échec du renouvellement'], 500);
        }
    }
    public function annulerForm($id) {
        $abonnement = new AbonnementModel();
        $abonnement = $abonnement->getById($id);
        Flight::render('abonnement/annuler', ['abonnement' => $abonnement]); // Vue pour confirmation de l'annulation
    }
    
    public function annuler($id) {
        $success = new AbonnementModel();
        $success = $success->annuler($id);
        $message = (strpos($success, 'réussie') !== false) ? "Annulation réussie." : "Échec de l'annulation.";
        if (!$success) {
            Flight::json(['error' => 'Échec de l\'annulation'], 500);
            return;
        }
        if (strpos($success, 'réussie') !== false) {
            $message = "Abonnement annulé avec succès.";
            $abonnements = $success->getAll();
            Flight::render('abonnement/listes', ['abonnements' => $abonnements, 'message' => $message]);
        } else {
            $message = "Échec de l'annulation.";
        }
    }
    
    public function rappelAutomatique() {
        $expirants = new AbonnementModel();
        $expirants = $expirants->getExpirationsDans7Jours();
        Flight::render('abonnement/rappel', ['abonnements' => $expirants]);
    }
    public function proforma($id) {
        $abonnement = new AbonnementModel();
        $facture = $abonnement->generateProforma($id);
        if ($facture) {
            Flight::render('abonnement/proforma', ['facture' => $facture]);
        } else {
            Flight::json(['error' => 'Abonnement non trouvé'], 404);
        }
    }
    
    public function isActive($id) {
        $abonnement = new AbonnementModel();
        $isActive = $abonnement->isActive($id);
        Flight::json(['active' => $isActive]);
    }
    public function daysRemaining($id) {
        $abonnement = new AbonnementModel();
        $days = $abonnement->daysRemaining($id);
        Flight::json(['days_remaining' => $days]);
    }
 
}
?>