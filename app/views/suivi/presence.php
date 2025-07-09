<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Suivi de présence</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        .user-type-btn.active {
            background-color: var(--bs-primary) !important;
            color: #fff !important;
            border-color: var(--bs-primary) !important;
        }
        .user-type-btn {
            margin-right: 0.5rem;
        }
        .person-item.active {
            border: 2px solid var(--bs-primary);
            background-color: #e9f1ff;
        }
        .card-body .form-label {
            font-weight: 500;
        }
        .card .card-header h5 {
            margin-bottom: 0;
        }
    </style>
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
            <h3>Suivi de Présence</h3>
        </div>

        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div>
                                <h5 class="mb-0">Recherche par période</h5>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="date-debut" class="form-label">Date de début</label>
                                    <input type="date" class="form-control" id="date-debut" name="date_debut">
                                </div>
                                <div class="col-md-4">
                                    <label for="date-fin" class="form-label">Date de fin</label>
                                    <input type="date" class="form-control" id="date-fin" name="date_fin">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="button" class="btn btn-success">
                                        <i class="fas fa-search"></i> Rechercher
                                    </button>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Liste des élèves (<span id="total-people">0</span>)</h6>
                                        </div>
                                        <div class="card-body">
                                            <table id="absences-table" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Nombre d'absences</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbody-absences">
                                                <!-- Rows will be filled by JS -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Détails d'absence - <span class="selected-person-name">Sélectionnez un élève</span></h6>
                                        </div>
                                        <div class="card-body">
                                            <div id="absence-details">
                                                <p class="text-muted">Veuillez sélectionner un élève pour voir les détails de ses absences.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- JS -->
<script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
<script src="<?= Flight::base() ?>/public/assets/extensions/jquery/jquery.min.js"></script>
<script src="<?= Flight::base() ?>/public/assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= Flight::base() ?>/public/assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

<script>
    let dataTable;

    // Fonction pour initialiser DataTable
    function initDataTable() {
        try {
            // Safely destroy if exists
            if ($.fn.DataTable.isDataTable('#absences-table')) {
                $('#absences-table').DataTable().destroy();
            }

            // Make sure table has content before initializing
            if (document.querySelector('#tbody-absences tr')) {
                dataTable = $('#absences-table').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
                    },
                    pageLength: 10,
                    searching: true,
                    ordering: true,
                    info: true,
                    paging: true
                });
            }
        } catch (error) {
            console.error("DataTable initialization error:", error);
        }
    }

    // Gestion du clic sur le bouton "Rechercher"
    // Gestion du clic sur le bouton "Rechercher"
    document.querySelector(".btn.btn-success").addEventListener("click", function () {
        const dateDebut = document.getElementById('date-debut').value;
        const dateFin = document.getElementById('date-fin').value;

        // Build URL with date parameters
        let url = `<?= Flight::base() ?>/api/suivi-presence/absences`;
        const params = new URLSearchParams();

        if (dateDebut) {
            params.append('date_debut', dateDebut);
        }
        if (dateFin) {
            params.append('date_fin', dateFin);
        }

        if (params.toString()) {
            url += '?' + params.toString();
        }

        fetch(url)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    if ($.fn.DataTable.isDataTable('#absences-table')) {
                        $('#absences-table').DataTable().destroy();
                    }

                    // Update tbody
                    const tbody = document.getElementById("tbody-absences");
                    tbody.innerHTML = "";
                    res.data.forEach(eleve => {
                        const tr = document.createElement("tr");
                        tr.className = "person-item";
                        tr.dataset.id = eleve.id_eleve;
                        tr.innerHTML = `
                        <td>${eleve.nom} ${eleve.prenom}</td>
                        <td>${eleve.nb_absences > 0 ? eleve.nb_absences : '0'}</td>
                      `;
                        tbody.appendChild(tr);
                    });

                    // Update total count
                    document.getElementById('total-people').textContent = res.data.length;

                    initDataTable();
                    attachRowClickEvents();
                }
            })
            .catch(err => {
                console.error(err);
                alert("Erreur réseau.");
            });
    });

    // Fonction pour attacher les événements de clic sur les lignes
    function attachRowClickEvents() {
        document.querySelectorAll('.person-item').forEach(row => {
            row.addEventListener('click', function() {
                document.querySelectorAll('.person-item').forEach(r => r.classList.remove('active'));
                this.classList.add('active');

                const idEleve = this.dataset.id;
                const nom = this.cells[0].textContent;

                document.querySelector('.selected-person-name').textContent = nom;
                loadAbsenceDetails(idEleve);
            });
        });
    }

    // Fonction pour charger les détails d'absence
    function loadAbsenceDetails(idEleve) {
        const dateDebut = document.getElementById('date-debut').value;
        const dateFin = document.getElementById('date-fin').value;

        fetch(`<?= Flight::base() ?>/api/suivi-presence/details?id_eleve=${idEleve}&date_debut=${dateDebut}&date_fin=${dateFin}`)
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    let html = '<div class="table-responsive"><table class="table table-sm"><thead><tr><th>Date</th><th>Cours</th><th>Remarque</th></tr></thead><tbody>';

                    if (res.details.length > 0) {
                        res.details.forEach(detail => {
                            html += `<tr>
                              <td>${detail.date}</td>
                              <td>${detail.cours}</td>
                              <td>${detail.remarque || '-'}</td>
                            </tr>`;
                        });
                    } else {
                        html += '<tr><td colspan="3" class="text-center text-muted">Aucune absence trouvée</td></tr>';
                    }

                    html += '</tbody></table></div>';
                    document.getElementById('absence-details').innerHTML = html;
                }
            })
            .catch(err => {
                console.error(err);
                document.getElementById('absence-details').innerHTML = '<p class="text-danger">Erreur lors du chargement des détails</p>';
            });
    }

    // Initialisation au chargement
    document.addEventListener('DOMContentLoaded', function() {
        // Existing initializations...
        initDataTable();
        attachRowClickEvents();

        // Trigger fetch to load students immediately
        document.querySelector(".btn.btn-success").click();
    });
</script>
</body>
</html>