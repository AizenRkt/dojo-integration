<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évolution des élèves - Dojo</title>
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        .student-item { cursor: pointer; }
        .student-item.active { background-color: #e9ecef; border-left: 3px solid #435ebe; }
        .star { color: #ffc107; font-size: 1.2em; }
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
        <div class="page-heading"><h3>Évolution des élèves</h3></div>
        <div class="page-content">
            <div class="row">
                <!-- 🔹 Liste des élèves -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <input type="text" class="form-control" placeholder="Rechercher un élève..." id="searchStudent">
                        </div>
                        <div class="card-body">
                            <div class="list-group" id="studentsList">
                                <?php foreach($eleve as $e) : ?>
                                    <a href="#" class="list-group-item list-group-item-action student-item" data-student-id="<?= $e['id_eleve'] ?>">
                                        <div class="d-flex justify-content-between">
                                            <h5><?= $e['nom'].' '.$e['prenom'] ?></h5>
                                            <small class="star">
                                                <?= str_repeat('★', $e['note']).str_repeat('☆', 5 - $e['note']) ?>
                                            </small>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 🔹 Détails et historique -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-header">
                                <img src="<?= Flight::base() ?>/public/assets/compiled/jpg/1.jpg" width="80" alt="Photo élève">
                                <div>
                                    <h4 id="studentName"></h4>
                                    <p class="text-muted" id="studentInscrit"></p>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Formulaire d'évaluation -->
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header"><h5>Évaluation</h5></div>
                                        <div class="card-body">
                                            <form id="evaluationForm">
                                                <input type="hidden" id="selectedStudentId" value="">
                                                <div class="mb-3">
                                                    <label>Nombre d'étoiles</label>
                                                    <div class="star-rating" id="starRating">
                                                        <?php for ($i=1;$i<=5;$i++): ?>
                                                            <span class="star-empty" data-value="<?= $i ?>">★</span>
                                                        <?php endfor;?>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Commentaire</label>
                                                    <textarea class="form-control" id="commentaire"></textarea>
                                                </div>
                                                <button type="button" id="saveEvaluationBtn" class="btn btn-primary">Enregistrer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Historique -->
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header"><h5>Historique des évaluations</h5></div>
                                        <div class="card-body">
                                            <ul class="list-group" id="historiqueList">
                                                <li class="list-group-item">Cliquez sur un élève.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Progression technique si besoin -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<script>
  const BASE_URL = "<?= Flight::base() ?>";
</script>
<script>
document.getElementById('searchStudent').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const studentItems = document.querySelectorAll('#studentsList .student-item');

    studentItems.forEach(item => {
        const fullName = item.textContent.toLowerCase();
        if (fullName.includes(searchTerm)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const studentItems = document.querySelectorAll('.student-item');
    const historique = document.getElementById('historiqueList');
    const selectedInput = document.getElementById('selectedStudentId');
    const nameEl = document.getElementById('studentName');
    const commentEl = document.getElementById('commentaire');

    studentItems.forEach(item => {
        item.addEventListener('click', e => {
            e.preventDefault();
            studentItems.forEach(i=>i.classList.remove('active'));
            item.classList.add('active');
            const id = item.dataset.studentId;
            selectedInput.value = id;

            fetch(`${BASE_URL}/ws/evaluations/${id}`)
                .then(r => r.ok ? r.json() : Promise.reject('Erreur '+r.status))
                .then(data => {
                    historique.innerHTML = data.length ? '' : '<li class="list-group-item">Aucune évaluation.</li>';
                    data.forEach(ev => {
                        const stars = '★'.repeat(ev.note)+'☆'.repeat(5-ev.note);
                        historique.innerHTML += `
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <h6>${new Date(ev.date_evolution).toLocaleDateString()}</h6>
                                    <small class="star">${stars}</small>
                                </div><small>${ev.avis}</small>
                            </li>`;
                    });

                    if (data[0]) {
                        document.getElementById("studentName").textContent = data[0].nom + data[0].prenom || "Nom inconnu";
                        document.getElementById("studentInscrit").textContent = "Inscrit depuis : " + new Date(data[0].date_inscription).toLocaleDateString();
                    }
                })
                .catch(err => {
                    historique.innerHTML = '<li class="list-group-item text-danger">Erreur de chargement</li>';
                    console.error(err);
                });

        });
    });
});
</script>
</body>
</html>
