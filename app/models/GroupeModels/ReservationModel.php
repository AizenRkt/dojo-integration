<?php

namespace app\models\GroupeModels;

use PDO;
use Flight;
use Exception;

class ReservationModel {

    public function insert(
        int $id_club,
        string $date_reservation,
        string $date_reserve,
        string $heure_debut,
        string $heure_fin
    ): int {
        $db = Flight::db();

        $sql = "
        INSERT INTO reservation
            (id_club, date_reservation, date_reserve, heure_debut, heure_fin)
        VALUES
            (:id_club, :date_reservation, :date_reserve, :heure_debut, :heure_fin)
        RETURNING id_reservation
    ";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id_club'          => $id_club,
            ':date_reservation' => $date_reservation,
            ':date_reserve'     => $date_reserve,
            ':heure_debut'      => $heure_debut,
            ':heure_fin'        => $heure_fin
        ]);

        return (int) $stmt->fetchColumn();
    }


    public function getAll() {
        try {
            $db = Flight::db();
            $stmt = $db->query("SELECT * FROM reservation");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return [];
        }
    }

    public function getById($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("SELECT * FROM reservation WHERE id_reservation = :id");
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function update($id, $id_club, $date_reservation, $date_reserve, $heure_debut, $heure_fin) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("
                UPDATE reservation SET 
                    id_club = :id_club, 
                    date_reservation = :date_reservation, 
                    date_reserve = :date_reserve, 
                    heure_debut = :heure_debut, 
                    heure_fin = :heure_fin 
                WHERE id_reservation = :id
            ");
            $stmt->execute([
                ':id' => $id,
                ':id_club' => $id_club,
                ':date_reservation' => $date_reservation,
                ':date_reserve' => $date_reserve,
                ':heure_debut' => $heure_debut,
                ':heure_fin' => $heure_fin,
            ]);
            return "Mise à jour réussie.";
        } catch (\PDOException $e) {
            return "Erreur de mise à jour : " . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("DELETE FROM reservation WHERE id_reservation = :id");
            $stmt->execute([':id' => $id]);
            return "Suppression réussie.";
        } catch (\PDOException $e) {
            return "Erreur de suppression : " . $e->getMessage();
        }
    }

    public function getGlobalFreeSlotsForDay(string $date, string $locale = 'fr_FR'): array
    {
        $db   = Flight::db();
        $jour = strtolower($this->jourDeSemaine($date, $locale));

        // Fetch horaires for the day
        $stmt = $db->prepare('SELECT debut, fin FROM horaire WHERE LOWER(jour) = :jour ORDER BY debut LIMIT 1');
        $stmt->execute([':jour' => $jour]);
        $horaire = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$horaire) {
            return []; // closed that day
        }

        // Fetch all reservations that day
        $stmt = $db->prepare('SELECT heure_debut AS start, heure_fin AS end FROM reservation WHERE date_reserve = :date ORDER BY heure_debut');
        $stmt->execute([':date' => $date]);
        $reserved = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$reserved) {
            return [['start' => $horaire['debut'], 'end' => $horaire['fin']]];
        }

        $reserved = $this->mergeIntervals($reserved);

        $free = [];
        $cursor = $horaire['debut'];

        foreach ($reserved as $slot) {
            if ($slot['start'] > $cursor) {
                $free[] = ['start' => $cursor, 'end' => $slot['start']];
            }
            $cursor = max($cursor, $slot['end']);
        }

        if ($cursor < $horaire['fin']) {
            $free[] = ['start' => $cursor, 'end' => $horaire['fin']];
        }

        return $free;
    }

    private function jourDeSemaine($date): string
    {
        $dayOfWeek = strtolower(date('l', strtotime($date)));

        $mapping = [
            'monday'    => 'lundi',
            'tuesday'   => 'mardi',
            'wednesday' => 'mercredi',
            'thursday'  => 'jeudi',
            'friday'    => 'vendredi',
            'saturday'  => 'samedi',
            'sunday'    => 'dimanche'
        ];

        return $mapping[$dayOfWeek] ?? $dayOfWeek;
    }

    private function mergeIntervals(array $intervals): array
    {
        usort($intervals, fn($a, $b) => $a['start'] <=> $b['start']);
        $merged = [];

        foreach ($intervals as $interval) {
            if (empty($merged) || $interval['start'] > $merged[array_key_last($merged)]['end']) {
                $merged[] = $interval;
            } else {
                $merged[array_key_last($merged)]['end'] = max($merged[array_key_last($merged)]['end'], $interval['end']);
            }
        }

        return $merged;
    }
    public function getByDate($date) {
        try {
            $db = Flight::db();
            $stmt = $db->prepare("
                SELECT r.*, cg.nom_responsable, cg.discipline, cg.nombre 
                FROM reservation r 
                JOIN club_groupe cg ON r.id_club = cg.id 
                WHERE r.date_reserve = ? 
                ORDER BY r.heure_debut
            ");
            $stmt->execute([$date]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error getting reservations by date: " . $e->getMessage());
            return [];
        }
    }

    public function getActivitesClubs($mois, $annee) {
        $resultats = [];
        $db = Flight::db();
        // --- 1. Abonnements actifs pour chaque jour du mois ---
        $sqlAbonnement = "
            SELECT 
                a.jour,
                a.id_club,
                c.nom_responsable AS club_nom,
                c.discipline,
                'abonnement' AS type
            FROM abonnement a
            JOIN club_groupe c ON c.id = a.id_club
            WHERE a.mois = :mois AND a.annee = :annee AND a.actif = true
        ";
        $stmt1 = $db->prepare($sqlAbonnement);
        $stmt1->execute([':mois' => $mois, ':annee' => $annee]);
        $abonnements = $stmt1->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($abonnements as $a) {
            // pour chaque jour du mois qui correspond au jour d’abonnement
            for ($i = 1; $i <= 31; $i++) {
                if (!checkdate($mois, $i, $annee)) continue;
                $date = new \DateTime("$annee-$mois-$i");
                if ($date->format('w') == $a['jour']) { // 0 = dimanche, 1 = lundi, etc.
                    $jour = intval($date->format('j'));
                    $resultats[$jour][] = $a;
                }
            }
        }

        // --- 2. Réservations confirmées ---
        $sqlResa = "
            SELECT 
                r.date_reserve,
                r.heure_debut,
                r.heure_fin,
                c.nom_responsable AS club_nom,
                c.discipline,
                'reservation' AS type
            FROM reservation r
            JOIN club_groupe c ON r.id_club = c.id
            WHERE 
                r.valeur = 'confirme' or r.valeur = 'payee' AND
                EXTRACT(MONTH FROM r.date_reserve) = :mois AND
                EXTRACT(YEAR FROM r.date_reserve) = :annee
        ";
        $stmt2 = $db->prepare($sqlResa);
        $stmt2->execute([':mois' => $mois, ':annee' => $annee]);
        $reservations = $stmt2->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($reservations as $r) {
            $jour = intval(date('j', strtotime($r['date_reserve'])));
            $resultats[$jour][] = $r;
        }

        return $resultats;
    }

    public function getActivitesClubsJour($date) {
        $db = Flight::db();
        $resultats = [];

        $jour = intval((new \DateTime($date))->format('w')); // 0 = dimanche, 1 = lundi
        $mois = intval((new \DateTime($date))->format('n'));
        $annee = intval((new \DateTime($date))->format('Y'));

        // 1. Abonnements actifs pour ce jour de semaine
        $sqlAbonnement = "
            SELECT 
                :date AS date_activite,
                a.id_club,
                c.nom_responsable AS club_nom,
                c.discipline,
                c.contact,
                c.nombre,
                NULL AS heure_debut,
                NULL AS heure_fin,
                'abonnement' AS type
            FROM abonnement a
            JOIN club_groupe c ON c.id = a.id_club
            WHERE 
                a.mois = :mois 
                AND a.annee = :annee 
                AND a.actif = true
                AND a.jour = :jour
        ";
        $stmt1 = $db->prepare($sqlAbonnement);
        $stmt1->execute([
            ':date' => $date,
            ':mois' => $mois,
            ':annee' => $annee,
            ':jour' => $jour
        ]);
        $abonnements = $stmt1->fetchAll(\PDO::FETCH_ASSOC);

        $resultats = array_merge($resultats, $abonnements);

        // 2. Réservations confirmées à cette date
        $sqlResa = "
            SELECT 
                r.date_reserve AS date_activite,
                r.heure_debut,
                r.heure_fin,
                c.nom_responsable AS club_nom,
                c.discipline,
                c.contact,
                c.nombre,
                'reservation' AS type
            FROM reservation r
            JOIN club_groupe c ON r.id_club = c.id
            WHERE 
                r.valeur = 'confirme' or r.valeur = 'payee'
                AND r.date_reserve = :date
        ";
        $stmt2 = $db->prepare($sqlResa);
        $stmt2->execute([':date' => $date]);
        $reservations = $stmt2->fetchAll(\PDO::FETCH_ASSOC);

        $resultats = array_merge($resultats, $reservations);

        return $resultats;
    }

}
