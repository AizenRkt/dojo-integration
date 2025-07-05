<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestion des Tarifs & Équipements</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <div id="app">
        <?= Flight::menuAdmin() ?>
        <div id="main">
            <div class="page-heading">
                <div class="page-title mb-4">
                    <h3 class="fw-bold">Gestion des Tarifs & Équipements</h3>
                    <p class="text-subtitle text-muted">Modifiez les tarifs ou ajoutez de nouveaux équipements.</p>
                </div>

                <!-- Tarifs -->
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tarifs</h4>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Tarif enfants</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tarif-enfant" value="100€" readonly>
                                        <button class="btn btn-outline-primary edit-btn"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline-success validate-btn d-none"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Tarif adulte</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tarif-adulte" value="150€" readonly>
                                        <button class="btn btn-outline-primary edit-btn"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline-success validate-btn d-none"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Tarif mensuel</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tarif-mensuel" value="50€" readonly>
                                        <button class="btn btn-outline-primary edit-btn"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline-success validate-btn d-none"><i class="fas fa-check"></i></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>Tarif par heure</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="tarif-heure" value="30€" readonly>
                                        <button class="btn btn-outline-primary edit-btn"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline-success validate-btn d-none"><i class="fas fa-check"></i></button>
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
    <script src="<?= Flight::base() ?>/public/assets/extensions/jquery/jquery.min.js"></script>

    <script>
        // Tarifs en mode édition
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const parent = button.closest('.input-group');
                const input = parent.querySelector('input');
                const validate = parent.querySelector('.validate-btn');
                input.dataset.previousValue = input.value; // on sauvegarde l’ancienne valeur
                input.removeAttribute('readonly');
                input.focus();
                button.classList.add('d-none');
                validate.classList.remove('d-none');
            });
        });

        document.querySelectorAll('.validate-btn').forEach(button => {
            button.addEventListener('click', () => {
                const parent = button.closest('.input-group');
                const input = parent.querySelector('input');
                const edit = parent.querySelector('.edit-btn');

                const newValue = input.value;
                const oldValue = input.dataset.previousValue || '';

                if (newValue !== oldValue) {
                    const confirmed = confirm(`Confirmer le changement de tarif de "${oldValue}" vers "${newValue}" ?`);
                    if (!confirmed) {
                        input.value = oldValue;
                        return; // on ne continue pas
                    }
                }

                input.setAttribute('readonly', true);
                button.classList.add('d-none');
                edit.classList.remove('d-none');
            });
        });

        // Formulaire équipement
        document.querySelector('.equipement-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const nom = document.getElementById('equip-nom').value;
            const quantite = document.getElementById('equip-quantite').value;
            const date = document.getElementById('equip-date').value;
            const prix = document.getElementById('equip-prix').value;

            if (nom && quantite && date && prix) {
                const list = document.querySelector('.equipement-list');
                const item = document.createElement('div');
                item.className = 'd-flex justify-content-between align-items-center border p-2 rounded mb-2';
                item.innerHTML = `
                    <div>
                        <strong>${nom}</strong> - ${quantite} pièces - ${date} - <span class="text-primary">${prix} Ar</span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-outline-warning me-2"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-danger delete-btn"><i class="fas fa-trash"></i></button>
                    </div>
                `;
                list.prepend(item);

                item.querySelector('.delete-btn').addEventListener('click', function() {
                    if (confirm('Supprimer cet équipement ?')) item.remove();
                });

                this.reset();
            }
        });
    </script>
</body>
</html>