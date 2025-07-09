<?php
namespace app\controllers\controllersCours;

use Flight;
use Exception;
use DateTime;
use app\models\modelsCours\GestionCoursModel;
use app\models\GroupeModels\ReservationModel;

class CalendrierController {

    public static function afficherMois() {
        $mois = isset($_GET['mois']) ? intval($_GET['mois']) : date('n');
        $annee = isset($_GET['annee']) ? intval($_GET['annee']) : date('Y');

        $gestionCours = new GestionCoursModel(Flight::db());

        // Assigner les groupes pour le mois/année (aucun doublon possible)
        $gestionCours->assignerGroupesEleves($mois, $annee);

        $calendrier = [];

        for ($jour = 1; $jour <= 31; $jour++) {
            if (!checkdate($mois, $jour, $annee)) continue;

            $date = sprintf('%04d-%02d-%02d', $annee, $mois, $jour);
            $jourSemaine = date('w', strtotime($date)); // 0 = dimanche, 3 = mercredi, 6 = samedi

            // Si mercredi (3) ou samedi (6), planifier les cours du jour
            if ($jourSemaine == 3 || $jourSemaine == 6) {
                $gestionCours->planifierCoursDuJour($date);
            }

            // Récupérer les séances planifiées pour ce jour
            $seances = $gestionCours->getSeancesParJour($date);

            if (!empty($seances)) {
                $calendrier[$jour] = $seances;
            }
        }

        Flight::render("gestion/edt/calendrier/mois", [
            'mois' => $mois,
            'annee' => $annee,
            'calendrier' => $calendrier
        ]);
    }


    public static function detailsGroupe() {
        $date = $_GET['date'] ?? null;
        $groupe = $_GET['groupe'] ?? null;

        if (!$date || !$groupe) {
            Flight::halt(400, "Date et groupe requis");
        }

        $gestionCours = new GestionCoursModel(Flight::db());
        $eleves = $gestionCours->getElevesDuGroupeParDate($groupe, $date);

        Flight::render("gestion/edt/calendrier/details", [
            'date' => $date,
            'groupe' => $groupe,
            'eleves' => $eleves
        ]);
    }

    public static function afficherClubsMois($mois, $annee) {
        $reservationModel = new ReservationModel(Flight::db());
        $reservations = $reservationModel->getActivitesClubs($mois, $annee); // <- cette méthode doit exister dans ReservationModel

        $calendrier = [];

        foreach ($reservations as $r) {
            $jour = intval(date('j', strtotime($r['date_reserve'])));
            $calendrier[$jour][] = array_merge($r, ['type' => 'club']);
        }

        return $calendrier;
    }

    public static function afficherMoisComplet() {
        $mois = isset($_GET['mois']) ? intval($_GET['mois']) : date('n');
        $annee = isset($_GET['annee']) ? intval($_GET['annee']) : date('Y');

        $gestionCours = new GestionCoursModel(Flight::db());
        $gestionCours->assignerGroupesEleves($mois, $annee);

        $calendrier = [];

        for ($jour = 1; $jour <= 31; $jour++) {
            if (!checkdate($mois, $jour, $annee)) continue;

            $date = sprintf('%04d-%02d-%02d', $annee, $mois, $jour);
            $jourSemaine = date('w', strtotime($date));

            if ($jourSemaine == 3 || $jourSemaine == 6) {
                $gestionCours->planifierCoursDuJour($date);
            }

            $calendrier[$jour] = [];

            $seances = $gestionCours->getSeancesParJour($date);
            if (!empty($seances)) {
                $calendrier[$jour] = array_merge($calendrier[$jour], $seances);
            }
        }

        // Ajouter les réservations club
        $reservationModel = new ReservationModel(Flight::db());
        $reservations = $reservationModel->getActivitesClubs($mois, $annee);

        foreach ($reservations as $jour => $activites) {
            foreach ($activites as $a) {
                $calendrier[$jour][] = array_merge($a, ['type' => 'club']);
            }
        }


        Flight::render("gestion/edt", [
            'mois' => $mois,
            'annee' => $annee,
            'calendrier' => $calendrier
        ]);
    }

    public static function afficherSemaine() {
        $semaine = isset($_GET['semaine']) ? intval($_GET['semaine']) : date('W');
        $annee = isset($_GET['annee']) ? intval($_GET['annee']) : date('Y');

        $start = new DateTime();
        $start->setISODate($annee, $semaine);
        $calendrier = [];

        $gestionCours = new GestionCoursModel(Flight::db());
        $reservationModel = new ReservationModel(Flight::db());

        for ($i = 0; $i < 7; $i++) {
            $jour = clone $start;
            $jour->modify("+$i days");
            $date = $jour->format('Y-m-d');

            $jourSemaine = $jour->format('w');
            if ($jourSemaine == 3 || $jourSemaine == 6) {
                $gestionCours->planifierCoursDuJour($date);
            }

            $seances = $gestionCours->getSeancesParJour($date);
            $calendrier[$date] = $seances ?? [];

            // Ajouter les activités club du jour
            $clubs = $reservationModel->getActivitesClubsJour($date); // à créer si besoin
            foreach ($clubs as $club) {
                $calendrier[$date][] = array_merge($club, ['type' => 'club']);
            }
        }

        Flight::render('gestion/edt', [
            'semaine' => $semaine,
            'annee' => $annee,
            'calendrier' => $calendrier
        ]);
    }

