// Variables globales
let currentPage = 1;
let currentFilters = {};

document.addEventListener('DOMContentLoaded', function() {
    // Gestionnaire pour le bouton Sortie
    const btnSortie = document.getElementById('btnSortie');
    if (btnSortie) {
        btnSortie.addEventListener('click', () => {
            // Masquer autres sections
            document.querySelectorAll('[id^="section"]').forEach(section => {
                if (section.id !== 'sectionSortie') {
                    section.style.display = 'none';
                }
            });

            // Afficher section sortie
            const sectionSortie = document.getElementById('sectionSortie');
            sectionSortie.style.display = 'block';

            // Initialiser la section
            initSortieSection();
        });
    }

    // Initialiser la section sortie par défaut
    initSortieSection();
});

// Initialiser la section sortie
function initSortieSection() {
    loadCategories();
    loadStatuts();
    loadModePaiements();
    loadSorties();
    loadStatistiques();
    setupEventListeners();
}

// Charger les catégories
function loadCategories() {
    fetch(`${window.BASE_URL}/api/sorties/categories`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                populateSelect('filterCategorie', data.categories, 'categorie', 'categorie');
                populateSelect('depenseCategorie', data.categories, 'categorie', 'categorie');
            }
        })
        .catch(error => console.error('Erreur lors du chargement des catégories:', error));
}

// Charger les statuts
function loadStatuts() {
    fetch(`${window.BASE_URL}/api/sorties/statuts`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                populateSelect('filterStatut', data.statuts, 'libelle', 'id_statut');
            }
        })
        .catch(error => console.error('Erreur lors du chargement des statuts:', error));
}

// Charger les modes de paiement
function loadModePaiements() {
    fetch(`${window.BASE_URL}/api/sorties/modes-paiement`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                populateSelect('depenseModePaiement', data.modes_paiement, 'mode_paiement', 'mode_paiement');
            }
        })
        .catch(error => console.error('Erreur lors du chargement des modes de paiement:', error));
}

// Charger les sorties
function loadSorties(page = 1) {
    currentPage = page;
    const params = new URLSearchParams({
        page: page,
        limit: 10,
        ...currentFilters
    });

    fetch(`${window.BASE_URL}/api/sorties?${params}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displaySorties(data.sorties);
                displayPagination(data.pagination);
            }
        })
        .catch(error => console.error('Erreur lors du chargement des sorties:', error));
}

// Charger les statistiques
function loadStatistiques() {
    fetch(`${window.BASE_URL}/api/sorties/statistiques`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('totalDepenses').textContent = formatMontant(data.total_depenses);
                document.getElementById('enAttenteCount').textContent = data.en_attente_count;
                document.getElementById('valideCount').textContent = data.valide_count;
                document.getElementById('refuseCount').textContent = data.refuse_count;
            }
        })
        .catch(error => console.error('Erreur lors du chargement des statistiques:', error));
}

// Afficher les sorties
function displaySorties(sorties) {
    const tbody = document.getElementById('listeSorties');
    tbody.innerHTML = '';

    if (!sorties || sorties.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">Aucune sortie trouvée</td></tr>';
        return;
    }

    sorties.forEach(sortie => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${formatDate(sortie.date_demande)}</td>
            <td>${sortie.motif_detaille || sortie.motif || '-'}</td>
            <td><span class="badge bg-secondary">${sortie.categorie}</span></td>
            <td class="fw-bold">${formatMontant(sortie.montant)}</td>
            <td>${capitalizeFirst(sortie.mode_paiement)}</td>
            <td><span class="badge" style="background-color: ${sortie.couleur_statut}">${sortie.statut}</span></td>
            <td>
                <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-info" onclick="voirDetails(${sortie.id_depense})" title="Voir détails">
                        <i class="bi bi-eye"></i>
                    </button>
                    ${sortie.statut === 'EN ATTENTE' ? `
                        <button class="btn btn-outline-success" onclick="changerStatut(${sortie.id_depense}, 2)" title="Valider">
                            <i class="bi bi-check"></i>
                        </button>
                        <button class="btn btn-outline-danger" onclick="changerStatut(${sortie.id_depense}, 3)" title="Refuser">
                            <i class="bi bi-x"></i>
                        </button>
                    ` : ''}
                </div>
            </td>
        `;
        tbody.appendChild(row);
    });
}

