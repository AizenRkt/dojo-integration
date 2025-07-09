<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Réservations</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/table-datatable-jquery.css">
</head>
<body>
<div id="app">
    <?= Flight::menuAdmin() ?>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Liste des Réservations</h3>
        </div>

        <div class="page-content">
            <!-- Filtres -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="min-date" class="form-label">Date réservée - De :</label>
                    <input type="date" id="min-date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="max-date" class="form-label">Date réservée - À :</label>
                    <input type="date" id="max-date" class="form-control">
                </div>
                <div class="col-md-4 offset-md-2">
                    <label for="globalSearch" class="form-label">Recherche globale :</label>
                    <input type="text" id="globalSearch" class="form-control" placeholder="Rechercher...">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Réservations enregistrées</h4>
                            <a href="<?= Flight::base() ?>/reservation/insert" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> nouvelle réservation
                            </a>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($message)): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?= htmlspecialchars($message) ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table class="table table-hover" id="table1">
                                    <thead>
                                        <tr>
                                            <th>ID Club</th>
                                            <th>Date de réservation</th>
                                            <th>Date réservée</th>
                                            <th>Horaires</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reservations as $res): ?>
                                            <tr>
                                                <td><?= $res['id_club'] ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($res['date_reservation'])) ?></td>
                                                <td><?= date('d/m/Y', strtotime($res['date_reserve'])) ?></td>
                                                <td>
                                                    <span class="badge bg-info">
                                                        <?= $res['heure_debut'] ?> - <?= $res['heure_fin'] ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="<?= Flight::base() ?>/reservation/<?= $res['id_reservation'] ?>"
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="bi bi-eye"></i> Voir
                                                        </a>
                                                        <a href="<?= Flight::base() ?>/reservation/delete/<?= $res['id_reservation'] ?>"
                                                           class="btn btn-sm btn-outline-danger"
                                                           onclick="return confirm('Confirmer la suppression ?')">
                                                            <i class="bi bi-trash"></i> Supprimer
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Scripts -->
<script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
<script src="<?= Flight::base() ?>/public/assets/extensions/jquery/jquery.min.js"></script>
<script src="<?= Flight::base() ?>/public/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= Flight::base() ?>/public/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= Flight::base() ?>/public/assets/static/js/pages/datatables.js"></script>

<script>
    $(document).ready(function () {
        // Initialisation DataTable
        let table = $('#table1').DataTable();

        // Recherche globale
        $('#globalSearch').on('keyup', function () {
            table.search(this.value).draw();
        });

        // Filtre personnalisé par date
        $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
            let min = $('#min-date').val();
            let max = $('#max-date').val();
            let date = data[2]; // Colonne "Date réservée"

            if (date) {
                let parts = date.split('/');
                if (parts.length === 3) {
                    date = parts[2] + '-' + parts[1] + '-' + parts[0];
                }
            }

            let dateValue = new Date(date);

            if (
                (!min || new Date(min) <= dateValue) &&
                (!max || new Date(max) >= dateValue)
            ) {
                return true;
            }
            return false;
        });

        // Réagir aux changements de date
        $('#min-date, #max-date').on('change', function () {
            table.draw();
        });

        // Initialiser les dates du mois en cours
        const now = new Date();
        const firstDay = new Date(now.getFullYear(), now.getMonth(), 1).toISOString().split("T")[0];
        const lastDay = new Date(now.getFullYear(), now.getMonth() + 1, 0).toISOString().split("T")[0];
        $('#min-date').val(firstDay);
        $('#max-date').val(lastDay);
        table.draw();
    });
</script>
</body>
</html>