<?php

        namespace app\models\GroupeModels;

        use PDO;
        use Flight;

        class GroupeModel {

            public function insert($nom_responsable, $contact, $nombre, $discipline) {
                try {
                    $db = Flight::db();
                    $stmt = $db->prepare("INSERT INTO club_groupe (nom_responsable, contact, nombre, discipline) VALUES (:nom_responsable, :contact, :nombre, :discipline)");
                    $stmt->execute([
                        ':nom_responsable' => $nom_responsable,
                        ':contact' => $contact,
                        ':nombre' => $nombre,
                        ':discipline' => $discipline
                    ]);
                    return "Insertion réussie !";
                } catch (\PDOException $e) {
                    return "Erreur : " . $e->getMessage();
                }
            }

            public function getAll() {
                try {
                    $db = Flight::db();
                    $stmt = $db->query("SELECT * FROM club_groupe");
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (\PDOException $e) {
                    return [];
                }
            }

            public function getById($id) {
                try {
                    $db = Flight::db();
                    $stmt = $db->prepare("SELECT * FROM club_groupe WHERE id = :id");
                    $stmt->execute([':id' => $id]);
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                } catch (\PDOException $e) {
                    return null;
                }
            }

            public function delete($id) {
                try {
                    $db = Flight::db();
                    $stmt = $db->prepare("DELETE FROM club_groupe WHERE id = :id");
                    $stmt->execute([':id' => $id]);
                    return $stmt->rowCount() > 0 ? "Suppression réussie." : "Aucun groupe trouvé.";
                } catch (\PDOException $e) {
                    return "Erreur de suppression : " . $e->getMessage();
                }
            }

            public function update($id, $nom_responsable, $contact, $nombre, $discipline) {
                try {
                    $db = Flight::db();
                    $stmt = $db->prepare("UPDATE club_groupe SET nom_responsable = :nom_responsable, contact = :contact, nombre = :nombre, discipline = :discipline WHERE id = :id");
                    $stmt->execute([
                        ':nom_responsable' => $nom_responsable,
                        ':contact' => $contact,
                        ':nombre' => $nombre,
                        ':discipline' => $discipline,
                        ':id' => $id
                    ]);
                    return $stmt->rowCount() > 0 ? "Mise à jour réussie." : "Aucune modification effectuée.";
                } catch (\PDOException $e) {
                    return "Erreur de mise à jour : " . $e->getMessage();
                }
            }

            // Nouvelles méthodes pour le suivi des clubs
            public function getScheduleData($year = null, $month = null) {
                try {
                    $db = Flight::db();

                    if (!$year) $year = date('Y');
                    if (!$month) $month = date('m');

                    // S'assurer que le mois est sur 2 chiffres
                    $month = str_pad($month, 2, '0', STR_PAD_LEFT);

                    $startDate = sprintf('%04d-%02d-01', $year, $month);
                    $endDate = date('Y-m-t', strtotime($startDate));

                    $stmt = $db->prepare("
            SELECT
                TO_CHAR(r.date_reserve, 'YYYY-MM-DD') as date_reserve,
                r.heure_debut,
                r.heure_fin,
                g.nom_responsable as group_name,
                g.discipline,
                g.nombre as participants
            FROM reservation r
            JOIN club_groupe g ON r.id_club = g.id
            WHERE r.date_reserve BETWEEN :start_date AND :end_date
            AND r.valeur = 'confirme'
            ORDER BY r.date_reserve, r.heure_debut
        ");

                    $stmt->execute([
                        ':start_date' => $startDate,
                        ':end_date' => $endDate
                    ]);

                    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                } catch (\PDOException $e) {
                    return [];
                }
            }
            public function getDayAvailability($date) {
                try {
                    $db = Flight::db();

                    // Créneaux standard du dojo
                    $standardSlots = [
                        ['start' => '08:00', 'end' => '10:00'],
                        ['start' => '10:30', 'end' => '12:00'],
                        ['start' => '14:00', 'end' => '16:00'],
                        ['start' => '16:30', 'end' => '18:00'],
                        ['start' => '18:30', 'end' => '20:00']
                    ];

                    // Récupérer les réservations du jour
                    $stmt = $db->prepare("
                        SELECT heure_debut, heure_fin 
                        FROM reservation 
                        WHERE date_reserve = :date AND valeur = 'confirme'
                        ORDER BY heure_debut
                    ");
                    $stmt->execute([':date' => $date]);
                    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $occupiedSlots = [];
                    $availableSlots = [];

                    foreach ($standardSlots as $slot) {
                        $isOccupied = false;
                        foreach ($reservations as $reservation) {
                            if ($reservation['heure_debut'] <= $slot['start'] && $reservation['heure_fin'] >= $slot['end']) {
                                $isOccupied = true;
                                break;
                            }
                        }

                        if ($isOccupied) {
                            $occupiedSlots[] = $slot['start'] . ' - ' . $slot['end'];
                        } else {
                            $availableSlots[] = $slot['start'] . ' - ' . $slot['end'];
                        }
                    }

                    return [
                        'occupied' => $occupiedSlots,
                        'available' => $availableSlots
                    ];
                } catch (\PDOException $e) {
                    return ['occupied' => [], 'available' => []];
                }
            }

            public function getMonthlyStats($year, $month) {
                try {
                    $db = Flight::db();

                    // Correction du format de date
                    $startDate = sprintf('%04d-%02d-01', $year, $month);
                    $endDate = date('Y-m-t', strtotime($startDate));

                    $stmt = $db->prepare("
            SELECT 
                DATE(r.date_reserve) as reservation_date,
                COUNT(*) as total_reservations,
                SUM(g.nombre) as total_participants
            FROM reservation r
            JOIN club_groupe g ON r.id_club = g.id
            WHERE r.date_reserve BETWEEN :start_date AND :end_date
            AND r.valeur = 'confirme'
            GROUP BY DATE(r.date_reserve)
        ");

                    $stmt->execute([
                        ':start_date' => $startDate,
                        ':end_date' => $endDate
                    ]);

                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (\PDOException $e) {
                    return [];
                }
            }
        }