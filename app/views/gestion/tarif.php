<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gestion des Tarifs & Équipements</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css" />
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/css/gestion/tarif.css" />
    <!-- FontAwesome (ajouter si pas déjà présent dans app.css) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>
<body>
    <div id="app">
        <?= Flight::menuAdmin() ?>
        <div id="main">
            <main class="dashboard">
                <div class="tarif-container">
                    <div class="tarif-section">
                        <h2>Cours</h2>
                        <div class="tarif-item">
                            <label for="tarif-enfant">Tarif enfants</label>
                            <input type="text" id="tarif-enfant" value="100€" readonly>
                            <div class="tarif-buttons">
                                <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="validate-btn hidden"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                        <div class="tarif-item">
                            <label for="tarif-adulte">Tarif adulte</label>
                            <input type="text" id="tarif-adulte" value="150€" readonly>
                            <div class="tarif-buttons">
                                <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="validate-btn hidden"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tarif-section">
                        <h2>Abonnement (groupe et club)</h2>
                        <div class="tarif-item">
                            <label for="tarif-mensuel">Tarif mensuel</label>
                            <input type="text" id="tarif-mensuel" value="50€" readonly>
                            <div class="tarif-buttons">
                                <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="validate-btn hidden"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="tarif-section">
                        <h2>Particulier (par heure)</h2>
                        <div class="tarif-item">
                            <label for="tarif-heure">Tarif par heure</label>
                            <input type="text" id="tarif-heure" value="30€" readonly>
                            <div class="tarif-buttons">
                                <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                <button class="validate-btn hidden"><i class="fas fa-check"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="equipement-container">
                    <div class="equipement-form-section">
                        <h2>Gestion Equipement</h2>
                        <form class="equipement-form">
                            <div class="form-group">
                                <label for="equip-nom">Nom</label>
                                <input type="text" id="equip-nom" placeholder="Nom de l'équipement">
                            </div>
                            <div class="form-group">
                                <label for="equip-quantite">Quantité</label>
                                <input type="number" id="equip-quantite" placeholder="0">
                            </div>
                            <div class="form-group">
                                <label for="equip-date">Date d'Achat</label>
                                <input type="date" id="equip-date">
                            </div>
                            <div class="form-group">
                                <label for="equip-prix">Prix unitaire</label>
                                <input type="text" id="equip-prix" placeholder="0.00€">
                            </div>
                            <button type="submit" class="btn-valider">Valider</button>
                        </form>
                    </div>
                    <div class="equipement-list-section">
                        <h2>Liste des Equipements</h2>
                        <div class="equipement-list">
                            <div class="equipement-item">
                                <div class="equipement-info">
                                    <span class="equipement-nom">Haltères</span>
                                    <span class="equipement-etat">En stock</span>
                                </div>
                                <div class="equipement-actions">
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                    <button class="delete-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                            <div class="equipement-item">
                                <div class="equipement-info">
                                    <span class="equipement-nom">Tapis de course</span>
                                    <span class="equipement-etat">En maintenance</span>
                                </div>
                                <div class="equipement-actions">
                                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                                    <button class="delete-btn"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
</body>
<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', () => {
            const tarifItem = button.closest('.tarif-item');
            const input = tarifItem.querySelector('input[type="text"]');
            const validateBtn = tarifItem.querySelector('.validate-btn');
            
            input.removeAttribute('readonly');
            input.focus();
            button.classList.add('hidden');
            validateBtn.classList.remove('hidden');
            
            // Effet visuel pour montrer que l'élément est en édition
            tarifItem.style.backgroundColor = 'rgba(79, 168, 218, 0.1)';
            input.style.borderColor = 'var(--accent-color-2)';
        });
    });

    document.querySelectorAll('.validate-btn').forEach(button => {
        button.addEventListener('click', () => {
            const tarifItem = button.closest('.tarif-item');
            const input = tarifItem.querySelector('input[type="text"]');
            const editBtn = tarifItem.querySelector('.edit-btn');

            input.setAttribute('readonly', true);
            button.classList.add('hidden');
            editBtn.classList.remove('hidden');
            
            // Animation de confirmation
            tarifItem.style.backgroundColor = 'rgba(168, 224, 99, 0.1)';
            setTimeout(() => {
                tarifItem.style.backgroundColor = '';
            }, 1000);
            
            input.style.borderColor = '';
        });
    });

    // Gestion du formulaire d'équipement
    document.querySelector('.equipement-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nom = document.getElementById('equip-nom').value;
        const quantite = document.getElementById('equip-quantite').value;
        const date = document.getElementById('equip-date').value;
        const prix = document.getElementById('equip-prix').value;
        
        if (nom && quantite && date && prix) {
            // Créer un nouvel élément d'équipement
            const equipList = document.querySelector('.equipement-list');
            const newEquip = document.createElement('div');
            newEquip.className = 'equipement-item';
            newEquip.innerHTML = `
                <div class="equipement-info">
                    <span class="equipement-nom">${nom}</span>
                    <span class="equipement-etat">Nouveau</span>
                </div>
                <div class="equipement-actions">
                    <button class="edit-btn"><i class="fas fa-edit"></i></button>
                    <button class="delete-btn"><i class="fas fa-trash"></i></button>
                </div>
            `;
            
            equipList.prepend(newEquip);
            
            // Ajouter les événements aux nouveaux boutons
            const newEditBtn = newEquip.querySelector('.edit-btn');
            const newDeleteBtn = newEquip.querySelector('.delete-btn');
            
            newEditBtn.addEventListener('click', function() {
                document.getElementById('equip-nom').value = nom;
                document.getElementById('equip-quantite').value = quantite;
                document.getElementById('equip-date').value = date;
                document.getElementById('equip-prix').value = prix;
            });
            
            newDeleteBtn.addEventListener('click', function() {
                if (confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')) {
                    newEquip.remove();
                }
            });
            
            // Réinitialiser le formulaire
            this.reset();
            
            // Animation de confirmation
            newEquip.style.backgroundColor = 'rgba(168, 224, 99, 0.1)';
            setTimeout(() => {
                newEquip.style.backgroundColor = '';                }, 1500);
        }
    });

    // Ajouter des événements de suppression pour les équipements existants
    document.querySelectorAll('.equipement-actions .delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const equipItem = this.closest('.equipement-item');
            if (confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')) {
                equipItem.remove();
            }
        });
    });

    // Fonction pour basculer vers Superviseur
    function switchToSupervisor() {
        window.location.href = 'suivi-materiel.html';
    }
</script>
</html>