    public static function afficherMoisComplet2() {
        $mois = isset($_GET['mois']) ? intval($_GET['mois']) : date('n');
        $annee = isset($_GET['annee']) ? intval($_GET['annee']) : date('Y');

        $gestionCours = new GestionCoursModel(Flight::db());
        $gestionCours->assignerGroupesEleves($mois, $annee);

        $calendrier = [];

        for ($jour = 1; $jour <= 31; $jour++) {
            if (!checkdate($mois, $jour, $annee)) continue;

            $date = sprintf('%04d-%02d-%02d', $annee, $mois, $jour);
            $jourSemaine = date('w', strtotime($date)); // 3 = mercredi, 6 = samedi

            if ($jourSemaine == 3 || $jourSemaine == 6) {
                $gestionCours->planifierCoursDuJour($date);
            }

            $seances = $gestionCours->getSeancesParJour($date);
            if (!empty($seances)) {
                $calendrier[$date] = $seances;
            } else {
                $calendrier[$date] = [];
            }
        }

        // Ajouter les clubs (abonnement + réservation)
        $reservationModel = new ReservationModel(Flight::db());
        $clubs = $reservationModel->getActivitesClubs($mois, $annee);
        foreach ($clubs as $jour => $activites) {
            $date = sprintf('%04d-%02d-%02d', $annee, $mois, $jour);
            foreach ($activites as $a) {
                $calendrier[$date][] = array_merge($a, ['type' => 'club']);
            }
        }

        Flight::render('gestion/edt', [
            'mois' => $mois,
            'annee' => $annee,
            'calendrier' => $calendrier
        ]);
    }

   public static function detailsJour() {
        $date = $_GET['date'] ?? null;
        $groupe = $_GET['groupe'] ?? null;

        if (!$date) {
            Flight::json(['html' => "<p class='text-danger'>Date manquante</p>"]);
            return;
        }

        $jourSemaine = date('w', strtotime($date)); // 3 = mercredi, 6 = samedi
        $mois = date('n', strtotime($date));
        $annee = date('Y', strtotime($date));
        $html = "";

        $gestionCours = new GestionCoursModel(Flight::db());

        if (in_array($jourSemaine, [3, 6])) {
            // Groupe obligatoire
            if (!$groupe) {
                Flight::json(['html' => "<p class='text-danger'>Le groupe est requis pour cette date.</p>"]);
                return;
            }

            // 1. Élèves
            $eleves = $gestionCours->getElevesDuGroupe($groupe, $mois, $annee);
            $html .= "<h6>Élèves du groupe $groupe</h6><ul>";
            foreach ($eleves as $e) {
                $html .= "<li>" . htmlspecialchars($e['nom']) . " " . htmlspecialchars($e['prenom']) . "</li>";
            }
            $html .= "</ul><hr>";

            // 2. Séances du groupe
            $seances = $gestionCours->getSeancesParJour($date);
            foreach ($seances as $s) {
                if ($s['groupe'] != $groupe) continue;

                $html .= "<p><strong>Heure :</strong> " . htmlspecialchars($s['heure_debut']) . " - " . htmlspecialchars($s['heure_fin']) . "</p>";
                $html .= "<p><strong>Discipline :</strong> " . htmlspecialchars($s['cours']) . "</p>";
                $html .= "<p><strong>Groupe :</strong> " . htmlspecialchars($s['groupe']) . "</p>";
                $html .= "<p><strong>Prof :</strong> " . htmlspecialchars($s['prof_nom']) . " " . htmlspecialchars($s['prof_prenom']) . "</p>";
                $html .= "<hr>";
            }
        } else {
            // Activités de club
            $reservationModel = new ReservationModel(Flight::db());
            $activites = $reservationModel->getActivitesClubsJour($date);

            foreach ($activites as $a) {
                $html .= "<h6>Club : " . htmlspecialchars($a['club_nom']) . "</h6>";
                $html .= "<p><strong>Discipline :</strong> " . htmlspecialchars($a['discipline']) . "</p>";
                $html .= "<p><strong>Contact :</strong> " . htmlspecialchars($a['contact']) . "</p>";
                $html .= "<p><strong>Participants :</strong> " . htmlspecialchars($a['nombre']) . "</p>";
                if (!empty($a['heure_debut']) && !empty($a['heure_fin'])) {
                    $html .= "<p><strong>Heure :</strong> " . htmlspecialchars($a['heure_debut']) . " - " . htmlspecialchars($a['heure_fin']) . "</p>";
                }
                $html .= "<hr>";
            }
        }

        if (empty($html)) {
            $html = "<p class='text-muted'>Aucune activité trouvée</p>";
        }

        Flight::json(['html' => $html]);
    }

}