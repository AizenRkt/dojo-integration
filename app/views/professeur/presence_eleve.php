<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présence des Élèves - Dojo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <style>
        body { background-color: #f2f7ff; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        h1, h2, h3, h4, h5, h6, .card-header, .btn { font-family: 'Outfit', sans-serif; }
        .page-heading h3 { font-weight: 600; color: #25396f; font-size: 1.8rem; }
        .btn-primary { background-color: #435ebe; border-color: #435ebe; box-shadow: 0 2px 6px rgba(67, 94, 190, 0.5); transition: all 0.3s ease; }
        .btn-primary:hover { background-color: #3950a2; border-color: #3950a2; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(67, 94, 190, 0.6); }
        .card { border: none; box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1); border-radius: 12px; transition: all 0.3s ease; }
        .card:hover { box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15); }
        .course-info { background-color: #435ebe; color: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 4px 15px rgba(67, 94, 190, 0.3); }
        .course-info h4 { color: white; margin-bottom: 0; font-weight: 600; }
        .course-info p { color: rgba(255, 255, 255, 0.8); margin-bottom: 0.5rem; }
        .form-select, .form-control { border-radius: 8px; border: 1px solid #dce7f1; padding: 0.6rem 1rem; box-shadow: none; transition: all 0.3s ease; }
        .form-select:focus, .form-control:focus { border-color: #435ebe; box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.25); }
        .form-check-input:checked { background-color: #435ebe; border-color: #435ebe; }
        .table th { font-weight: 600; color: #25396f; border-bottom-width: 1px; }
        .table td { vertical-align: middle; }
        .no-courses { text-align: center; padding: 3rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 15px; margin: 2rem 0; }
        .no-courses i { font-size: 4rem; margin-bottom: 1rem; opacity: 0.7; }
        .no-courses h4 { margin-bottom: 0.5rem; }
        .no-courses p { opacity: 0.8; margin-bottom: 0; }
    </style>
</head>
<body>
    <div id="app">
        <?= Flight::menuProfessor() ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="font-outfit">Présence des élèves</h3>
                    <div class="text-muted">
                        <i class="bi bi-calendar-date"></i>
                        <span id="currentDate"></span>
                    </div>
                </div>
            </div>

            <div class="page-content">
                <div id="alertContainer"></div>

                <section class="row">
                    <div class="col-12">
                        <!-- Sélection du cours -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="card-title mb-0">
                                    <i class="bi bi-book me-2"></i>
                                    Sélectionner un cours
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <select class="form-select" id="coursSelect">
                                            <option value="">Chargement des cours...</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <button class="btn btn-primary" id="refreshCours">
                                            <i class="bi bi-arrow-clockwise"></i>
                                            Actualiser
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Informations du cours sélectionné -->
                        <div class="course-info" id="courseInfo" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 id="courseName">Nom du cours</h4>
                                    <p><i class="bi bi-clock me-2"></i>Horaire: <span id="courseTime"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><i class="bi bi-calendar me-2"></i>Date: <span id="courseDate"></span></p>
                                    <p><i class="bi bi-person me-2"></i>Professeur: <span id="courseProfesseur"></span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Pas de cours aujourd'hui -->
                        <div class="no-courses" id="noCourses" style="display: none;">
                            <i class="bi bi-calendar-x"></i>
                            <h4>Aucun cours aujourd'hui</h4>
                            <p>Il n'y a pas de cours programmés pour aujourd'hui.</p>
                        </div>

                        <!-- Liste des élèves -->
                        <div class="card" id="elevesList" style="display: none;">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title mb-0">
                                        <i class="bi bi-people me-2"></i>
                                        Liste des élèves
                                    </h4>
                                    <div class="d-flex gap-2">
                                        <input type="text" class="form-control" placeholder="Rechercher un élève..." id="searchStudent" style="width: 250px;">
                                        <button class="btn btn-success" id="savePresence">
                                            <i class="bi bi-check-circle me-2"></i>
                                            Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="presenceTable">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th class="text-center">Présent</th>
                                                <th>Remarques</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div id="elevesSummary" class="mt-3 text-muted"></div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let cours = [];
            let elevesData = [];
            let selectedSeanceId = null;

            // Afficher la date du jour
            const currentDate = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('currentDate').textContent = currentDate.toLocaleDateString('fr-FR', options);

            // Charger les cours du jour
            function loadCoursAujourdhui() {
                fetch('<?= Flight::base() ?>/api/cours-aujourdhui')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            cours = data.cours;
                            populateCoursSelect();
                        } else {
                            showAlert('error', 'Erreur lors du chargement des cours');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('error', 'Erreur de connexion');
                    });
            }

            // Remplir la liste déroulante des cours
            function populateCoursSelect() {
                const select = document.getElementById('coursSelect');
                select.innerHTML = '';

                if (cours.length === 0) {
                    select.innerHTML = '<option value="">Aucun cours aujourd\'hui</option>';
                    document.getElementById('noCourses').style.display = 'block';
                    return;
                }

                select.innerHTML = '<option value="">Sélectionner un cours</option>';
                cours.forEach(c => {
                    const option = document.createElement('option');
                    option.value = c.id_seances;
                    option.textContent = `${c.cours_nom} (${c.heure_debut} - ${c.heure_fin})`;
                    select.appendChild(option);
                });
            }

            // Charger les élèves pour une séance
            function loadEleves(idSeances) {
                fetch(`<?= Flight::base() ?>/api/eleves-seance/${idSeances}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            elevesData = data.eleves;
                            displayEleves();
                            document.getElementById('elevesList').style.display = 'block';
                        } else {
                            showAlert('error', 'Erreur lors du chargement des élèves');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showAlert('error', 'Erreur de connexion');
                    });
            }

            // Afficher les élèves dans le tableau
            function displayEleves() {
                const tbody = document.querySelector('#presenceTable tbody');
                tbody.innerHTML = '';

                elevesData.forEach((eleve, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${eleve.nom}</td>
                        <td>${eleve.prenom}</td>
                        <td class="text-center">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                       id="present_${eleve.id_eleve}"
                                       ${eleve.present ? 'checked' : ''}>
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                   id="remarque_${eleve.id_eleve}"
                                   value="${eleve.remarque}"
                                   placeholder="Remarques...">
                            <input type="hidden" id="id_presence_${eleve.id_eleve}" value="${eleve.id_presence || ''}">
                        </td>
                    `;
                    tbody.appendChild(row);
                });

                updateSummary();
            }

            // Mettre à jour le résumé
            function updateSummary() {
                const total = elevesData.length;
                const presents = document.querySelectorAll('#presenceTable input[type="checkbox"]:checked').length;
                document.getElementById('elevesSummary').textContent =
                    `Total: ${total} élèves | Présents: ${presents} | Absents: ${total - presents}`;
            }

            // Gestion du changement de cours
            document.getElementById('coursSelect').addEventListener('change', function() {
                const selectedId = this.value;
                selectedSeanceId = selectedId;

                if (selectedId) {
                    const selectedCours = cours.find(c => c.id_seances == selectedId);
                    if (selectedCours) {
                        // Afficher les infos du cours
                        document.getElementById('courseInfo').style.display = 'block';
                        document.getElementById('courseName').textContent = selectedCours.cours_nom;
                        document.getElementById('courseTime').textContent = `${selectedCours.heure_debut} - ${selectedCours.heure_fin}`;
                        document.getElementById('courseDate').textContent = new Date(selectedCours.date).toLocaleDateString('fr-FR');
                        document.getElementById('courseProfesseur').textContent = selectedCours.professeur;

                        // Charger les élèves
                        loadEleves(selectedId);
                    }
                } else {
                    document.getElementById('courseInfo').style.display = 'none';
                    document.getElementById('elevesList').style.display = 'none';
                }
            });

            // Recherche d'élèves
            document.getElementById('searchStudent').addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#presenceTable tbody tr');

                rows.forEach(row => {
                    const nom = row.cells[0].textContent.toLowerCase();
                    const prenom = row.cells[1].textContent.toLowerCase();
                    const matches = nom.includes(searchTerm) || prenom.includes(searchTerm);
                    row.style.display = matches ? '' : 'none';
                });
            });

            // Actualiser la liste des cours
            document.getElementById('refreshCours').addEventListener('click', loadCoursAujourdhui);

            // Enregistrer la présence
            document.getElementById('savePresence').addEventListener('click', function() {
                if (!selectedSeanceId) {
                    showAlert('warning', 'Veuillez sélectionner un cours');
                    return;
                }

                const presences = [];
                elevesData.forEach(eleve => {
                    const presentCheckbox = document.getElementById(`present_${eleve.id_eleve}`);
                    const remarqueInput = document.getElementById(`remarque_${eleve.id_eleve}`);
                    const idPresenceInput = document.getElementById(`id_presence_${eleve.id_eleve}`);

                    // Replace this part in the savePresence event listener:
                    presences.push({
                        id_eleve: eleve.id_eleve,
                        present: presentCheckbox.checked, // This sends true/false properly
                        remarque: remarqueInput.value || null, // Use null instead of empty string
                        id_presence: idPresenceInput.value || null
                    });
                });

                fetch('<?= Flight::base() ?>/api/enregistrer-presence', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id_seances: selectedSeanceId,
                        presences: presences
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showAlert('success', data.message);
                    } else {
                        showAlert('error', data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('error', 'Erreur lors de l\'enregistrement');
                });
            });

            // Mettre à jour le résumé quand on change les présences
            document.addEventListener('change', function(e) {
                if (e.target.type === 'checkbox' && e.target.id.startsWith('present_')) {
                    updateSummary();
                }
            });

            // Fonction pour afficher les alertes
            function showAlert(type, message) {
                const alertContainer = document.getElementById('alertContainer');
                const alert = document.createElement('div');
                alert.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show`;
                alert.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                alertContainer.innerHTML = '';
                alertContainer.appendChild(alert);

                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => alertContainer.removeChild(alert), 300);
                }, 5000);
            }

            // Charger les cours au démarrage
            loadCoursAujourdhui();
        });
    </script>
</body>
</html>