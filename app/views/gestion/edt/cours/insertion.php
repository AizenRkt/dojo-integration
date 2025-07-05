<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= isset($cours) && $cours ? 'Modifier un cours' : 'Insertion d’un cours' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><?= isset($cours) && $cours ? 'Modifier un cours' : 'Insertion d’un cours' ?></h3>
        </div>
        <div class="card-body">
            <?php if (isset($message)) : ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="post" action="<?= isset($cours) && $cours ? '/updateCours' : '/insertCours' ?>">
                <?php if (isset($cours) && $cours): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($cours['id_cours']) ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="label" class="form-label">Nom du cours</label>
                    <input type="text" name="label" id="label" class="form-control" required
                           value="<?= isset($cours['label']) ? htmlspecialchars($cours['label']) : '' ?>">
                </div>

                <button type="submit" class="btn btn-success">
                    <?= isset($cours) && $cours ? 'Mettre à jour' : 'Ajouter' ?>
                </button>
                <?php if (isset($cours) && $cours): ?>
                    <a href="/formCours" class="btn btn-secondary ms-2">Annuler</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

</body>
</html>