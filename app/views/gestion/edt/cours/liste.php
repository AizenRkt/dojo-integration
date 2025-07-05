<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Liste des cours</h3>
        </div>
        <div class="card-body">
            <?php if (isset($message)) : ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nom du cours</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($cours)) : ?>
                        <?php foreach ($cours as $c) : ?>
                            <tr>
                                <td><?= htmlspecialchars($c['id_cours']) ?></td>
                                <td><?= htmlspecialchars($c['label']) ?></td>
                                <td>
                                    <a href="/formCours?id=<?= urlencode($c['id_cours']) ?>" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="/deleteCours?id=<?= urlencode($c['id_cours']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce cours ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr><td colspan="3" class="text-center">Aucun cours disponible</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <a href="/formCours" class="btn btn-primary mt-3">Ajouter un nouveau cours</a>
        </div>
    </div>
</div>

</body>
</html>