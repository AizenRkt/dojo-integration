<?php
function estMercrediOuSamedi($jour, $mois, $annee) {
    $date = DateTime::createFromFormat('Y-n-j', "$annee-$mois-$jour");
    $jourSemaine = $date->format('N'); // 1 = lundi, ..., 7 = dimanche
    return in_array($jourSemaine, [3, 6]); // 3 = mercredi, 6 = samedi
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Emploi du temps - <?= "$mois/$annee" ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calendar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .day {
            background: #f8f9fa;
            padding: 10px;
            border: 1px solid #ccc;
            min-width: 250px;
            flex: 1 1 calc(50% - 10px);
        }

        .day h6 {
            margin-top: 0;
            font-weight: bold;
        }

        .seance {
            font-size: 0.85rem;
            margin-bottom: 8px;
            padding: 4px;
            background-color: #e2e6ea;
            border-radius: 4px;
        }

        .details-link {
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h2>Calendrier de <?= $mois ?>/<?= $annee ?> (Mercredi & Samedi uniquement)</h2>

    <div class="mb-3">
        <a class="btn btn-secondary" href="?mois=<?= ($mois == 1 ? 12 : $mois - 1) ?>&annee=<?= ($mois == 1 ? $annee - 1 : $annee) ?>">← Mois précédent</a>
        <a class="btn btn-secondary ms-2" href="?mois=<?= ($mois == 12 ? 1 : $mois + 1) ?>&annee=<?= ($mois == 12 ? $annee + 1 : $annee) ?>">Mois suivant →</a>
    </div>

    <div class="calendar">
        <?php for ($i = 1; $i <= 31; $i++): ?>
            <?php if (checkdate($mois, $i, $annee) && estMercrediOuSamedi($i, $mois, $annee)): ?>
                <div class="day">
                    <h6><?= $i ?>/<?= $mois ?></h6>

                    <?php if (isset($calendrier[$i])): ?>
                        <?php foreach ($calendrier[$i] as $s): ?>
                            <div class="seance">
                                <?= htmlspecialchars($s['heure_debut']) ?> - <?= htmlspecialchars($s['heure_fin']) ?><br>
                                Groupe <?= htmlspecialchars($s['groupe']) ?><br>
                                <?= htmlspecialchars($s['cours']) ?><br>
                                Prof : <?= htmlspecialchars($s['prof_nom']) ?> <?= htmlspecialchars($s['prof_prenom']) ?><br>
                                <a href="/calendrier/details?date=<?= "$annee-$mois-$i" ?>&groupe=<?= $s['groupe'] ?>" class="details-link">Détails</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <small>Aucune séance</small>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
</body>
</html>
