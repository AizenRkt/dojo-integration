<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="firstName"
                                        name="firstName"
                                        disabled
                                        required
                                        />
                                    </div>
                                    <div class="col">
                                        <label for="lastName" class="form-label">Nom</label>
                                        <input
                                        type="text"
                                        class="form-control"
                                        id="lastName"
                                        name="lastName"
                                        disabled
                                        required
                                        />
                                    </div>
                                    </div>

                                    <div class="row mb-3">
                                    <div class="col">
                                        <label for="contact" class="form-label">Contact</label>
                                        <input
                                        type="tel"
                                        class="form-control"
                                        id="contact"
                                        name="contact"
                                        disabled
                                        required
                                        />
                                    </div>
                                    <div class="col">
                                        <label for="gender" class="form-label">Sexe</label>
                                        <select class="form-select" id="gender" name="gender" disabled required>
                                        <option value="Homme">Homme</option>
                                        <option value="Femme">Femme</option>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="mb-3 discipline-group" style="display: none;">
                                    <label for="discipline" class="form-label">Discipline</label>
                                    <select class="form-select" id="discipline" name="discipline" disabled>
                                        <option value="">Sélectionner</option>
                                        <option value="Judo">Judo</option>
                                        <option value="Aikido">Aikido</option>
                                        <option value="Jujitsu">Jujitsu</option>
                                        <option value="Self Defense">Self Defense</option>
                                        <option value="Karate">Karate</option>
                                    </select>
                                    </div>

                                    <div class="mb-3">
                                    <label for="address" class="form-label">Adresse</label>
                                    <textarea
                                        class="form-control"
                                        id="address"
                                        name="address"
                                        rows="3"
                                        disabled
                                        required
                                    ></textarea>
                                    </div>

                                    <div class="form-actions d-flex">
                                    <button type="button" class="btn btn-success me-2" onclick="saveStaff()">
                                        <i class="fas fa-save"></i> Enregistrer
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
                                        <option value="">Sélectionner</option>
                                        <option value="Homme">Homme</option>
                                        <option value="Femme">Femme</option>
                                        </select>
                                    </div>
                                    </div>

                                    <div class="mb-3">
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

                                    <div class="mb-3 discipline-group" id="addDisciplineGroup" style="display: none;">
                                    <label for="addDiscipline" class="form-label">Discipline</label>
                                    <select class="form-select" id="addDiscipline" name="discipline">
                                        <option value="">Sélectionner</option>
                                        <option value="Judo">Judo</option>
                                        <option value="Aikido">Aikido</option>
                                        <option value="Jujitsu">Jujitsu</option>
                                        <option value="Self Defense">Self Defense</option>
                                        <option value="Karate">Karate</option>
                                    </select>
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
    let currentStaffId = null;
    let isEditing = false;
    let staffData = [
        {
        id: 1,
        type: "professeur",
        firstName: "Hiroshi",
        lastName: "Tanaka",
        contact: "+261 34 12 345 67",
        gender: "Homme",
        discipline: "Judo",
        address: "123 Rue des Arts Martiaux, Antananarivo",
        },
        {
        id: 2,
        type: "professeur",
        firstName: "Carlos",
        lastName: "Rodriguez",
        contact: "+261 33 98 765 43",
        gender: "Homme",
        discipline: "Self Defense",
        address: "456 Avenue de la Défense, Antananarivo",
        },
        {
        id: 3,
        type: "professeur",
        firstName: "Keiko",
        lastName: "Yamamoto",
        contact: "+261 32 55 123 89",
        gender: "Femme",
        discipline: "Aikido",
        address: "789 Boulevard du Bushido, Antananarivo",
        },
        {
        id: 4,
        type: "professeur",
        firstName: "Ana",
        lastName: "Silva",
        contact: "+261 34 77 234 56",
        gender: "Femme",
        discipline: "Jujitsu",
        address: "321 Rue du Combat, Antananarivo",
        },
        {
        id: 5,
        type: "superviseur",
        firstName: "Jean",
        lastName: "Rakoto",
        contact: "+261 33 44 567 89",
        gender: "Homme",
        discipline: "",
        address: "789 Rue de la Surveillance, Antananarivo",
        },
        {
        id: 6,
        type: "superviseur",
        firstName: "Marie",
        lastName: "Andrianina",
        contact: "+261 34 88 123 45",
        gender: "Femme",
        discipline: "",
        address: "456 Avenue du Contrôle, Antananarivo",
        },
    ];

    const staffTypeBtns = document.querySelectorAll(".staff-type-btn");
    const staffListTitle = document.getElementById("staff-list-title");
    const staffListContainer = document.getElementById("staff-list-container");

    staffTypeBtns.forEach((btn) => {
        btn.addEventListener("click", () => {
        staffTypeBtns.forEach((b) => b.classList.remove("active"));
        btn.classList.add("active");
        updateListForType(btn.dataset.type);
        loadStaffList(btn.dataset.type);
        });
    });

    function updateListForType(type) {
        staffListTitle.textContent =
        type === "professeur" ? "Liste des Professeurs" : "Liste des Superviseurs";
        toggleDisciplineField(type);
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
            <div class="staff-info">
            <div class="staff-name">${staff.firstName} ${staff.lastName}</div>
            <div class="staff-details">
                <span class="contact">${staff.contact}</span>
                <span class="gender">${staff.gender}</span>
                ${
                staff.discipline
                    ? `<span class="discipline">${staff.discipline}</span>`
                    : ""
                }
            </div>
            <div class="staff-address">${staff.address}</div>
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

    function selectStaff(id) {
        const staff = staffData.find((s) => s.id === id);
        if (!staff) return;

        currentStaffId = id;

        document.querySelectorAll(".staff-item").forEach((item) => {
        item.classList.remove("active");
        });
        document.querySelector(`.staff-item[data-id="${id}"]`).classList.add("active");

        const form = document.getElementById("staffForm");
        form.firstName.value = staff.firstName;
        form.lastName.value = staff.lastName;
        form.contact.value = staff.contact;
        form.gender.value = staff.gender;
        form.discipline.value = staff.discipline || "";
        form.address.value = staff.address;

        toggleDisciplineField(staff.type);
        disableForm();
    }

    function enableEdit() {
        if (currentStaffId === null) return alert("Sélectionnez un personnel !");
        isEditing = true;
        enableForm();
    }

    function cancelEdit() {
        isEditing = false;
        disableForm();
        if (currentStaffId !== null) selectStaff(currentStaffId);
    }

    function saveStaff() {
        if (!isEditing) return;

        const form = document.getElementById("staffForm");
        if (!form.checkValidity()) {
        form.reportValidity();
        return;
        }

        const staff = staffData.find((s) => s.id === currentStaffId);
        if (!staff) return;

        staff.firstName = form.firstName.value.trim();
        staff.lastName = form.lastName.value.trim();
        staff.contact = form.contact.value.trim();
        staff.gender = form.gender.value;
        staff.discipline = form.discipline.value;
        staff.address = form.address.value.trim();

        isEditing = false;
        disableForm();

        // reload list
        const activeType = document.querySelector(".staff-type-btn.active").dataset.type;
        loadStaffList(activeType);

        alert("Modifications enregistrées avec succès !");
    }

    function deleteStaff() {
        if (currentStaffId === null) return alert("Sélectionnez un personnel !");
        if (confirm("Êtes-vous sûr de vouloir supprimer ce membre du personnel ?")) {
        staffData = staffData.filter((s) => s.id !== currentStaffId);
        currentStaffId = null;
        const activeType = document.querySelector(".staff-type-btn.active").dataset.type;
        loadStaffList(activeType);
        clearForm();
        alert("Personnel supprimé avec succès !");
        }
    }

    function clearForm() {
        const form = document.getElementById("staffForm");
        form.reset();
        disableForm();
    }

    function enableForm() {
        const form = document.getElementById("staffForm");
        [...form.elements].forEach((el) => {
        el.disabled = false;
        });
        document.querySelector(".form-actions").style.display = "flex";
        document.querySelector("#editBtn").style.display = "none";
        document.querySelector("#deleteBtn").style.display = "none";
    }

    function disableForm() {
        const form = document.getElementById("staffForm");
        [...form.elements].forEach((el) => {
        el.disabled = true;
        });
        document.querySelector(".form-actions").style.display = "none";
        document.querySelector("#editBtn").style.display = "inline-block";
        document.querySelector("#deleteBtn").style.display = "inline-block";
    }

    function showAddForm() {
        const modal = new bootstrap.Modal(document.getElementById("addStaffModal"));
        document.getElementById("addStaffForm").reset();
        // Met à jour le type par défaut selon l'onglet actif
        const activeType = document.querySelector(".staff-type-btn.active").dataset.type;
        document.getElementById("addType").value = activeType;
        toggleDisciplineField(activeType);
        modal.show();
    }

    function toggleDisciplineField(type) {
        const disciplineGroup = document.querySelector(".discipline-group");
        if (!disciplineGroup) return;

        // Pour le formulaire principal
        if (typeof type === "string") {
        // Principal form
        if (type === "professeur") {
            disciplineGroup.style.display = "block";
            document.getElementById("discipline").required = true;
        } else {
            disciplineGroup.style.display = "none";
            document.getElementById("discipline").required = false;
            document.getElementById("discipline").value = "";
        }
        }

        // Pour le modal ajout
        const addDisciplineGroup = document.getElementById("addDisciplineGroup");
        const addDisciplineField = document.getElementById("addDiscipline");
        const addTypeSelect = document.getElementById("addType");
        if (addTypeSelect && addDisciplineGroup && addDisciplineField) {
        const typeModal = addTypeSelect.value;
        if (typeModal === "professeur") {
            addDisciplineGroup.style.display = "block";
            addDisciplineField.required = true;
        } else {
            addDisciplineGroup.style.display = "none";
            addDisciplineField.required = false;
            addDisciplineField.value = "";
        }
        }
    }

    document.getElementById("addType").addEventListener("change", (e) => {
        toggleDisciplineField(e.target.value);
    });

    document.getElementById("addStaffForm").addEventListener("submit", function (e) {
        e.preventDefault();

        const form = e.target;
        if (!form.checkValidity()) {
        form.reportValidity();
        return;
        }

        const newId = staffData.length > 0 ? Math.max(...staffData.map((s) => s.id)) + 1 : 1;
        const newStaff = {
        id: newId,
        type: form.type.value,
        firstName: form.firstName.value.trim(),
        lastName: form.lastName.value.trim(),
        contact: form.contact.value.trim(),
        gender: form.gender.value,
        discipline: form.discipline.value || "",
        address: form.address.value.trim(),
        };

        staffData.push(newStaff);
        const modal = bootstrap.Modal.getInstance(document.getElementById("addStaffModal"));
        modal.hide();

        const activeType = document.querySelector(".staff-type-btn.active").dataset.type;
        loadStaffList(activeType);

        alert("Personnel ajouté avec succès !");
    });

    // Initialisation
    loadStaffList("professeur");

    // Redirection bouton Admin
    function switchToSupervisor() {
        window.location.href = "suivi-materiel.html";
    }
    </script>
</html>
