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
            color: #d0d0d0; /* gris par défaut */
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star.active {
            color: #ffc107; /* jaune quand active */
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
        #starRating .star {
            color: #d0d0d0; 
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }
        #starRating .star.active {
            color: #ffc107; 
        }
        .student-item .star {
            color: #ffc107;
            font-size: 1.2em;
        }
        .edit-eval,
        .delete-eval {
            cursor: pointer;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .edit-eval:hover {
            color: #0d6efd;
        }
        .delete-eval:hover {
            color: #dc3545;
        }
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
        .modal-card {
            background: #fff;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
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
        <div class="page-heading"><h3>Évolution des élèves</h3></div>
        <div class="page-content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <input type="text" class="form-control" placeholder="Rechercher un élève..." id="searchStudent">
                        </div>
                        <div class="card-body">
                            <div class="list-group" id="studentsList">
                                <?php if($eleve != null) {
                                    foreach($eleve as $e) : ?>
                                    <a href="#" class="list-group-item list-group-item-action student-item" data-student-id="<?= $e['id_eleve'] ?>">
                                        <div class="d-flex justify-content-between">
                                            <h5><?= $e['nom'].' '.$e['prenom'] ?></h5>
                                            <small class="star">
                                                <?php
                                                    $note = isset($e['note']) ? $e['note'] : 0;
                                                    $noteRounded = round($note);
                                                    echo str_repeat('★', $noteRounded) . str_repeat('☆', 5 - $noteRounded);
                                                ?>
                                            </small>
                                        </div>
                                    </a>
                                <?php endforeach; } ?>
                                <?php if($eleve == null) { ?>
                                    <p>Aucune &eacute;volution trouv&eacute;e</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-header">
                                <div>
                                    <h4 id="studentName"></h4>
                                    <p class="text-muted" id="studentInscrit"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card shadow-sm">
                                        <div class="card-header"><h5>Évaluation</h5></div>
                                        <div class="card-body">
                                            <form id="evaluationForm">
                                                <input type="hidden" id="selectedStudentId" value="">
                                                <div class="mb-3">
                                                    <div class="star-rating" id="starRating">
                                                        <label>Cliquez sur les &eacute;toiles</label>
                                                        </br>
                                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                                            <span class="star" data-value="<?= $i ?>">★</span>
                                                        <?php endfor; ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>
<div id="editModal" class="modal-backdrop" style="display: none;">
    <div class="modal-card">
        <h5>Modifier l’évolution</h5>
        <form id="editEvolutionForm">
            <input type="hidden" name="evolution" id="editIdEvolution">
            <input type="hidden" name="idEleve" id="editIdEleve">

            <div class="mb-2">
                <label>Note :</label>
                <div id="editStarRating" class="star-rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <span class="star" data-value="<?= $i ?>">★</span>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="mb-2">
                <label for="editAvis">Avis :</label>
                <textarea class="form-control" name="avis" id="editAvis" rows="3"></textarea>
            </div>

            <div class="text-end mt-3">
                <button type="button" class="btn btn-secondary me-2" id="cancelEdit">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<script>
  const BASE_URL = "<?= Flight::base() ?>";

  document.addEventListener('DOMContentLoaded', () => {
    const studentItems = document.querySelectorAll('.student-item');
    const historique = document.getElementById('historiqueList');
    const selectedInput = document.getElementById('selectedStudentId');
    const nameEl = document.getElementById('studentName');
    const inscritEl = document.getElementById('studentInscrit');
    const commentEl = document.getElementById('commentaire');
    const starRating = document.getElementById('starRating');
    const saveBtn = document.getElementById('saveEvaluationBtn');
    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editEvolutionForm');
    const editStarRating = document.getElementById('editStarRating');

    let currentNote = 0;
    let editNote = 0;

    function updateStars(container, note) {
      const stars = container.querySelectorAll('.star');
      stars.forEach(star => {
        star.classList.toggle('active', Number(star.dataset.value) <= note);
      });
    }

    // Étoiles - formulaire principal
    starRating.querySelectorAll('span.star').forEach(star => {
      star.addEventListener('click', () => {
        currentNote = Number(star.dataset.value);
        updateStars(starRating, currentNote);
      });
      star.addEventListener('mouseover', () => {
        updateStars(starRating, Number(star.dataset.value));
      });
      star.addEventListener('mouseout', () => {
        updateStars(starRating, currentNote);
      });
    });

    // Étoiles - formulaire modification
    editStarRating.querySelectorAll('.star').forEach(star => {
      star.addEventListener('click', () => {
        const note = Number(star.dataset.value);
        editNote = (editNote === note) ? 0 : note;
        updateStars(editStarRating, editNote);
        editModal.dataset.note = editNote;
      });

      star.addEventListener('mouseover', () => {
        updateStars(editStarRating, Number(star.dataset.value));
      });

      star.addEventListener('mouseout', () => {
        updateStars(editStarRating, editNote);
      });
    });

    // Clic élève
    studentItems.forEach(item => {
      item.addEventListener('click', e => {
        e.preventDefault();
        studentItems.forEach(i => i.classList.remove('active'));
        item.classList.add('active');

        const id = item.dataset.studentId;
        selectedInput.value = id;
        currentNote = 0;
        updateStars(starRating, 0);
        commentEl.value = '';

        fetch(`${BASE_URL}/ws/evaluations/${id}`)
          .then(r => r.ok ? r.json() : Promise.reject('Erreur ' + r.status))
          .then(data => {
            historique.innerHTML = data.length ? '' : '<li class="list-group-item">Aucune évaluation.</li>';
            data.forEach(ev => {
              const stars = '★'.repeat(ev.note) + '☆'.repeat(5 - ev.note);
              historique.innerHTML += `
                <li class="list-group-item d-flex justify-content-between align-items-start">
                  <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <h6 class="mb-0">${new Date(ev.date_evolution).toLocaleDateString()}</h6>
                      <div class="d-flex align-items-center">
                        <small class="star me-3">${stars}</small>
                        <i class="fas fa-pen text-primary me-2 edit-eval" title="Modifier" data-id="${ev.id_evolution}"></i>
                        <i class="fas fa-trash text-danger delete-eval" title="Supprimer" data-id="${ev.id_evolution}"></i>
                      </div>
                    </div>
                    <small>${ev.avis}</small>
                  </div>
                </li>`;
            });
          })
          .catch(err => {
            historique.innerHTML = '<li class="list-group-item text-danger">Erreur de chargement</li>';
            console.error(err);
          });

        nameEl.textContent = item.querySelector('h5').textContent;
        inscritEl.textContent = '';
      });
    });

    // Recherche
    // document.getElementById('searchStudent').addEventListener('input', function () {
    //   const searchTerm = this.value.toLowerCase();
    //   document.querySelectorAll('#studentsList .student-item').forEach(item => {
    //     const fullName = item.textContent.toLowerCase();
    //     item.style.display = fullName.includes(searchTerm) ? '' : 'none';
    //   });
    // });

    // Enhanced search functionality
    document.getElementById('searchStudent').addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();
        const studentItems = document.querySelectorAll('#studentsList .student-item');
        let visibleCount = 0;

        studentItems.forEach(item => {
            const nameElement = item.querySelector('h5');
            if (nameElement) {
                const fullName = nameElement.textContent.toLowerCase();
                const isVisible = fullName.includes(searchTerm);
                item.style.display = isVisible ? '' : 'none';
                if (isVisible) visibleCount++;
            }
        });

        // Show "no results" message if no students match
        const noResultsMsg = document.getElementById('noResultsMsg');
        if (noResultsMsg) noResultsMsg.remove();

        if (visibleCount === 0 && searchTerm !== '') {
            const noResults = document.createElement('div');
            noResults.id = 'noResultsMsg';
            noResults.className = 'text-muted p-3 text-center';
            noResults.textContent = 'Aucun élève trouvé';
            document.getElementById('studentsList').appendChild(noResults);
        }
    });

    // Modifier + supprimer
    document.addEventListener('click', function (e) {
      // Supprimer
      if (e.target.classList.contains('delete-eval')) {
        const idEvolution = e.target.dataset.id;
        const idEleve = selectedInput.value;

        if (confirm("Voulez-vous vraiment supprimer cette évolution ?")) {
          fetch(`${BASE_URL}/ws/delete_evolution/${idEvolution}`)
            .then(r => r.json())
            .then(data => {
              if (data.success) {
                alert("Suppression réussie !");
                document.querySelector(`.student-item[data-student-id="${idEleve}"]`).click();
              } else {
                alert("Erreur : " + data.message);
              }
            })
            .catch(err => {
              alert("Erreur réseau ou JSON invalide");
              console.error(err);
            });
        }
      }

      // Modifier
      if (e.target.classList.contains('edit-eval')) {
        const idEvolution = e.target.dataset.id;
        fetch(`${BASE_URL}/ws/evolution/${idEvolution}`)
          .then(r => r.ok ? r.json() : Promise.reject('Erreur ' + r.status))
          .then(data => {
            document.getElementById('editIdEvolution').value = data.id_evolution;
            document.getElementById('editIdEleve').value = data.id_eleve;
            document.getElementById('editAvis').value = data.avis;
            editNote = data.note;
            editModal.dataset.note = data.note;
            updateStars(editStarRating, data.note);
            editModal.style.display = 'flex';
          })
          .catch(err => {
            alert("Erreur lors du chargement des données de l'évolution");
            console.error(err);
          });
      }

      // Annuler
      if (e.target.id === 'cancelEdit') {
        editModal.style.display = 'none';
      }
    });

    saveBtn.addEventListener('click', () => {
        const idEleve = selectedInput.value;
        const avis = commentEl.value.trim();
        const note = currentNote;

        if (!idEleve || note === 0 || avis === "") {
            alert("Veuillez sélectionner un élève, attribuer une note et écrire un commentaire.");
            return;
        }

        const data = {
            id_eleve: idEleve,
            note: note,
            avis: avis
        };

        fetch(`${BASE_URL}/ws/evaluation_add`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(r => r.json())
        .then(response => {
            if (response.success) {
                alert("Évaluation enregistrée !");
                document.querySelector(`.student-item[data-student-id="${idEleve}"]`).click();
            } else {
                alert("Erreur : " + response.message);
            }
        })
        .catch(err => {
            alert("Erreur réseau ou JSON invalide");
            console.error(err);
        });
    });


    // Enregistrement modification
    editForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(editForm);
    const data = {
        evolution: formData.get('evolution'), // id_evolution
        avis: formData.get('avis'),
        note: Number(editModal.dataset.note || 0) // convertit en nombre
    };

    fetch(`${BASE_URL}/ws/update_evolution`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
        .then(r => r.json())
        .then(response => {
        if (response.success) {
            alert("Évolution mise à jour !");
            editModal.style.display = 'none';
            document.querySelector(`.student-item[data-student-id="${formData.get('idEleve')}"]`).click();
        } else {
            alert("Erreur : " + response.message);
        }
        })
        .catch(err => {
        alert("Erreur lors de la mise à jour");
        console.error(err);
        });
    });

  });
</script>


</body>
</html>
