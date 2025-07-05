<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>titre</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1zbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">

    <!-- modul css -->    
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    .staff-type-btn.active {
      background-color: #4fa8da;
      color: white;
    }
    .staff-item.active {
      border: 2px solid #4fa8da;
      background-color: #e1f0ff;
      cursor: pointer;
    }
    .staff-item {
      cursor: pointer;
      border: 1px solid transparent;
      padding: 0.8rem 1rem;
      border-radius: 5px;
      margin-bottom: 0.5rem;
    }
    .form-actions {
      display: none;
      margin-top: 1rem;
    }
    .form-actions button {
      margin-right: 0.5rem;
    }
  </style>
</head>
<body>
<div id="app">
    <div id="main">
        <?= Flight::menuAdmin() ?>
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none"><i class="bi bi-justify fs-3"></i></a>
        </header>

        <div class="page-heading">
            <h3>Suivi de Personnel</h3>
        </div>

        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <div class="card p-3">
                        <!-- Choix type personnel -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                            <button class="btn btn-outline-primary staff-type-btn active" data-type="professeur">
                                <i class="fas fa-chalkboard-teacher me-1"></i> Professeur
                            </button>
                            <button class="btn btn-outline-primary staff-type-btn" data-type="superviseur">
                                <i class="fas fa-user-tie me-1"></i> Superviseur
                            </button>
                            </div>
                            <button class="btn btn-success" onclick="showAddForm()">
                            <i class="fas fa-plus"></i> Ajouter
                            </button>
                        </div>

                        <div class="row">
                            <!-- Liste du personnel -->
                            <div class="col-lg-5 col-md-6 mb-3">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 id="staff-list-title">Liste des Professeurs</h5>
                                <span><strong><span id="total-staff">0</span></strong> personnes</span>
                                </div>
                                <div
                                class="card-body overflow-auto"
                                style="max-height: 480px;"
                                id="staff-list-container"
                                >
                                <!-- Les items seront injectés ici -->
                                </div>
                            </div>
                            </div>

                            <!-- Détails + formulaire -->
                            <div class="col-lg-7 col-md-6">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>Détails du Personnel</h5>
                                <div>
                                    <button class="btn btn-primary me-2" id="editBtn" onclick="enableEdit()">
                                    <i class="fas fa-edit"></i> Modifier
                                    </button>
                                    <button class="btn btn-danger" id="deleteBtn" onclick="deleteStaff()">
                                    <i class="fas fa-trash"></i> Supprimer
                                    </button>
                                </div>
                                </div>
                                <div class="card-body">
                                <form id="staffForm" class="needs-validation" novalidate>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="firstName" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="firstName" name="firstName" disabled required />
                                        </div>
                                        <div class="col">
                                            <label for="lastName" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="lastName" name="lastName" disabled required />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="contact" class="form-label">Contact</label>
                                            <input type="tel" class="form-control" id="contact" name="contact" disabled required />
                                        </div>
                                        <div class="col">
                                            <label for="gender" class="form-label">Sexe</label>
                                            <select class="form-select" id="gender" name="gender" disabled required>
                                                <!-- Options will be populated dynamically -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="dateNaissance" class="form-label">Date de naissance</label>
                                            <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" disabled required />
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Adresse</label>
                                        <textarea class="form-control" id="address" name="address" rows="3" disabled required></textarea>
                                    </div>

                                    <div class="form-actions d-flex">
                                        <button type="button" class="btn btn-success me-2" onclick="saveStaff()">
                                            <i class="fas fa-save"></i> Sauvegarder
                                        </button>
                                        <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
                                            <i class="fas fa-times"></i> Annuler
                                        </button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Modal ajout -->
                        <div
                            class="modal fade"
                            id="addStaffModal"
                            tabindex="-1"
                            aria-labelledby="addStaffModalLabel"
                            aria-hidden="true"
                        >
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="addStaffModalLabel">Ajouter un nouveau membre du personnel</h5>
                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                                </div>
                                <form id="addStaffForm" class="needs-validation" novalidate>
                                <div class="modal-body">
                                    <div class="row mb-3">
                                    <div class="col">
                                        <label for="addFirstName" class="form-label">Prénom</label>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="addFirstName"
                                        name="firstName"
                                        required
                                        />
                                    </div>
                                    <div class="col">
                                        <label for="addLastName" class="form-label">Nom</label>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="addLastName"
                                        name="lastName"
                                        required
                                        />
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <div class="col">
                                        <label for="addContact" class="form-label">Contact</label>
                                        <input
                                        type="tel"
                                        class="form-control"
                                        id="addContact"
                                        name="contact"
                                        required
                                        />
                                    </div>
                                    <div class="col">
                                        <label for="addGender" class="form-label">Sexe</label>
                                        <select class="form-select" id="addGender" name="gender" required>
                                            <!-- Options will be populated dynamically -->
                                        </select>
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <div class="col">
                                        <label for="addDateNaissance" class="form-label">Date de naissance</label>
                                        <input
                                        type="date"
                                        class="form-control"
                                        id="addDateNaissance"
                                        name="dateNaissance"
                                        required
                                        />
                                    </div>
                                    <div class="col">
                                        <label for="addType" class="form-label">Type</label>
                                        <select
                                            class="form-select"
                                            id="addType"
                                            name="type"
                                            required
                                        >
                                            <option value="">Sélectionner</option>
                                            <option value="professeur">Professeur</option>
                                            <option value="superviseur">Superviseur</option>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="mb-3">
                                    <label for="addAddress" class="form-label">Adresse</label>
                                    <textarea
                                        class="form-control"
                                        id="addAddress"
                                        name="address"
                                        rows="3"
                                        required
                                    ></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Ajouter
                                    </button>
                                    <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal"
                                    >
                                    Annuler
                                    </button>
                                </div>
                                </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= Flight::base() ?>/public/vendor/jquery/jquery.js"></script>
