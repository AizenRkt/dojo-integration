<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présence des Élèves - Dojo</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
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
                    <h3>Présence des élèves</h3>
                    <div class="input-group w-50">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" placeholder="Rechercher un élève..." id="searchStudent">
                    </div>
                </div>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Liste des élèves</h4>
                                <div>
                                    <select class="form-select" id="filterGroup">
                                        <option value="">Tous les groupes</option>
                                        <option value="debutant">Groupe débutant</option>
                                        <option value="intermediaire">Groupe intermédiaire</option>
                                        <option value="avance">Groupe avancé</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover" id="presenceTable">
                                        <thead>
                                            <tr>
                                                <th>Élève</th>
                                                <th>Groupe</th>
                                                <th>Ceinture</th>
                                                <th>Présence</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Rakoto Jean</td>
                                                <td>Débutant</td>
                                                <td>Blanche</td>
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
                                            <tr>
                                                <td>Randriamahefa Marie</td>
                                                <td>Intermédiaire</td>
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
                                            <tr>
                                                <td>Rakotozafy Pierre</td>
                                                <td>Avancé</td>
                                                <td>Marron</td>
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
                                            <tr>
                                                <td>Andrianaivo Sophie</td>
                                                <td>Intermédiaire</td>
                                                <td>Orange</td>
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
                                            <tr>
                                                <td>Randriamanana Paul</td>
                                                <td>Avancé</td>
                                                <td>Noire</td>
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
            // Fonction de recherche d'élèves
            const searchStudent = document.getElementById('searchStudent');
            const presenceTable = document.getElementById('presenceTable');
            const rows = presenceTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            searchStudent.addEventListener('keyup', function () {
                const searchValue = this.value.toLowerCase();
                
                for (let i = 0; i < rows.length; i++) {
                    const studentName = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
                    if (studentName.indexOf(searchValue) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });
            
            // Filtrer par groupe
            const filterGroup = document.getElementById('filterGroup');
            filterGroup.addEventListener('change', function() {
                const selectedGroup = this.value.toLowerCase();
                
                for (let i = 0; i < rows.length; i++) {
                    const studentGroup = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                    
                    if (selectedGroup === '' || studentGroup.indexOf(selectedGroup) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            });
            
            // Enregistrer la présence
            document.getElementById('savePresence').addEventListener('click', function() {
                alert('La présence a été enregistrée avec succès !');
            });
        });
    </script>
</body>
</html>