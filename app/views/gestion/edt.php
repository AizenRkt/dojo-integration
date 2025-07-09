<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emploi du temps - Semaine <?= $semaine ?>/<?= $annee ?></title>
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/css/gestion/edt.css">
    <style>
        .time-slot {
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 6px;
            background: #f4f4f4;
            cursor: pointer;
            border-left: 5px solid #6c757d;
        }
        .slot-empty {
            font-style: italic;
            color: #999;
            padding: 5px;
        }
        #hoverBubble {
            position: absolute;
            display: none;
            background: white;
            border: 1px solid #ccc;
            padding: 8px;
            border-radius: 8px;
            z-index: 9999;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 0.9em;
            max-width: 300px;
        }
    </style>
</head>
<body>
<div id="app">
    <?= Flight::menuAdmin() ?>
    <div id="main">
        <main class="dashboard">
            <div class="schedule-dashboard">
                <div class="schedule-header">
                    <div class="week-navigation">
                        <a class="btn btn-secondary" href="?semaine=<?= $semaine - 1 ?>&annee=<?= $annee ?>">← Semaine précédente</a>
                        <h2 class="ms-3 me-3">Semaine <?= $semaine ?> - <?= $annee ?></h2>
                        <a class="btn btn-secondary" href="?semaine=<?= $semaine + 1 ?>&annee=<?= $annee ?>">Semaine suivante →</a>
                    </div>
                </div>

                <div class="days-header d-flex">
                    <?php
                    $start = new DateTime();
                    $start->setISODate($annee, $semaine);
                    $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                    for ($j = 0; $j < 7; $j++):
                        $jourDate = clone $start;
                        $jourDate->modify("+$j days");
                        ?>
                        <div class="day-header flex-fill text-center">
                            <h3><?= $jours[$j] ?></h3>
                            <span><?= $jourDate->format('d M') ?></span>
                        </div>
                    <?php endfor; ?>
                </div>

                <div class="schedule-grid d-flex">
                    <?php for ($j = 0; $j < 7; $j++):
                        $dateObj = clone $start;
                        $dateObj->modify("+$j days");
                        $date = $dateObj->format('Y-m-d');
                        $jourSemaine = $dateObj->format('w'); // 3 = mercredi, 6 = samedi
                        ?>
                        <div class="day-schedule flex-fill p-2 border-start">
                            <?php if (!empty($calendrier[$date])): ?>
                                <?php foreach ($calendrier[$date] as $item): ?>
                                    <?php
                                    $estSeance = isset($item['cours']);
                                    $estMercrediOuSamedi = in_array($jourSemaine, [3, 6]);
                                    $groupe = $item['groupe'] ?? null;
                                    ?>
                                    <div class="time-slot"
                                         <?= ($estSeance && $estMercrediOuSamedi && $groupe) ? 'onmouseenter="loadDetails(this)" onmouseleave="hideBubble()"' : '' ?>
                                         <?= ($estSeance && $estMercrediOuSamedi && $groupe) ? 'data-url="'.Flight::base().'/calendrier/details?date=' . $date . '&groupe=' . $groupe . '"' : '' ?>>
                                        <div><strong><?= htmlspecialchars($item['heure_debut'] ?? '—') ?> - <?= htmlspecialchars($item['heure_fin'] ?? '—') ?></strong></div>
                                        <div><?= htmlspecialchars($item['cours'] ?? $item['club_nom'] ?? 'Activité') ?></div>
                                        <?php if ($estSeance && $groupe): ?>
                                            <div>Groupe <?= htmlspecialchars($groupe) ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($item['prof_nom'])): ?>
                                            <div>Prof : <?= htmlspecialchars($item['prof_nom']) ?> <?= htmlspecialchars($item['prof_prenom']) ?></div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="slot-empty">Aucune activité</div>
                            <?php endif; ?>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </main>
    </div>
</div>

<div id="hoverBubble"></div>

<script>
    const bubble = document.getElementById('hoverBubble');

    function loadDetails(elem) {
        const url = elem.getAttribute('data-url');
        if (!url) return;

        fetch(url)
            .then(r => r.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const body = doc.querySelector('.card-body');
                if (body) {
                    const titre = document.createElement('div');
                    titre.innerHTML = '<strong>Les élèves du groupe</strong><hr>';
                    bubble.innerHTML = '';
                    bubble.appendChild(titre);
                    bubble.appendChild(body);
                    bubble.style.display = 'block';
                }

            });

        elem.addEventListener('mousemove', e => {
            bubble.style.left = e.pageX + 15 + 'px';
            bubble.style.top = e.pageY + 15 + 'px';
        });
    }

    function hideBubble() {
        bubble.style.display = 'none';
        bubble.innerHTML = '';
    }
</script>
</body>
</html>
