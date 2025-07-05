<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= !is_null($seance) ? 'Modifier une séance' : 'Insertion d’une séance' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0"><?= !is_null($seance) ? 'Modifier une séance' : 'Insertion d’une séance' ?></h3>
        </div>
        <div class="card-body">
            <?php if (isset($message)) : ?>
                <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>

            <form method="post" action="<?= !is_null($seance) ? '/updateSeance' : '/insertSeance' ?>">
                <?php if (!is_null($seance)) : ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($seance['id_seances']) ?>">
                <?php endif; ?>

                <div class="mb-3">
                    <label for="id_cours" class="form-label">Cours</label>
                    <select name="id_cours" id="id_cours" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($cours as $c) : ?>
                            <option value="<?= $c['id_cours'] ?>" <?= (!is_null($seance) && $seance['id_cours'] == $c['id_cours']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['label']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required
                           value="<?= !is_null($seance) ? htmlspecialchars($seance['date']) : '' ?>">
                </div>

                <?php if (is_null($seance)) : ?>
                    <div class="mb-3">
                        <label for="id_plage" class="form-label">Plage horaire</label>
                        <select name="id_plage" id="id_plage" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($plages as $p) : ?>
                                <?php if (in_array($p['heure_debut'], ['08:00:00', '13:00:00'])) : ?>
                                    <?php
                                        $label = ($p['heure_debut'] === '08:00:00') ? 'Matin' : 'Après-midi';
                                    ?>
                                    <option value="<?= $p['id'] ?>">
                                        <?= $label ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </select>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="id_prof" class="form-label">Professeur</label>
                    <select name="id_prof" id="id_prof" class="form-select" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($profs as $prof) : ?>
                            <option value="<?= $prof['id_prof'] ?>" <?= (!is_null($seance) && $seance['id_prof'] == $prof['id_prof']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($prof['nom']) ?> <?= htmlspecialchars($prof['prenom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <?= !is_null($seance) ? 'Mettre à jour' : 'Ajouter' ?>
                </button>
                <?php if (!is_null($seance)) : ?>
                    <a href="/formSeance" class="btn btn-secondary ms-2">Annuler</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

</body>
</html>