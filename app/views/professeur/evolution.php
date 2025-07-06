<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évolution des élèves - Dojo</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    
    <style>
        .star {
            color: #d0d0d0;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star.active {
            color: #ffb700;
        }
        .eleve-card {
            cursor: pointer;
            transition: all 0.3s;
        }
        .eleve-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .eleve-card.active {
            border-color: #435ebe;
            border-width: 2px;
            background-color: rgba(67, 94, 190, 0.05);
        }
        .fiche-eleve {
            border-left: 4px solid #435ebe;
        }
        .competence-item {
            margin-bottom: 10px;
        }
        .progression-bar {
            height: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            margin-top: 5px;
            overflow: hidden;
        }
        .progression-value {
            height: 100%;
            background-color: #435ebe;
            border-radius: 5px;
            transition: width 0.3s;
        }
        .historique-item {
            position: relative;
            padding-left: 20px;
            margin-bottom: 15px;
        }
        .historique-item:before {
            content: '';
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #435ebe;
            position: absolute;
            left: 0;
            top: 6px;
        }
        .historique-item:after {
            content: '';
            width: 2px;
            height: calc(100% + 10px);
            background: #e0e0e0;
            position: absolute;
            left: 4px;
            top: 15px;
        }
        .historique-item:last-child:after {
            display: none;
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
                            <h3>Évolution des élèves</h3>
                            <p class="text-subtitle text-muted">Suivez la progression de vos élèves</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= Flight::base() ?>/">Tableau de bord</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Évolution</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <section class="section">
                    <div class="row">
                        <!-- Liste des élèves (côté gauche) -->
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col-12">
                                            <h4 class="mb-3">Rechercher un élève</h4>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchEleve" placeholder="Nom ou prénom...">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="list-group" id="listeEleves">
                                        <div class="list-group-item eleve-card p-3" data-eleve-id="1" onclick="selectEleve(1)">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-lg me-3">
                                                    <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/1.jpg" alt="Avatar">
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Dupont Jean</h6>
                                                    <p class="text-muted mb-0">Groupe Débutant • Depuis 1 an</p>
                                                    <div class="stars mt-2">
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="list-group-item eleve-card p-3" data-eleve-id="2" onclick="selectEleve(2)">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-lg me-3">
                                                    <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/2.jpg" alt="Avatar">
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Martin Sophie</h6>
                                                    <p class="text-muted mb-0">Groupe Intermédiaire • Depuis 2 ans</p>
                                                    <div class="stars mt-2">
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="list-group-item eleve-card p-3" data-eleve-id="3" onclick="selectEleve(3)">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-lg me-3">
                                                    <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/3.jpg" alt="Avatar">
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Garcia Alexandre</h6>
                                                    <p class="text-muted mb-0">Groupe Avancé • Depuis 4 ans</p>
                                                    <div class="stars mt-2">
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="list-group-item eleve-card p-3" data-eleve-id="4" onclick="selectEleve(4)">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-lg me-3">
                                                    <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/4.jpg" alt="Avatar">
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Bernard Emma</h6>
                                                    <p class="text-muted mb-0">Groupe Débutant • Depuis 8 mois</p>
                                                    <div class="stars mt-2">
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="list-group-item eleve-card p-3" data-eleve-id="5" onclick="selectEleve(5)">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-lg me-3">
                                                    <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/5.jpg" alt="Avatar">
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Dubois Lucas</h6>
                                                    <p class="text-muted mb-0">Groupe Intermédiaire • Depuis 3 ans</p>
                                                    <div class="stars mt-2">
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star active"></i>
                                                        <i class="bi bi-star-fill star"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fiche élève détaillée (côté droit) -->
                        <div class="col-md-7">
                            <div class="card fiche-eleve">
                                <div class="card-body" id="ficheEleve">
                                    <div class="text-center p-5" id="placeholderFiche">
                                        <img src="<?= Flight::base() ?>/public/assets/compiled/svg/user-placeholder.svg" class="img-fluid w-25 mb-4" alt="Sélectionnez un élève">
                                        <h4>Sélectionnez un élève pour voir sa fiche</h4>
                                        <p class="text-muted">Cliquez sur un élève dans la liste de gauche pour afficher sa fiche d'évolution.</p>
                                    </div>
                                    
                                    <div class="fiche-content d-none" id="ficheContent">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xl me-3" id="ficheAvatar"></div>
                                                <div>
                                                    <h4 class="mb-0" id="ficheNom"></h4>
                                                    <p class="text-muted" id="ficheGroupe"></p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <button class="btn btn-primary">
                                                    <i class="bi bi-printer"></i> Imprimer
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <!-- Évaluation par étoiles -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-body">
                                                <h5>Évaluation globale</h5>
                                                <div class="d-flex align-items-center">
                                                    <div class="stars-large me-3">
                                                        <i class="bi bi-star-fill star" data-value="1" onclick="updateStars(1)"></i>
                                                        <i class="bi bi-star-fill star" data-value="2" onclick="updateStars(2)"></i>
                                                        <i class="bi bi-star-fill star" data-value="3" onclick="updateStars(3)"></i>
                                                        <i class="bi bi-star-fill star" data-value="4" onclick="updateStars(4)"></i>
                                                        <i class="bi bi-star-fill star" data-value="5" onclick="updateStars(5)"></i>
                                                    </div>
                                                    <span id="starsValue"></span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Commentaire -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-body">
                                                <h5>Commentaire</h5>
                                                <textarea class="form-control" id="commentaireEleve" rows="3" placeholder="Ajouter un commentaire sur l'élève..."></textarea>
                                                <div class="d-flex justify-content-end mt-2">
                                                    <button class="btn btn-sm btn-primary" onclick="saveCommentaire()">
                                                        <i class="bi bi-save"></i> Enregistrer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Progression technique -->
                                        <div class="card shadow-sm mb-4">
                                            <div class="card-body">
                                                <h5>Progression technique</h5>
                                                
                                                <div id="competencesList">
                                                    <div class="competence-item">
                                                        <div class="d-flex justify-content-between">
                                                            <label>Postures de base</label>
                                                            <span>80%</span>
                                                        </div>
                                                        <div class="progression-bar">
                                                            <div class="progression-value" style="width: 80%;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="competence-item">
                                                        <div class="d-flex justify-content-between">
                                                            <label>Techniques de projection</label>
                                                            <span>60%</span>
                                                        </div>
                                                        <div class="progression-bar">
                                                            <div class="progression-value" style="width: 60%;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="competence-item">
                                                        <div class="d-flex justify-content-between">
                                                            <label>Techniques au sol</label>
                                                            <span>45%</span>
                                                        </div>
                                                        <div class="progression-bar">
                                                            <div class="progression-value" style="width: 45%;"></div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="competence-item">
                                                        <div class="d-flex justify-content-between">
                                                            <label>Combat libre</label>
                                                            <span>30%</span>
                                                        </div>
                                                        <div class="progression-bar">
                                                            <div class="progression-value" style="width: 30%;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Historique d'évolution -->
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <h5>Historique d'évolution</h5>
                                                <div class="historique-container" id="historiqueList">
                                                    <div class="historique-item">
                                                        <div class="d-flex justify-content-between">
                                                            <strong>Passage au niveau supérieur</strong>
                                                            <small>12/04/2023</small>
                                                        </div>
                                                        <p class="mb-0 text-muted">Passage du niveau débutant à intermédiaire</p>
                                                    </div>
                                                    
                                                    <div class="historique-item">
                                                        <div class="d-flex justify-content-between">
                                                            <strong>Obtention 2ème étoile</strong>
                                                            <small>15/01/2023</small>
                                                        </div>
                                                        <p class="mb-0 text-muted">Évaluation technique positive</p>
                                                    </div>
                                                    
                                                    <div class="historique-item">
                                                        <div class="d-flex justify-content-between">
                                                            <strong>Obtention 1ère étoile</strong>
                                                            <small>05/09/2022</small>
                                                        </div>
                                                        <p class="mb-0 text-muted">Premier niveau d'évaluation réussi</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end mt-3">
                                                    <button class="btn btn-sm btn-outline-primary" onclick="addHistoriqueEntry()">
                                                        <i class="bi bi-plus-circle"></i> Ajouter une entrée
                                                    </button>
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
    
    <style>
        .student-item {
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .student-item:hover {
            background-color: #f8f9fa;
        }
        .student-item.active {
            background-color: #e9ecef;
            border-left: 3px solid #435ebe;
        }
        .star {
            color: #ffc107;
            font-size: 1.2em;
        }
        .star-empty {
            color: #e0e0e0;
            font-size: 1.2em;
        }
        .star-rating {
            font-size: 1.5em;
            cursor: pointer;
        }
        .student-details {
            transition: all 0.3s ease-in-out;
        }
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-header img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-right: 20px;
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
                <h3>Évolution des élèves</h3>
            </div>

            <div class="page-content">
                <div class="row">
                    <!-- Liste des élèves -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Rechercher un élève..." id="searchStudent">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="list-group" id="studentsList">
                                    <a href="#" class="list-group-item list-group-item-action student-item active" data-student-id="1">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Rakoto Jean</h5>
                                            <small class="star">★★★</small>
                                        </div>
                                        <small class="text-muted">Groupe débutant - Ceinture blanche</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action student-item" data-student-id="2">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Randriamahefa Marie</h5>
                                            <small class="star">★★★★</small>
                                        </div>
                                        <small class="text-muted">Groupe intermédiaire - Ceinture jaune</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action student-item" data-student-id="3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Rakotozafy Pierre</h5>
                                            <small class="star">★★★★★</small>
                                        </div>
                                        <small class="text-muted">Groupe avancé - Ceinture marron</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action student-item" data-student-id="4">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Andrianaivo Sophie</h5>
                                            <small class="star">★★</small>
                                        </div>
                                        <small class="text-muted">Groupe intermédiaire - Ceinture orange</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action student-item" data-student-id="5">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Randriamanana Paul</h5>
                                            <small class="star">★★★★★</small>
                                        </div>
                                        <small class="text-muted">Groupe avancé - Ceinture noire</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Détails de l'élève -->
                    <div class="col-md-8">
                        <div class="card student-details">
                            <div class="card-body">
                                <div class="profile-header">
                                    <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/1.jpg" alt="Photo de l'élève">
                                    <div>
                                        <h4>Rakoto Jean</h4>
                                        <p class="text-muted mb-0">Groupe débutant - Ceinture blanche</p>
                                        <p class="text-muted">Inscrit depuis: 15/03/2025</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Évaluation</h5>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre d'étoiles</label>
                                                        <div class="star-rating">
                                                            <span class="star" data-value="1">★</span>
                                                            <span class="star" data-value="2">★</span>
                                                            <span class="star" data-value="3">★</span>
                                                            <span class="star-empty" data-value="4">★</span>
                                                            <span class="star-empty" data-value="5">★</span>
                                                            <input type="hidden" id="starRating" name="starRating" value="3">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="commentaire" class="form-label">Commentaire</label>
                                                        <textarea class="form-control" id="commentaire" rows="3">Bon élève, assidu et motivé. A besoin de travailler davantage sur ses techniques de blocage.</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Historique des évaluations</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6 class="mb-1">15/06/2025</h6>
                                                            <small class="star">★★★</small>
                                                        </div>
                                                        <small class="text-muted">Bon élève, assidu et motivé.</small>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6 class="mb-1">15/05/2025</h6>
                                                            <small class="star">★★</small>
                                                        </div>
                                                        <small class="text-muted">Progrès dans les katas, mais manque de concentration.</small>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="d-flex w-100 justify-content-between">
                                                            <h6 class="mb-1">15/04/2025</h6>
                                                            <small class="star">★★</small>
                                                        </div>
                                                        <small class="text-muted">Débute bien, mais a besoin de plus de pratique.</small>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="mb-0">Progression technique</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Technique</th>
                                                                <th>Niveau de maîtrise</th>
                                                                <th>Date d'évaluation</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Ukemi (Chutes)</td>
                                                                <td>
                                                                    <div class="progress" style="height: 10px;">
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>01/06/2025</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kihon (Techniques de base)</td>
                                                                <td>
                                                                    <div class="progress" style="height: 10px;">
                                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>01/06/2025</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Kata</td>
                                                                <td>
                                                                    <div class="progress" style="height: 10px;">
                                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                </td>
                                                                <td>01/06/2025</td>
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Recherche d'élèves
            const searchStudent = document.getElementById('searchStudent');
            const studentItems = document.querySelectorAll('.student-item');
            
            searchStudent.addEventListener('keyup', function () {
                const searchValue = this.value.toLowerCase();
                
                studentItems.forEach(item => {
                    const studentName = item.querySelector('h5').textContent.toLowerCase();
                    if (studentName.indexOf(searchValue) > -1) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
            
            // Sélection d'un élève
            studentItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Mettre à jour la classe active
                    studentItems.forEach(s => s.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Charger les détails de l'élève (ici simulé, en production il faudrait appeler une API)
                    const studentId = this.getAttribute('data-student-id');
                    const studentName = this.querySelector('h5').textContent;
                    const studentStars = this.querySelector('.star').textContent.length;
                    const studentInfo = this.querySelector('.text-muted').textContent;
                    
                    // Actualiser l'affichage (simplification pour la démonstration)
                    document.querySelector('.profile-header h4').textContent = studentName;
                    document.querySelector('.profile-header p.text-muted').textContent = studentInfo;
                    
                    // Mettre à jour les étoiles
                    const starRating = document.querySelectorAll('.star-rating span');
                    starRating.forEach((star, index) => {
                        if (index < studentStars) {
                            star.classList.remove('star-empty');
                            star.classList.add('star');
                        } else {
                            star.classList.remove('star');
                            star.classList.add('star-empty');
                        }
                    });
                    document.getElementById('starRating').value = studentStars;
                });
            });
            
            // Système de notation par étoiles
            const starRating = document.querySelectorAll('.star-rating span');
            starRating.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    document.getElementById('starRating').value = value;
                    
                    starRating.forEach((s, index) => {
                        if (index < value) {
                            s.classList.remove('star-empty');
                            s.classList.add('star');
                        } else {
                            s.classList.remove('star');
                            s.classList.add('star-empty');
                        }
                    });
                });
                
                star.addEventListener('mouseover', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    
                    starRating.forEach((s, index) => {
                        if (index < value) {
                            s.style.opacity = '1';
                        } else {
                            s.style.opacity = '0.5';
                        }
                    });
                });
                
                star.addEventListener('mouseout', function() {
                    starRating.forEach(s => {
                        s.style.opacity = '1';
                    });
                });
            });
        });
    </script>
</body>
</html>