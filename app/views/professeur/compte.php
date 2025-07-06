<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compte Professeur - Dojo</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/extensions/flatpickr/flatpickr.min.css">
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
                <h3>Enregistrement des cours enseignés</h3>
            </div>

            <div class="page-content">
                <div class="row">
                    <!-- Formulaire d'enregistrement des cours -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Nouveau cours enseigné</h4>
                            </div>
                            <div class="card-body">
                                <form id="courseForm">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="courseType" class="form-label">Type de cours</label>
                                            <select class="form-select" id="courseType" required>
                                                <option value="" selected disabled>Sélectionner un type</option>
                                                <option value="debutant">Cours débutant</option>
                                                <option value="intermediaire">Cours intermédiaire</option>
                                                <option value="avance">Cours avancé</option>
                                                <option value="specialise">Cours spécialisé</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="courseDate" class="form-label">Date du cours</label>
                                            <input type="date" class="form-control" id="courseDate" value="<?= date('Y-m-d') ?>" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="startTime" class="form-label">Heure de début</label>
                                            <input type="time" class="form-control" id="startTime" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="endTime" class="form-label">Heure de fin</label>
                                            <input type="time" class="form-control" id="endTime" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="groupName" class="form-label">Groupe</label>
                                        <select class="form-select" id="groupName" required>
                                            <option value="" selected disabled>Sélectionner un groupe</option>
                                            <option value="debutant_mercredi">Groupe débutant - Mercredi</option>
                                            <option value="debutant_samedi">Groupe débutant - Samedi</option>
                                            <option value="intermediaire_mercredi">Groupe intermédiaire - Mercredi</option>
                                            <option value="intermediaire_samedi">Groupe intermédiaire - Samedi</option>
                                            <option value="avance_mercredi">Groupe avancé - Mercredi</option>
                                            <option value="avance_samedi">Groupe avancé - Samedi</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Salle</label>
                                        <select class="form-select" id="location" required>
                                            <option value="" selected disabled>Sélectionner une salle</option>
                                            <option value="sakura_1">Salle Sakura - Tatami 1</option>
                                            <option value="sakura_2">Salle Sakura - Tatami 2</option>
                                            <option value="hikari">Salle Hikari - Tatami principal</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarques / Contenu du cours</label>
                                        <textarea class="form-control" id="remarks" rows="5" placeholder="Décrivez le contenu du cours, les techniques enseignées et toute autre observation pertinente..."></textarea>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="attendanceCount" class="form-label">Nombre de participants</label>
                                        <input type="number" class="form-control" id="attendanceCount" min="0" required>
                                    </div>
                                    
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="reset" class="btn btn-secondary">Effacer</button>
                                        <button type="submit" class="btn btn-primary">Enregistrer le cours</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Résumé du professeur -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Résumé du mois</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="avatar avatar-xl me-3">
                                        <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/1.jpg" alt="Avatar">
                                    </div>
                                    <div>
                                        <h5 class="mb-0">Rakoto Pierre</h5>
                                        <p class="text-muted mb-0">Professeur principal</p>
                                    </div>
                                </div>
                                
                                <div class="stats-icon purple mb-2">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <h6 class="text-muted">Cours enseignés ce mois-ci</h6>
                                <h3 class="mt-2 mb-4">16 cours</h3>
                                
                                <div class="stats-icon blue mb-2">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <h6 class="text-muted">Heures totales</h6>
                                <h3 class="mt-2 mb-4">24 heures</h3>
                                
                                <div class="mt-4">
                                    <a href="#" class="btn btn-outline-primary btn-block">
                                        <i class="bi bi-file-earmark-text"></i> Voir mon historique complet
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Cours récents</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Cours avancé</h6>
                                            <small class="text-muted">03/07/2025 - 18:00</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">15 élèves</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Cours intermédiaire</h6>
                                            <small class="text-muted">01/07/2025 - 16:00</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">12 élèves</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0">Cours débutant</h6>
                                            <small class="text-muted">01/07/2025 - 14:00</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">18 élèves</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/extensions/flatpickr/flatpickr.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Soumettre le formulaire
            document.getElementById('courseForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validation simple
                const courseType = document.getElementById('courseType').value;
                const courseDate = document.getElementById('courseDate').value;
                const startTime = document.getElementById('startTime').value;
                const endTime = document.getElementById('endTime').value;
                const groupName = document.getElementById('groupName').value;
                
                if (!courseType || !courseDate || !startTime || !endTime || !groupName) {
                    alert('Veuillez remplir tous les champs obligatoires');
                    return;
                }
                
                // En production, envoyer les données à un serveur
                alert('Cours enregistré avec succès !');
                this.reset();
            });
            
            // Validation de l'heure de fin > heure de début
            document.getElementById('endTime').addEventListener('change', function() {
                const startTime = document.getElementById('startTime').value;
                const endTime = this.value;
                
                if (startTime && endTime && startTime >= endTime) {
                    alert('L\'heure de fin doit être postérieure à l\'heure de début');
                    this.value = '';
                }
            });
            
            // Pré-remplir le type de cours en fonction du groupe sélectionné
            document.getElementById('groupName').addEventListener('change', function() {
                const group = this.value;
                const courseType = document.getElementById('courseType');
                
                if (group.includes('debutant')) {
                    courseType.value = 'debutant';
                } else if (group.includes('intermediaire')) {
                    courseType.value = 'intermediaire';
                } else if (group.includes('avance')) {
                    courseType.value = 'avance';
                }
            });
        });
    </script>
</body>
</html>