// Afficher la pagination
function displayPagination(pagination) {
    const paginationContainer = document.getElementById('paginationSorties');
    paginationContainer.innerHTML = '';

    if (pagination.total_pages <= 1) return;

    // Bouton précédent
    if (pagination.current_page > 1) {
        const prevBtn = createPaginationButton(pagination.current_page - 1, 'Précédent');
        paginationContainer.appendChild(prevBtn);
    }

    // Boutons des pages
    for (let i = 1; i <= pagination.total_pages; i++) {
        if (i === pagination.current_page ||
            i === 1 ||
            i === pagination.total_pages ||
            (i >= pagination.current_page - 1 && i <= pagination.current_page + 1)) {
            const pageBtn = createPaginationButton(i, i.toString());
            if (i === pagination.current_page) {
                pageBtn.classList.add('active');
            }
            paginationContainer.appendChild(pageBtn);
        } else if (i === pagination.current_page - 2 || i === pagination.current_page + 2) {
            const dots = document.createElement('li');
            dots.className = 'page-item disabled';
            dots.innerHTML = '<span class="page-link">...</span>';
            paginationContainer.appendChild(dots);
        }
    }

    // Bouton suivant
    if (pagination.current_page < pagination.total_pages) {
        const nextBtn = createPaginationButton(pagination.current_page + 1, 'Suivant');
        paginationContainer.appendChild(nextBtn);
    }
}

// Créer un bouton de pagination
function createPaginationButton(page, text) {
    const li = document.createElement('li');
    li.className = 'page-item';
    li.innerHTML = `<a class="page-link" href="#">${text}</a>`;
    li.addEventListener('click', (e) => {
        e.preventDefault();
        loadSorties(page);
    });
    return li;
}

// Configurer les event listeners
function setupEventListeners() {
    // Nouvelle dépense
    const btnNouvelleDepense = document.getElementById('btnNouvelleDepense');
    if (btnNouvelleDepense) {
        btnNouvelleDepense.addEventListener('click', () => {
            const modal = new bootstrap.Modal(document.getElementById('modalNouvelleDepense'));
            modal.show();
        });
    }

    // Sauvegarde dépense
    const btnSauvegarderDepense = document.getElementById('btnSauvegarderDepense');
    if (btnSauvegarderDepense) {
        btnSauvegarderDepense.addEventListener('click', sauvegarderDepense);
    }

    // Filtres
    const filterCategorie = document.getElementById('filterCategorie');
    const filterStatut = document.getElementById('filterStatut');
    const searchSortie = document.getElementById('searchSortie');

    if (filterCategorie) {
        filterCategorie.addEventListener('change', applyFilters);
    }
    if (filterStatut) {
        filterStatut.addEventListener('change', applyFilters);
    }
    if (searchSortie) {
        searchSortie.addEventListener('input', debounce(applyFilters, 500));
    }
}

// Appliquer les filtres
function applyFilters() {
    currentFilters = {};

    const categorie = document.getElementById('filterCategorie')?.value;
    const statut = document.getElementById('filterStatut')?.value;
    const search = document.getElementById('searchSortie')?.value;

    if (categorie) currentFilters.categorie = categorie;
    if (statut) currentFilters.statut = statut;
    if (search) currentFilters.search = search;

    loadSorties(1);
}

// Sauvegarder une nouvelle dépense
function sauvegarderDepense() {
    const form = document.getElementById('formNouvelleDepense');

    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const formData = {
        categorie: document.getElementById('depenseCategorie').value,
        motif_libelle: document.getElementById('depenseMotif').value,
        montant: parseFloat(document.getElementById('depenseMontant').value),
        mode_paiement: document.getElementById('depenseModePaiement').value,
        description: document.getElementById('depenseDescription').value
    };

    fetch(`${window.BASE_URL}/api/sorties`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert('Dépense enregistrée avec succès', 'success');
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalNouvelleDepense'));
            modal.hide();
            form.reset();
            loadSorties();
            loadStatistiques();
        } else {
            showAlert('Erreur: ' + data.message, 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showAlert('Erreur lors de l\'enregistrement', 'danger');
    });
}

function voirDetails(idDepense) {
    fetch(`${window.BASE_URL}/api/sorties/${idDepense}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                afficherDetailsDepense(data.sortie);
            } else {
                console.error('Erreur:', data.message);
                alert('Erreur lors du chargement des détails: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors du chargement des détails de la dépense');
        });
}

function afficherDetailsDepense(sortie) {
    const modalContent = document.getElementById('detailsDepenseContent');

    const statusBadge = getStatusBadge(sortie.statut, sortie.couleur);
    const formatDate = (dateString) => {
        return new Date(dateString).toLocaleDateString('fr-FR', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    };

    modalContent.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Informations générales</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>ID:</strong> #${sortie.id_depense}</p>
                        <p><strong>Catégorie:</strong> <span class="badge bg-info">${sortie.categorie}</span></p>
                        <p><strong>Motif:</strong> ${sortie.motif || sortie.motif_detaille || '-'}</p>
                        <p><strong>Montant:</strong> <span class="fw-bold text-primary">${formatMontant(sortie.montant)}</span></p>
                        <p><strong>Mode de paiement:</strong> ${sortie.mode_paiement}</p>
                        <p><strong>Statut:</strong> ${statusBadge}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Détails administratifs</h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Date de demande:</strong> ${formatDate(sortie.date_demande)}</p>
                        <p><strong>Date de dépense:</strong> ${sortie.date_depense ? formatDate(sortie.date_depense) : 'Non définie'}</p>
                        <p><strong>Demandeur:</strong> ${sortie.demandeur || 'Non défini'}</p>
                        <p><strong>Validateur:</strong> ${sortie.validateur || 'En attente'}</p>
                        <p><strong>Validée:</strong> ${sortie.validee ? 'Oui' : 'Non'}</p>
                    </div>
                </div>
            </div>
        </div>
        ${sortie.description ? `
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Description</h6>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">${sortie.description}</p>
                        </div>
                    </div>
                </div>
            </div>
        ` : ''}
    `;

    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('modalDetailsDepense'));
    modal.show();
}

