<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Finances</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">

    <!-- modul css -->    
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
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
                <h3>Gestion des finances</h3>
            </div>
            
            <div class="page-content">
                <!-- Boutons de navigation -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-danger btn-lg" id="btnSortie">
                                        <i class="bi bi-box-arrow-up"></i>
                                        Sortie
                                    </button>
                                    <button type="button" class="btn btn-success btn-lg" id="btnPaiement">
                                        <i class="bi bi-credit-card"></i>
                                        Paiement
                                    </button>
                                    <button type="button" class="btn btn-primary btn-lg" id="btnSalaire">
                                        <i class="bi bi-cash-stack"></i>
                                        Salaire
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Sortie -->
                <div class="row" id="sectionSortie">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Sortie</h4>
                                <div class="d-flex">
                                    <input type="text" class="form-control" placeholder="Recherche">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form id="formSortie">
                                            <div class="mb-3">
                                                <label for="motifSortie" class="form-label">Motif</label>
                                                <input type="text" class="form-control" id="motifSortie" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="montantSortie" class="form-label">Montant</label>
                                                <input type="number" class="form-control" id="montantSortie" required>
                                            </div>
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <h5>Liste des sorties</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Motif</th>
                                                        <th>Montant</th>
                                                        <th>Date</th>
                                                        <th>Statut</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Réparation Mur</td>
                                                        <td>150 000 AR</td>
                                                        <td>02/07/2025</td>
                                                        <td><span class="badge bg-success">VALIDÉ</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Salaire</td>
                                                        <td>500 000 AR</td>
                                                        <td>01/07/2025</td>
                                                        <td><span class="badge bg-danger">REFUSÉ</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    <div class="row" id="sectionPaiement" style="display: none;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Paiement</h4>
                <div class="d-flex">
                    <input type="text" class="form-control" placeholder="Recherche">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <form id="formPaiement">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="typePaiement" id="typePaiementEntree" checked>
                                    <label class="btn btn-outline-primary" for="typePaiementEntree">Entrée</label>
                                    <input type="radio" class="btn-check" name="typePaiement" id="typePaiementSortie">
                                    <label class="btn btn-outline-primary" for="typePaiementSortie">Sortie</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="reservationPaiement" class="form-label">Réservation</label>
                                <select class="form-select" id="reservationPaiement">
                                    <option value="">Sélectionner une réservation</option>
                                    <option value="1">Réservation #125</option>
                                    <option value="2">Réservation #126</option>
                                    <option value="3">Réservation #127</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="clubPaiement" class="form-label">Nom clubs/groupes</label>
                                <select class="form-select" id="clubPaiement">
                                    <option value="">Sélectionner un club</option>
                                    <option value="1">Club Judo</option>
                                    <option value="2">Club Karaté</option>
                                    <option value="3">Groupe Aikido</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="datePaiement" class="form-label">Date</label>
                                <input type="date" class="form-control" id="datePaiement">
                            </div>
                            <div class="mb-3">
                                <label for="heurePaiement" class="form-label">Heure</label>
                                <input type="time" class="form-control" id="heurePaiement">
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">Valider</button>
                                <button type="reset" class="btn btn-secondary flex-grow-1">Annuler</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <h5>Liste des paiements</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Réservation</th>
                                        <th>Club/Groupe</th>
                                        <th>Date</th>
                                        <th>Montant</th>
                                        <th>Statut</th>
                                        <th>Payé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Réservation #125</td>
                                        <td>Club Judo</td>
                                        <td>03/07/2025 14:00</td>
                                        <td>50 000 AR</td>
                                        <td><span class="badge bg-warning">En attente</span></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="paiementStatus1">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Réservation #126</td>
                                        <td>Club Karaté</td>
                                        <td>04/07/2025 10:30</td>
                                        <td>75 000 AR</td>
                                        <td><span class="badge bg-success">Confirmé</span></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="paiementStatus2" checked>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Réservation #127</td>
                                        <td>Groupe Aikido</td>
                                        <td>05/07/2025 16:00</td>
                                        <td>35 000 AR</td>
                                        <td><span class="badge bg-danger">Annulé</span></td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="paiementStatus3" disabled>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                <div class="row" id="sectionSalaire" style="display: none;">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Gestion des Salaires</h4>
                                <div class="d-flex">
                                    <input type="text" class="form-control" placeholder="Recherche personnel">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Liste du personnel (Gauche) -->
                                    <div class="col-md-4">
                                        <h5>Liste du personnel</h5>
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action active" id="personnel-1">
                                                Rakoto Paul
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" id="personnel-2">
                                                Nicola Pierrot
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" id="personnel-3">
                                                Andrianavalona Jean
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" id="personnel-4">
                                                Rakotozafy Marie
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" id="personnel-5">
                                                Rakotonirina Michel
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <!-- Détails du personnel et formulaire de paiement (Droite) -->
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-4">
                                                    <div class="avatar avatar-xl me-3">
                                                        <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/1.jpg" alt="Avatar">
                                                    </div>
                                                    <div>
                                                        <h4 class="mb-0">Rakoto Paul</h4>
                                                        <p class="text-muted">Profession: Professeur / Superviseur</p>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <ul class="list-group">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span>ID Personnel:</span>
                                                                <span class="fw-bold">P-001</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span>Date d'embauche:</span>
                                                                <span class="fw-bold">15/03/2023</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span>Salaire mensuel:</span>
                                                                <span class="fw-bold">450 000 AR</span>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <span>Dernier paiement:</span>
                                                                <span class="fw-bold">31/05/2025</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <form id="formSalaire">
                                                            <div class="mb-3">
                                                                <label for="salaireMontant" class="form-label">Salaire à payer</label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" id="salaireMontant" value="450000" required>
                                                                    <span class="input-group-text">AR</span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="salaireMois" class="form-label">Mois à payer</label>
                                                                <select class="form-select" id="salaireMois" required>
                                                                    <option value="6-2025" selected>Juin 2025</option>
                                                                    <option value="7-2025">Juillet 2025</option>
                                                                    <option value="8-2025">Août 2025</option>
                                                                </select>
                                                            </div>
                                                            <div class="d-grid mt-4">
                                                                <button type="submit" class="btn btn-primary btn-lg">
                                                                    <i class="bi bi-cash"></i> Payer
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                
                                                <h5 class="mt-4">Historique des paiements</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Période</th>
                                                                <th>Montant</th>
                                                                <th>Statut</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>31/05/2025</td>
                                                                <td>Mai 2025</td>
                                                                <td>450 000 AR</td>
                                                                <td><span class="badge bg-success">Payé</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>30/04/2025</td>
                                                                <td>Avril 2025</td>
                                                                <td>450 000 AR</td>
                                                                <td><span class="badge bg-success">Payé</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>31/03/2025</td>
                                                                <td>Mars 2025</td>
                                                                <td>450 000 AR</td>
                                                                <td><span class="badge bg-success">Payé</span></td>
                                                            </tr>
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
                </div>

            </div>
        </div>
    </div>
    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
    
    <!-- Script pour la navigation entre les sections -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnSortie = document.getElementById('btnSortie');
            const btnPaiement = document.getElementById('btnPaiement');
            const btnSalaire = document.getElementById('btnSalaire');
            
            const sectionSortie = document.getElementById('sectionSortie');
            const sectionPaiement = document.getElementById('sectionPaiement');
            const sectionSalaire = document.getElementById('sectionSalaire');
            
            // Afficher la section Sortie par défaut
            sectionSortie.style.display = 'flex';
            
            btnSortie.addEventListener('click', function() {
                sectionSortie.style.display = 'flex';
                sectionPaiement.style.display = 'none';
                sectionSalaire.style.display = 'none';
                
                btnSortie.classList.add('active');
                btnPaiement.classList.remove('active');
                btnSalaire.classList.remove('active');
            });
            
            btnPaiement.addEventListener('click', function() {
                sectionSortie.style.display = 'none';
                sectionPaiement.style.display = 'flex';
                sectionSalaire.style.display = 'none';
                
                btnSortie.classList.remove('active');
                btnPaiement.classList.add('active');
                btnSalaire.classList.remove('active');
            });
            
            btnSalaire.addEventListener('click', function() {
                sectionSortie.style.display = 'none';
                sectionPaiement.style.display = 'none';
                sectionSalaire.style.display = 'flex';
                
                btnSortie.classList.remove('active');
                btnPaiement.classList.remove('active');
                btnSalaire.classList.add('active');
            });
        });
    </script>
</body>
</html>