<script src="<?= Flight::base() ?>/public/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let currentStaffId = null;
        let isEditing = false;
        let staffData = [];
        let genres = [];

        const staffTypeBtns = document.querySelectorAll(".staff-type-btn");
        const staffListTitle = document.getElementById("staff-list-title");
        const staffListContainer = document.getElementById("staff-list-container");
        const genderSelect = document.getElementById("gender");
        const addGenderSelect = document.getElementById("addGender");

        // Initialize
        enumGender();
        enumStaff('professeur');

        async function enumGender() {
            try {
                const response = await fetch('<?= Flight::base() ?>/api/genres');
                genres = await response.json();
                populateGenderSelects();
            } catch (e) {
                console.error('Error loading genres:', e);
            }
        }

        function populateGenderSelects() {
            const selects = [genderSelect, addGenderSelect];
            selects.forEach(select => {
                if (select) {
                    select.innerHTML = '<option value="">Sélectionner</option>';
                    genres.forEach(genre => {
                        select.innerHTML += `<option value="${genre.id_genre}">${genre.label}</option>`;
                    });
                }
            });
        }

        function getStaffApiUrl(type, action, id = '') {
            const base = '<?= Flight::base() ?>/api/';
            if (type === 'professeur') {
                switch(action) {
                    case 'list': return base + 'profs';
                    case 'add': return base + 'prof';
                    case 'update': return base + 'prof/update/' + id;
                    case 'delete': return base + 'prof/delete/' + id;
                }
            } else {
                switch(action) {
                    case 'list': return base + 'superviseurs';
                    case 'add': return base + 'superviseur';
                    case 'update': return base + 'superviseur/update/' + id;
                    case 'delete': return base + 'superviseur/delete/' + id;
                }
            }
            return '';
        }

       async function enumStaff(type) {
            const url = getStaffApiUrl(type, 'list');
            try {
                const response = await fetch(url);
                const data = await response.json();
                staffData = data.map(staff => ({
                    id: staff.id, // Use the unified 'id' field from your SQL query
                    firstName: staff.prenom,
                    lastName: staff.nom,
                    contact: staff.contact,
                    gender: staff.id_genre,
                    address: staff.adresse,
                    dateNaissance: staff.date_naissance,
                    type: type
                }));
                loadStaffList(type);
            } catch (e) {
                console.error('Error loading staff:', e);
            }
        }

        function getGenreLabel(id_genre) {
            const genre = genres.find(g => g.id_genre == id_genre);
            return genre ? genre.label : 'Non défini';
        }

        staffTypeBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                staffTypeBtns.forEach((b) => b.classList.remove("active"));
                btn.classList.add("active");
                updateListForType(btn.dataset.type);
                enumStaff(btn.dataset.type);
            });
        });

        function updateListForType(type) {
            staffListTitle.textContent = type === "professeur" ? "Liste des Professeurs" : "Liste des Superviseurs";
            cancelEdit();
        }

        function loadStaffList(type) {
            const filteredStaff = staffData.filter((s) => s.type === type);
            staffListContainer.innerHTML = "";
            filteredStaff.forEach((staff, index) => {
                const div = document.createElement("div");
                div.className = "staff-item" + (index === 0 ? " active" : "");
                div.dataset.id = staff.id;
                div.dataset.type = staff.type;
                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">${staff.firstName} ${staff.lastName}</h6>
                            <small class="text-muted">${staff.contact}</small>
                        </div>
                        <span class="badge bg-primary">${getGenreLabel(staff.gender)}</span>
                    </div>
                `;
                div.addEventListener("click", () => selectStaff(staff.id));
                staffListContainer.appendChild(div);
            });
            document.getElementById("total-staff").textContent = filteredStaff.length;
            if (filteredStaff.length > 0) {
                selectStaff(filteredStaff[0].id);
            } else {
                clearForm();
            }
        }

        // Add this helper function at the top of your script
        function formatDateForInput(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return '';
            return date.toISOString().split('T')[0]; // Returns yyyy-MM-dd format
        }

        function selectStaff(id) {
            const staff = staffData.find((s) => s.id == id);
            if (!staff) return;
            currentStaffId = id;
            document.querySelectorAll(".staff-item").forEach((item) => {
                item.classList.remove("active");
            });
            const activeItem = document.querySelector(`.staff-item[data-id="${id}"]`);
            if (activeItem) activeItem.classList.add("active");

            const form = document.getElementById("staffForm");
            form.firstName.value = staff.firstName;
            form.lastName.value = staff.lastName;
            form.contact.value = staff.contact;
            form.gender.value = staff.gender;
            form.address.value = staff.address;
            // Fix date formatting
            if (form.dateNaissance) {
                form.dateNaissance.value = formatDateForInput(staff.dateNaissance);
            }
            disableForm();
        }

        // Global functions
        window.enableEdit = function() {
            if (currentStaffId === null) return alert("Sélectionnez un personnel !");
            isEditing = true;
            enableForm();
        }

        window.cancelEdit = function() {
            isEditing = false;
            disableForm();
            if (currentStaffId !== null) selectStaff(currentStaffId);
        }

        window.saveStaff = function() {
            if (!isEditing) return;
            const form = document.getElementById("staffForm");
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            const staff = staffData.find((s) => s.id == currentStaffId);
            if (!staff) return;
            const url = getStaffApiUrl(staff.type, 'update', staff.id);
            const payload = {
                nom: form.lastName.value.trim(),
                prenom: form.firstName.value.trim(),
                contact: form.contact.value.trim(),
                adresse: form.address.value.trim(),
                id_genre: form.gender.value,
                date_naissance: form.dateNaissance ? form.dateNaissance.value : null
            };

            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                enumStaff(staff.type);
                isEditing = false;
                disableForm();
                alert("Modifications enregistrées avec succès !");
            })
            .catch(e => {
                console.error('Error updating staff:', e);
                alert("Erreur lors de la mise à jour: " + e.message);
            });
        }

        window.deleteStaff = function() {
            if (currentStaffId === null) return alert("Sélectionnez un personnel !");
            const staff = staffData.find((s) => s.id == currentStaffId);
            if (!staff) return;
            const url = getStaffApiUrl(staff.type, 'delete', staff.id);
            if (confirm("Êtes-vous sûr de vouloir supprimer ce membre du personnel ?")) {
                fetch(url, { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    enumStaff(staff.type);
                    clearForm();
                    alert("Personnel supprimé avec succès !");
                })
                .catch(e => {
                    console.error('Error deleting staff:', e);
                    alert("Erreur lors de la suppression: " + e.message);
                });
            }
        }

        function clearForm() {
            const form = document.getElementById("staffForm");
            form.reset();
            disableForm();
        }

        function enableForm() {
            const form = document.getElementById("staffForm");
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => input.disabled = false);
            document.querySelector(".form-actions").style.display = "flex";
            document.querySelector("#editBtn").style.display = "none";
            document.querySelector("#deleteBtn").style.display = "none";
        }

        function disableForm() {
            const form = document.getElementById("staffForm");
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => input.disabled = true);
            document.querySelector(".form-actions").style.display = "none";
            document.querySelector("#editBtn").style.display = "inline-block";
            document.querySelector("#deleteBtn").style.display = "inline-block";
        }

        window.showAddForm = function() {
            const modal = new bootstrap.Modal(document.getElementById("addStaffModal"));
            document.getElementById("addStaffForm").reset();
            const activeType = document.querySelector(".staff-type-btn.active").dataset.type;
            document.getElementById("addType").value = activeType;
            modal.show();
        }

        document.getElementById("addStaffForm").addEventListener("submit", function (e) {
            e.preventDefault();
            const form = e.target;
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }
            const type = form.type.value;
            const url = getStaffApiUrl(type, 'add');
            const payload = {
                nom: form.lastName.value.trim(),
                prenom: form.firstName.value.trim(),
                contact: form.contact.value.trim(),
                adresse: form.address.value.trim(),
                id_genre: form.gender.value,
                date_naissance: form.dateNaissance.value
            };

            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                enumStaff(type);
                // Multiple fallback approaches for modal closing
                const modalElement = document.getElementById("addStaffModal");

                // Try method 1: Bootstrap 5 getInstance
                try {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    } else {
                        throw new Error('getInstance failed');
                    }
                } catch (e) {
                    // Fallback method 2: Click dismiss button
                    const dismissBtn = modalElement.querySelector('[data-bs-dismiss="modal"]');
                    if (dismissBtn) {
                        dismissBtn.click();
                    } else {
                        // Fallback method 3: Manual modal hide
                        modalElement.classList.remove('show');
                        modalElement.style.display = 'none';
                        document.body.classList.remove('modal-open');
                        const backdrop = document.querySelector('.modal-backdrop');
                        if (backdrop) backdrop.remove();
                    }
                }

                alert("Personnel ajouté avec succès !");
            })
            .catch(e => {
                console.error('Error adding staff:', e);
                alert("Erreur lors de l'ajout: " + e.message);
            });
        });
    });
</script>
</html>