function getStatusBadge(statut, couleur) {
    const colorClass = couleur ? `bg-${couleur}` : 'bg-secondary';
    return `<span class="badge ${colorClass}">${statut}</span>`;
}

function formatMontant(montant) {
    return new Intl.NumberFormat('fr-FR').format(montant) + ' AR';
}

function afficherDetailsModal(sortie) {
    const content = document.getElementById('detailsDepenseContent');
    content.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h6>Informations générales</h6>
                <table class="table table-sm">
                    <tr><td><strong>Motif:</strong></td><td>${sortie.motif_detaille || sortie.motif}</td></tr>
                    <tr><td><strong>Catégorie:</strong></td><td>${sortie.categorie}</td></tr>
                    <tr><td><strong>Montant:</strong></td><td class="fw-bold">${formatMontant(sortie.montant)}</td></tr>
                    <tr><td><strong>Mode de paiement:</strong></td><td>${capitalizeFirst(sortie.mode_paiement)}</td></tr>
                    <tr><td><strong>Date demande:</strong></td><td>${formatDate(sortie.date_demande)}</td></tr>
                    ${sortie.date_depense ? `<tr><td><strong>Date dépense:</strong></td><td>${formatDate(sortie.date_depense)}</td></tr>` : ''}
                </table>
            </div>
            <div class="col-md-6">
                <h6>Statut et validation</h6>
                <table class="table table-sm">
                    <tr><td><strong>Statut:</strong></td><td><span class="badge" style="background-color: ${sortie.couleur_statut}">${sortie.statut}</span></td></tr>
                    ${sortie.demandeur ? `<tr><td><strong>Demandeur:</strong></td><td>${sortie.demandeur}</td></tr>` : ''}
                    ${sortie.validateur ? `<tr><td><strong>Validateur:</strong></td><td>${sortie.validateur}</td></tr>` : ''}
                </table>
                ${sortie.description ? `
                    <h6>Description</h6>
                    <p class="small">${sortie.description}</p>
                ` : ''}
            </div>
        </div>
    `;

    const modal = new bootstrap.Modal(document.getElementById('modalDetailsDepense'));
    modal.show();
}

// Changer le statut d'une sortie
function changerStatut(idDepense, nouveauStatut) {
    const action = nouveauStatut === 2 ? 'valider' : 'refuser';

    if (!confirm(`Êtes-vous sûr de vouloir ${action} cette dépense ?`)) {
        return;
    }

    fetch(`${window.BASE_URL}/api/sorties/${idDepense}/statut`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            statut: nouveauStatut
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showAlert(`Dépense ${action === 'valider' ? 'validée' : 'refusée'} avec succès`, 'success');
            loadSorties();
            loadStatistiques();
        } else {
            showAlert('Erreur: ' + data.message, 'danger');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showAlert('Erreur lors du changement de statut', 'danger');
    });
}

// Fonctions utilitaires
function populateSelect(selectId, options, textProperty, valueProperty) {
    const select = document.getElementById(selectId);
    if (!select) return;

    // Garder la première option (placeholder)
    const firstOption = select.querySelector('option');
    select.innerHTML = '';
    if (firstOption) {
        select.appendChild(firstOption);
    }

    options.forEach(option => {
        const optionElement = document.createElement('option');
        optionElement.value = option[valueProperty];
        optionElement.textContent = option[textProperty];
        select.appendChild(optionElement);
    });
}

function formatMontant(montant) {
    return new Intl.NumberFormat('fr-FR').format(montant || 0) + ' AR';
}

function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('fr-FR');
}

function capitalizeFirst(str) {
    return str ? str.charAt(0).toUpperCase() + str.slice(1) : '';
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function showAlert(message, type = 'info') {
    // Créer une alerte Bootstrap
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    document.body.appendChild(alertDiv);

    // Supprimer automatiquement après 5 secondes
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}