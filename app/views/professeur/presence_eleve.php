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
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1zbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdUNCZSIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <style>
        body {
            background-color: #f2f7ff;
        }
        
        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }
        
        h1, h2, h3, h4, h5, h6, .card-header, .btn {
            font-family: 'Outfit', sans-serif;
        }
        
        .page-heading h3 {
            font-weight: 600;
            color: #25396f;
            font-size: 1.8rem;
        }
        
        .btn-primary {
            background-color: #435ebe;
            border-color: #435ebe;
            box-shadow: 0 2px 6px rgba(67, 94, 190, 0.5);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #3950a2;
            border-color: #3950a2;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 94, 190, 0.6);
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.15);
        }
        
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
        }
        
        .course-info {
            background-color: #435ebe;
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(67, 94, 190, 0.3);
        }
        
        .course-info h4 {
            color: white;
            margin-bottom: 0;
            font-weight: 600;
        }
        
        .course-info p {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0.5rem;
        }
        
        .form-select, .form-control {
            border-radius: 8px;
            border: 1px solid #dce7f1;
            padding: 0.6rem 1rem;
            box-shadow: none;
            transition: all 0.3s ease;
        }
        
        .form-select:focus, .form-control:focus {
            border-color: #435ebe;
            box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.25);
        }
        
        .form-check-input:checked {
            background-color: #435ebe;
            border-color: #435ebe;
        }
        
        .table th {
            font-weight: 600;
            color: #25396f;
            border-bottom-width: 1px;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .alert-success {
            background-color: #d2f5e8;
            border-color: #9eecd2;
            color: #1f9d6e;
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
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="font-outfit">Présence des élèves</h3>
                    <div class="input-group w-50">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Rechercher un élève..." id="searchStudent">
                    </div>
                </div>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <!-- Filtre par cours -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h4 class="font-outfit">Sélectionner un cours</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-select" id="coursSelect">
                                            <option value="">-- Sélectionner un cours --</option>
                                            <option value="1">Karaté</option>
                                            <option value="2">Judo</option>
                                            <option value="3">Aikido</option>
                                            <option value="4">Taekwondo</option>
                                            <option value="5">Karaté enfants</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                        <span class="text-muted font-outfit">Date du jour: <strong id="currentDate"></strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informations du cours sélectionné -->
                        <div class="course-info mb-4" id="courseInfo" style="display: none;">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4 class="font-outfit" id="courseName">Nom du cours</h4>
                                    <p><i class="bi bi-clock"></i> <span id="courseTime">Horaire du cours</span></p>
                                    <p><i class="bi bi-people"></i> <span id="courseGroup">Groupe</span></p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <p><i class="bi bi-calendar-event"></i> <span id="courseDate">Date</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="font-outfit">Liste des élèves</h4>

                            </div>
                            <div class="card-body">
                                <div id="alertContainer"></div>
                                <div class="table-responsive">
                                    <table class="table table-hover" id="presenceTable">
                                        <thead>
                                            <tr>
                                                <th>Élève</th>
                                                <th>Présence</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="course-1 course-5">
                                                <td>Rakoto Jean</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence1" id="present1" value="present" checked>
                                                        <label class="form-check-label text-success" for="present1">Présent</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence1" id="absent1" value="absent">
                                                        <label class="form-check-label text-danger" for="absent1">Absent</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="course-2">
                                                <td>Randriamahefa Marie</td>
                                                <td>Jaune</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence2" id="present2" value="present">
                                                        <label class="form-check-label text-success" for="present2">Présent</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence2" id="absent2" value="absent" checked>
                                                        <label class="form-check-label text-danger" for="absent2">Absent</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="course-3">
                                                <td>Rakotozafy Pierre</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence3" id="present3" value="present" checked>
                                                        <label class="form-check-label text-success" for="present3">Présent</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence3" id="absent3" value="absent">
                                                        <label class="form-check-label text-danger" for="absent3">Absent</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="course-2 course-4">
                                                <td>Andrianaivo Sophie</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence4" id="present4" value="present" checked>
                                                        <label class="form-check-label text-success" for="present4">Présent</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence4" id="absent4" value="absent">
                                                        <label class="form-check-label text-danger" for="absent4">Absent</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="course-3 course-4">
                                                <td>Randriamanana Paul</td>
                                                <td>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence5" id="present5" value="present">
                                                        <label class="form-check-label text-success" for="present5">Présent</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="presence5" id="absent5" value="absent" checked>
                                                        <label class="form-check-label text-danger" for="absent5">Absent</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4 text-end">
                                    <button class="btn btn-primary" id="savePresence">
                                        <i class="bi bi-save"></i> Enregistrer la présence
                                    </button>
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
            // Afficher la date du jour
            const currentDate = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('currentDate').textContent = currentDate.toLocaleDateString('fr-FR', options);
            
            // Données des cours (simulées)

            
            // Sélection du cours
            const coursSelect = document.getElementById('coursSelect');
            const courseName = document.getElementById('courseName');
            const courseTime = document.getElementById('courseTime');
            const courseDate = document.getElementById('courseDate');
            const rows = document.querySelectorAll('#presenceTable tbody tr');
            
            coursSelect.addEventListener('change', function() {
                const selectedCourse = this.value;
                
                // Afficher/masquer les informations du cours
                if (selectedCourse) {
                    courseInfo.style.display = 'block';
                    courseName.textContent = courses[selectedCourse].name;
                    courseTime.textContent = courses[selectedCourse].time;
                    courseGroup.textContent = courses[selectedCourse].group;
                    courseDate.textContent = courses[selectedCourse].date;
                    
                    // Filtrer les élèves selon le cours sélectionné
                    rows.forEach(row => {
                        if (row.classList.contains(`course-${selectedCourse}`)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                    
                    // Réinitialiser le filtre par groupe
                    document.getElementById('filterGroup').value = '';
                    
                    // Afficher un message de confirmation
                    showAlert('success', `Cours "${courses[selectedCourse].name}" sélectionné. La liste des élèves a été mise à jour.`);
                } else {
                    courseInfo.style.display = 'none';
                    
                    // Afficher tous les élèves si aucun cours n'est sélectionné
                    rows.forEach(row => {
                        row.style.display = '';
                    });
                }
            });
            
            // Fonction pour afficher une alerte
            function showAlert(type, message) {
                const alertContainer = document.getElementById('alertContainer');
                const alert = document.createElement('div');
                alert.className = `alert alert-${type} alert-dismissible fade show`;
                alert.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                // Effacer les alertes précédentes
                alertContainer.innerHTML = '';
                alertContainer.appendChild(alert);
                
                // Faire disparaître l'alerte après 5 secondes
                setTimeout(() => {
                    alert.classList.remove('show');
                    setTimeout(() => {
                        alertContainer.removeChild(alert);
                    }, 300);
                }, 5000);
            }
            
            // Fonction de recherche d'élèves
            const searchStudent = document.getElementById('searchStudent');
            const presenceTable = document.getElementById('presenceTable');
            
            searchStudent.addEventListener('keyup', function () {
                const searchValue = this.value.toLowerCase();
                const visibleRows = document.querySelectorAll('#presenceTable tbody tr:not([style*="display: none"])');
                
                visibleRows.forEach(row => {
                    const studentName = row.getElementsByTagName('td')[0].textContent.toLowerCase();
                    if (studentName.indexOf(searchValue) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Filtrer par groupe
            const filterGroup = document.getElementById('filterGroup');
            filterGroup.addEventListener('change', function() {
                const selectedGroup = this.value.toLowerCase();
                
                // Si un cours est sélectionné, ne montrer que les élèves de ce cours
                const selectedCourse = coursSelect.value;
                const rowSelector = selectedCourse ? 
                    `#presenceTable tbody tr.course-${selectedCourse}` : 
                    '#presenceTable tbody tr';
                
                const visibleRows = document.querySelectorAll(rowSelector);
                
                visibleRows.forEach(row => {
                    const studentGroup = row.getElementsByTagName('td')[1].textContent.toLowerCase();
                    
                    if (selectedGroup === '' || studentGroup.indexOf(selectedGroup) > -1) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Enregistrer la présence
            document.getElementById('savePresence').addEventListener('click', function() {
                // Compter le nombre d'élèves présents
                const visibleRows = document.querySelectorAll('#presenceTable tbody tr:not([style*="display: none"])');
                let presentCount = 0;
                
                visibleRows.forEach(row => {
                    const radioButtons = row.querySelectorAll('input[type="radio"]');
                    radioButtons.forEach(radio => {
                        if (radio.checked && radio.value === 'present') {
                            presentCount++;
                        }
                    });
                });
                
                const selectedCourse = coursSelect.value;
                const courseText = selectedCourse ? `pour le cours "${courses[selectedCourse].name}"` : '';
                
                showAlert('success', `La présence a été enregistrée avec succès ${courseText}! (${presentCount} élèves présents sur ${visibleRows.length})`);
            });
        });
    </script>
</body>
</html>