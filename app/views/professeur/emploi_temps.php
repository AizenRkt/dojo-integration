<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du temps - Dojo</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    
    <style>
        .calendar {
            border-collapse: collapse;
            width: 100%;
        }
        
        .calendar th {
            background-color: #435ebe;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        
        .calendar td {
            border: 1px solid #ddd;
            height: 100px;
            vertical-align: top;
            padding: 5px;
        }
        
        .calendar-day-header {
            font-weight: bold;
            text-align: right;
            padding: 5px;
            color: #555;
        }
        
        .course {
            background-color: #e9ecef;
            border-left: 4px solid #435ebe;
            margin-bottom: 5px;
            padding: 5px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.85rem;
        }
        
        .course-intermediaire {
            border-left: 4px solid #198754;
        }
        
        .course-avance {
            border-left: 4px solid #dc3545;
        }
        
        .course-debutant {
            border-left: 4px solid #0dcaf0;
        }
        
        .calendar-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .current-month {
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .time-slot {
            font-weight: bold;
            width: 100px;
            border-left: 3px solid #435ebe;
            padding: 15px;
            margin: 10px 0;
            position: relative;
        }
        
        .time-slot:hover {
            background-color: #f8f9fa;
        }
        
        .time-slot.active {
            border-left: 3px solid #20c997;
        }
        
        .group-tag {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 15px;
            font-size: 0.8em;
            margin-left: 10px;
            color: white;
        }
        
        .group-tag.debutant {
            background-color: #20c997;
        }
        
        .group-tag.intermediaire {
            background-color: #ffc107;
        }
        
        .group-tag.avance {
            background-color: #dc3545;
        }
        
        .month-selector {
            margin-bottom: 20px;
        }
        
        .day-header {
            background-color: #435ebe;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
        }
        
        .calendar-container {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Emploi du temps</h3>
                            <p class="text-subtitle text-muted">Consultez votre emploi du temps des cours</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= Flight::base() ?>/">Tableau de bord</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Emploi du temps</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="calendar-nav">
                                <button class="btn btn-outline-secondary" id="prevMonth">
                                    <i class="bi bi-chevron-left"></i> Mois précédent
                                </button>
                                <div class="current-month" id="currentMonthDisplay">Mai 2023</div>
                                <button class="btn btn-outline-secondary" id="nextMonth">
                                    Mois suivant <i class="bi bi-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle"></i>
                                        Les cours ont lieu tous les mercredis et samedis. Cliquez sur un cours pour voir les détails.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Vue Hebdomadaire avec juste Mercredi et Samedi -->
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Horaire</th>
                                            <th>Mercredi</th>
                                            <th>Samedi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="time-slot">09:00 - 10:30</td>
                                            <td>
                                                <div class="course course-debutant" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Débutants" data-time="09:00 - 10:30" data-day="Mercredi" data-salle="Dojo Principal">
                                                    <div class="fw-bold">Groupe Débutants</div>
                                                    <div>10 élèves</div>
                                                    <div class="small">Dojo Principal</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="course course-debutant" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Débutants" data-time="09:00 - 10:30" data-day="Samedi" data-salle="Dojo Principal">
                                                    <div class="fw-bold">Groupe Débutants</div>
                                                    <div>12 élèves</div>
                                                    <div class="small">Dojo Principal</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="time-slot">10:45 - 12:15</td>
                                            <td>
                                                <div class="course course-intermediaire" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Intermédiaires" data-time="10:45 - 12:15" data-day="Mercredi" data-salle="Dojo Principal">
                                                    <div class="fw-bold">Groupe Intermédiaires</div>
                                                    <div>8 élèves</div>
                                                    <div class="small">Dojo Principal</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="course course-intermediaire" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Intermédiaires" data-time="10:45 - 12:15" data-day="Samedi" data-salle="Dojo Principal">
                                                    <div class="fw-bold">Groupe Intermédiaires</div>
                                                    <div>8 élèves</div>
                                                    <div class="small">Dojo Principal</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="time-slot">14:00 - 15:30</td>
                                            <td>
                                                <div class="course course-avance" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Avancés" data-time="14:00 - 15:30" data-day="Mercredi" data-salle="Dojo Principal">
                                                    <div class="fw-bold">Groupe Avancés</div>
                                                    <div>6 élèves</div>
                                                    <div class="small">Dojo Principal</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="course course-avance" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Avancés" data-time="14:00 - 15:30" data-day="Samedi" data-salle="Dojo Principal">
                                                    <div class="fw-bold">Groupe Avancés</div>
                                                    <div>6 élèves</div>
                                                    <div class="small">Dojo Principal</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="time-slot">15:45 - 17:15</td>
                                            <td>
                                                <div class="course course-debutant" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Débutants (Enfants)" data-time="15:45 - 17:15" data-day="Mercredi" data-salle="Dojo Annexe">
                                                    <div class="fw-bold">Groupe Débutants (Enfants)</div>
                                                    <div>15 élèves</div>
                                                    <div class="small">Dojo Annexe</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="course course-debutant" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Débutants (Enfants)" data-time="15:45 - 17:15" data-day="Samedi" data-salle="Dojo Annexe">
                                                    <div class="fw-bold">Groupe Débutants (Enfants)</div>
                                                    <div>15 élèves</div>
                                                    <div class="small">Dojo Annexe</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="time-slot">17:30 - 19:00</td>
                                            <td>
                                                <div class="course course-avance" data-bs-toggle="modal" data-bs-target="#courseModal" data-groupe="Compétition" data-time="17:30 - 19:00" data-day="Mercredi" data-salle="Dojo Principal">
                                                    <div class="fw-bold">Groupe Compétition</div>
                                                    <div>8 élèves</div>
                                                    <div class="small">Dojo Principal</div>
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Modal pour les détails du cours -->
                <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="courseModalLabel">Détails du cours</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>Jour:</strong> <span id="modalDay"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Horaire:</strong> <span id="modalTime"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <strong>Groupe:</strong> <span id="modalGroupe"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Salle:</strong> <span id="modalSalle"></span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <strong>Contenu du cours:</strong>
                                        <ul id="modalContenu">
                                            <li>Échauffement (15 min)</li>
                                            <li>Techniques de base (30 min)</li>
                                            <li>Applications pratiques (30 min)</li>
                                            <li>Retour au calme (15 min)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="courseNote"><strong>Notes:</strong></label>
                                            <textarea class="form-control" id="courseNote" rows="3" placeholder="Ajouter des notes pour ce cours..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="button" class="btn btn-primary" id="saveNote">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialiser la date actuelle
            const currentDate = new Date();
            const months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
            
            // Afficher le mois actuel
            function updateMonthDisplay() {
                document.getElementById('currentMonthDisplay').textContent = `${months[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
            }
            
            updateMonthDisplay();
            
            // Navigation des mois
            document.getElementById('prevMonth').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateMonthDisplay();
            });
            
            document.getElementById('nextMonth').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateMonthDisplay();
            });
            
            // Modal cours
            const courseModal = document.getElementById('courseModal');
            courseModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const groupe = button.getAttribute('data-groupe');
                const time = button.getAttribute('data-time');
                const day = button.getAttribute('data-day');
                const salle = button.getAttribute('data-salle');
                
                document.getElementById('modalGroupe').textContent = groupe;
                document.getElementById('modalTime').textContent = time;
                document.getElementById('modalDay').textContent = day;
                document.getElementById('modalSalle').textContent = salle;
                
                // Contenu spécifique selon le groupe
                let contenuHTML = '';
                if (groupe.includes('Débutants')) {
                    contenuHTML = `
                        <li>Échauffement et étirements (15 min)</li>
                        <li>Techniques de base: postures et déplacements (30 min)</li>
                        <li>Introduction aux chutes et roulades (30 min)</li>
                        <li>Jeux d'application (15 min)</li>
                    `;
                } else if (groupe.includes('Intermédiaires')) {
                    contenuHTML = `
                        <li>Échauffement dynamique (15 min)</li>
                        <li>Révision des techniques de base (20 min)</li>
                        <li>Nouvelles techniques: projections et immobilisations (40 min)</li>
                        <li>Randori (15 min)</li>
                    `;
                } else if (groupe.includes('Avancés') || groupe.includes('Compétition')) {
                    contenuHTML = `
                        <li>Échauffement spécifique (15 min)</li>
                        <li>Techniques avancées (30 min)</li>
                        <li>Préparation compétition: tactiques et stratégies (30 min)</li>
                        <li>Randori intensif (15 min)</li>
                    `;
                }
                
                document.getElementById('modalContenu').innerHTML = contenuHTML;
            });
            
            // Enregistrement de notes
            document.getElementById('saveNote').addEventListener('click', function() {
                const noteText = document.getElementById('courseNote').value;
                if (noteText.trim() !== '') {
                    // Simuler l'enregistrement
                    const toast = document.createElement('div');
                    toast.className = 'alert alert-success alert-dismissible fade show';
                    toast.style.position = 'fixed';
                    toast.style.top = '20px';
                    toast.style.right = '20px';
                    toast.innerHTML = `
                        <i class="bi bi-check-circle"></i> Note enregistrée avec succès.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                    
                    document.body.appendChild(toast);
                    
                    // Fermer le modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('courseModal'));
                    modal.hide();
                    
                    // Supprimer le toast après 3 secondes
                    setTimeout(() => {
                        toast.classList.remove('show');
                        setTimeout(() => toast.remove(), 150);
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>
       
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
                <h3>Emploi du temps</h3>
            </div>

            <div class="page-content">
                <!-- Sélecteur de mois -->
                <section class="row">
                    <div class="col-12">
                        <div class="card month-selector">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <button class="btn btn-outline-primary" id="prevMonth"><i class="bi bi-chevron-left"></i></button>
                                <h4 id="currentMonth">Juillet 2025</h4>
                                <button class="btn btn-outline-primary" id="nextMonth"><i class="bi bi-chevron-right"></i></button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Calendrier -->
                <section class="row">
                    <!-- Mercredi -->
                    <div class="col-md-6 mb-4">
                        <div class="calendar-container">
                            <div class="day-header">
                                Mercredi
                            </div>
                            <div class="p-3">
                                <!-- Créneaux horaires -->
                                <div class="time-slot active">
                                    <h5>14:00 - 15:30 <span class="group-tag debutant">Groupe débutant</span></h5>
                                    <p class="mb-0">Salle Sakura - Tatami 1</p>
                                    <small class="text-muted">15 élèves</small>
                                </div>
                                
                                <div class="time-slot">
                                    <h5>16:00 - 17:30 <span class="group-tag intermediaire">Groupe intermédiaire</span></h5>
                                    <p class="mb-0">Salle Sakura - Tatami 2</p>
                                    <small class="text-muted">12 élèves</small>
                                </div>
                                
                                <div class="time-slot">
                                    <h5>18:00 - 19:30 <span class="group-tag avance">Groupe avancé</span></h5>
                                    <p class="mb-0">Salle Hikari - Tatami principal</p>
                                    <small class="text-muted">8 élèves</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Samedi -->
                    <div class="col-md-6 mb-4">
                        <div class="calendar-container">
                            <div class="day-header">
                                Samedi
                            </div>
                            <div class="p-3">
                                <!-- Créneaux horaires -->
                                <div class="time-slot">
                                    <h5>09:00 - 10:30 <span class="group-tag debutant">Groupe débutant</span></h5>
                                    <p class="mb-0">Salle Sakura - Tatami 1</p>
                                    <small class="text-muted">18 élèves</small>
                                </div>
                                
                                <div class="time-slot active">
                                    <h5>11:00 - 12:30 <span class="group-tag intermediaire">Groupe intermédiaire</span></h5>
                                    <p class="mb-0">Salle Sakura - Tatami 2</p>
                                    <small class="text-muted">10 élèves</small>
                                </div>
                                
                                <div class="time-slot">
                                    <h5>14:00 - 16:00 <span class="group-tag avance">Groupe avancé</span></h5>
                                    <p class="mb-0">Salle Hikari - Tatami principal</p>
                                    <small class="text-muted">7 élèves</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Détails du cours sélectionné -->
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Détails du cours sélectionné</h4>
                                <div>
                                    <button class="btn btn-primary"><i class="bi bi-pencil"></i> Modifier</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Informations générales</h5>
                                        <table class="table">
                                            <tr>
                                                <th width="30%">Jour</th>
                                                <td>Mercredi</td>
                                            </tr>
                                            <tr>
                                                <th>Heure</th>
                                                <td>14:00 - 15:30</td>
                                            </tr>
                                            <tr>
                                                <th>Groupe</th>
                                                <td>Groupe débutant</td>
                                            </tr>
                                            <tr>
                                                <th>Salle</th>
                                                <td>Salle Sakura - Tatami 1</td>
                                            </tr>
                                            <tr>
                                                <th>Effectif</th>
                                                <td>15 élèves</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="mb-3">Programme du cours</h5>
                                        <ul class="list-group">
                                            <li class="list-group-item">Échauffements (15 min)</li>
                                            <li class="list-group-item">Techniques de base - Kihon (30 min)</li>
                                            <li class="list-group-item">Travail en binôme (30 min)</li>
                                            <li class="list-group-item">Étirements et méditation (15 min)</li>
                                        </ul>
                                        <div class="mt-3">
                                            <p><strong>Notes :</strong> Prévoir une séance spéciale sur les ukemi (techniques de chute) pour les nouveaux élèves.</p>
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

    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const timeSlots = document.querySelectorAll('.time-slot');
            
            // Permettre de sélectionner un créneau horaire
            timeSlots.forEach(slot => {
                slot.addEventListener('click', function() {
                    // Désactiver tous les créneaux
                    timeSlots.forEach(s => s.classList.remove('active'));
                    // Activer le créneau cliqué
                    this.classList.add('active');
                    
                    // On pourrait charger les détails du cours ici via AJAX
                });
            });
            
            // Navigation entre les mois
            const currentMonthElement = document.getElementById('currentMonth');
            let currentDate = new Date(2025, 6); // Juillet 2025 (mois indexés à partir de 0)
            
            function updateMonthDisplay() {
                const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", 
                                   "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
                currentMonthElement.textContent = monthNames[currentDate.getMonth()] + " " + currentDate.getFullYear();
            }
            
            document.getElementById('prevMonth').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                updateMonthDisplay();
                // Mettre à jour le calendrier ici
            });
            
            document.getElementById('nextMonth').addEventListener('click', function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                updateMonthDisplay();
                // Mettre à jour le calendrier ici
            });
        });
    </script>
</body>
</html>