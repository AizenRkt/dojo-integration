<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emploi du temps mensuel</title>
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .calendar {
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
        }
        .calendar-header, .calendar-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }
        .day-name, .calendar-day {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            text-align: left;
        }
        .calendar-day {
            min-height: 100px;
            position: relative;
        }
        .calendar-day.other-month {
            background-color: #f0f0f0;
        }
        .time-slot {
            border: 1px solid #ccc;
            border-left: 4px solid #0d6efd;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
            padding: 0.25rem 0.5rem;
            background-color: #f8f9fa;
            cursor: pointer;
        }
        .time-slot:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
<div id="app">
    <?= Flight::menuAdmin() ?>
    <div id="main">
        <div class="container mt-4">
            <h3 class="mb-4">Emploi du temps - <?= DateTime::createFromFormat('!m', $mois)->format('F') ?> <?= $annee ?></h3>

            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-outline-secondary" href="?mois=<?= $mois == 1 ? 12 : $mois - 1 ?>&annee=<?= $mois == 1 ? $annee - 1 : $annee ?>">← Mois précédent</a>
                <a class="btn btn-outline-secondary" href="?mois=<?= $mois == 12 ? 1 : $mois + 1 ?>&annee=<?= $mois == 12 ? $annee + 1 : $annee ?>">Mois suivant →</a>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="calendar">
                        <div class="calendar-header">
                            <div class="day-name">Lun</div>
                            <div class="day-name">Mar</div>
                            <div class="day-name">Mer</div>
                            <div class="day-name">Jeu</div>
                            <div class="day-name">Ven</div>
                            <div class="day-name">Sam</div>
                            <div class="day-name">Dim</div>
                        </div>
                        <div class="calendar-body">
                            <?php
                            $firstDay = new DateTime("$annee-$mois-01");
                            $startDay = clone $firstDay;
                            $weekday = (int)$firstDay->format('N');
                            $startDay->modify('-' . ($weekday - 1) . ' days');
                            $daysShown = 42;

                            for ($i = 0; $i < $daysShown; $i++):
                                $currentDate = clone $startDay;
                                $currentDate->modify("+$i days");
                                $dayStr = $currentDate->format('Y-m-d');
                                $dayNum = $currentDate->format('j');
                                $inMonth = (int)$currentDate->format('n') === $mois;
                                $jourSemaine = (int)$currentDate->format('w');

                                $groupe = null;
                                if (!empty($calendrier[$dayStr])) {
                                    foreach ($calendrier[$dayStr] as $item) {
                                        if (!empty($item['groupe'])) {
                                            $groupe = $item['groupe'];
                                            break;
                                        }
                                    }
                                }
                            ?>
                            <div class="calendar-day <?= $inMonth ? '' : 'other-month' ?>"
                                 onclick="loadDetails('<?= $dayStr ?>'<?= ($jourSemaine == 3 || $jourSemaine == 6) && $groupe ? ", '$groupe'" : '' ?>)">
                                <div><strong><?= $dayNum ?></strong></div>
                                <?php if (!empty($calendrier[$dayStr])): ?>
                                    <?php foreach ($calendrier[$dayStr] as $item): ?>
                                        <div class="time-slot">
                                            <div><strong><?= htmlspecialchars($item['heure_debut'] ?? '') ?> - <?= htmlspecialchars($item['heure_fin'] ?? '') ?></strong></div>
                                            <div><?= htmlspecialchars($item['cours'] ?? $item['club_nom'] ?? 'Activité') ?></div>
                                            <?php if (!empty($item['groupe'])): ?>
                                                <div>Groupe <?= htmlspecialchars($item['groupe']) ?></div>
                                            <?php endif; ?>
                                            <!-- Professeur retiré de l'affichage du calendrier -->
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Détails du jour</h5>
                            <div class="text-muted" id="selectedDate">Sélectionnez une date</div>
                        </div>
                        <div class="card-body" id="detailsContent">
                            <p class="text-muted">Cliquez sur un jour pour voir les détails.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function loadDetails(date, groupe = null) {
        document.getElementById('selectedDate').innerText = date;

        let url = "<?= Flight::base() ?>/edt/details?date=" + date;
        if (groupe !== null) {
            url += "&groupe=" + encodeURIComponent(groupe);
        }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailsContent').innerHTML = data.html || "<p class='text-muted'>Aucune donnée</p>";
            })
            .catch(() => {
                document.getElementById('detailsContent').innerHTML = "<p class='text-danger'>Erreur lors du chargement.</p>";
            });
    }
</script>
</body>
</html>