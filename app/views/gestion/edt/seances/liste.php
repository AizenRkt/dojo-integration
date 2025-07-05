<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des séances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Liste des séances</h2>
        <a href="/formSeance" class="btn btn-success">Créer une nouvelle séance</a>
    </div>

    <?php if (!empty($message)) : ?>
        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Cours</th>
                        <th>Date</th>
                        <th>Plage horaire</th>
                        <th>Professeur</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($seances as $s) : ?>
                        <tr>
                            <td><?= $s['id_seances'] ?></td>
                            <td><?= htmlspecialchars($s['nom_cours']) ?></td>
                            <td><?= htmlspecialchars($s['date']) ?></td>
                            <td><?= htmlspecialchars($s['heure_debut']) ?> - <?= htmlspecialchars($s['heure_fin']) ?></td>
                            <td><?= htmlspecialchars($s['nom_prof']) ?> <?= htmlspecialchars($s['prenom_prof']) ?></td>
                            <td class="text-center">
                                <a href="/formSeance?id=<?= $s['id_seances'] ?>" class="btn btn-sm btn-warning">Modifier</a>
                                <!-- <a href="/deleteSeance?id=<?= $s['id_seances'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette séance ?')">Supprimer</a> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($seances)) : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">Aucune séance trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>