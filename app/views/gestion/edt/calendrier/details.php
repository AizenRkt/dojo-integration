<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du groupe <?= htmlspecialchars($groupe) ?> - <?= htmlspecialchars($date) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Groupe <?= htmlspecialchars($groupe) ?> - <?= htmlspecialchars($date) ?></h3>

    <div class="row mt-4">
        <div class="col-md-6">
            <h5>👥 Élèves du groupe</h5>
            <?php if (!empty($eleves)): ?>
                <ul class="list-group">
                    <?php foreach ($eleves as $e): ?>
                        <li class="list-group-item"><?= htmlspecialchars($e['nom']) ?> <?= htmlspecialchars($e['prenom']) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun élève trouvé.</p>
            <?php endif; ?>
        </div>
    </div>

    <a href="/calendrier?mois=<?= date('n', strtotime($date)) ?>&annee=<?= date('Y', strtotime($date)) ?>" class="btn btn-secondary mt-4">← Retour au calendrier</a>
</div>
</body>
</html>