<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>titre</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">

    <!-- modul css -->    
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        .user-type-btn.active {
            background-color: #157347 !important;
            color: white !important;
        }
        .user-type-btn {
            border: 1px solid #2c4a6b;
        }

        .person-item.active {
            border: 2px solid #157347;
            background-color: #4fa8da;
        }

    </style>
</head>
<body>
    <div id="app">
        <?= Flight::menuAdmin() ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none"><i class="bi bi-justify fs-3"></i></a>
            </header>

            <div class="page-heading">
            <h3>Suivi de Présence</h3>
            </div>

            <div class="page-content">
                <section class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                        <button class="btn user-type-btn active" data-type="eleve"><i class="fas fa-user-graduate"></i> élève</button>
                        <button class="btn user-type-btn" data-type="professeur"><i class="fas fa-chalkboard-teacher"></i> prof</button>
                        <button class="btn user-type-btn" data-type="superviseur"><i class="fas fa-user-tie"></i> superviseur</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="date-debut" class="form-label">Date début</label>
                            <input type="date" id="date-debut" class="form-control" value="2025-06-01">
                        </div>
                        <div class="col-md-3">
                            <label for="date-fin" class="form-label">Date fin</label>
                            <input type="date" id="date-fin" class="form-control" value="2025-06-24">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-success w-100"><i class="fas fa-search"></i> appliquer</button>
                        </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h5 id="list-title">Liste des Élèves</h5>
                                <div class="text-success fw-bold"><span id="total-people">4</span> personnes</div>
                            </div>
                            <div class="card-body" style="max-height: 450px; overflow-y: auto;">
                                <div class="person-item list-group-item" data-id="1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-bold person-name">Marie Dubois</div>
                                            <small class="text-muted">Niveau: Ceinture verte</small>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-warning absence-number fs-4">5</div>
                                            <small class="text-muted">absences</small>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="fw-bold person-name">Marie Dubois</div>
                                            <small class="text-muted">Niveau: Ceinture verte</small>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-warning absence-number fs-4">5</div>
                                            <small class="text-muted">absences</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-header">
                                <h5>Détails de présence</h5>
                                <div class="text-primary fw-bold selected-person-name">Marie Dubois</div>
                            </div>
                            <div class="card-body details-content">
                                <!-- Sections pour élève / professeur / superviseur -->
                                <div class="detail-section eleve-details">
                                <div class="mb-3">
                                    <h6><i class="fas fa-calendar-times me-2"></i>Jours d'absence</h6>
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">15 Juin 2025</li>
                                    <li class="list-group-item">18 Juin 2025</li>
                                    </ul>
                                </div>
                                <div class="mb-3">
                                    <h6><i class="fas fa-fist-raised me-2"></i>Cours ratés</h6>
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Self Defense - 15/06</li>
                                    <li class="list-group-item">Judo - 18/06</li>
                                    </ul>
                                </div>
                                <!-- Tu peux compléter ici avec les autres blocs -->
                                </div>

                                <div class="detail-section professeur-details d-none">...</div>
                                <div class="detail-section superviseur-details d-none">...</div>
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
    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script>
    const userTypeBtns = document.querySelectorAll('.user-type-btn');
    const listTitle = document.getElementById('list-title');
    const detailSections = document.querySelectorAll('.detail-section');

    userTypeBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        userTypeBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const type = btn.dataset.type;
        detailSections.forEach(sec => sec.classList.add('d-none'));
        const active = document.querySelector(`.${type}-details`);
        if (active) active.classList.remove('d-none');
        switch (type) {
          case 'eleve': listTitle.textContent = 'Liste des Élèves'; break;
          case 'professeur': listTitle.textContent = 'Liste des Professeurs'; break;
          case 'superviseur': listTitle.textContent = 'Liste des Superviseurs'; break;
        }
      });
    });

    function switchToSupervisor() {
      window.location.href = 'suivi-materiel.html';
    }
    </script>
</body>
</html>  