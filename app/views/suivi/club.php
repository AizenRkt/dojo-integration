<!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>Suivi Clubs et Groupes</title>
                                <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
                                <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
                                <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
                                <!-- CSS styles intégrés pour éviter les conflits -->
                                <style>
                                    .legend-color {
                                        width: 16px;
                                        height: 16px;
                                        border-radius: 3px;
                                        display: inline-block;
                                    }
                                    .day-full { background-color: #dc3545; }
                                    .day-partial { background-color: #ffc107; }
                                    .day-free { background-color: #28a745; }

                                    .calendar {
                                        border: 1px solid #dee2e6;
                                        border-radius: 0.375rem;
                                    }
                                    .calendar-header {
                                        display: grid;
                                        grid-template-columns: repeat(7, 1fr);
                                        background-color: #f8f9fa;
                                        border-bottom: 1px solid #dee2e6;
                                    }
                                    .day-name {
                                        padding: 0.75rem;
                                        text-align: center;
                                        font-weight: 600;
                                        border-right: 1px solid #dee2e6;
                                    }
                                    .day-name:last-child {
                                        border-right: none;
                                    }
                                    .calendar-body {
                                        display: grid;
                                        grid-template-columns: repeat(7, 1fr);
                                    }
                                    .calendar-day {
                                        min-height: 80px;
                                        padding: 0.5rem;
                                        border-bottom: 1px solid #dee2e6;
                                        border-right: 1px solid #dee2e6;
                                        cursor: pointer;
                                        position: relative;
                                        transition: background-color 0.2s;
                                    }
                                    .calendar-day:hover {
                                        background-color: #f8f9fa;
                                    }
                                    .calendar-day:nth-child(7n) {
                                        border-right: none;
                                    }
                                    .calendar-day.selected {
                                        background-color: #e3f2fd;
                                        border-color: #2196f3;
                                    }
                                    .calendar-day.other-month {
                                        color: #adb5bd;
                                        background-color: #f8f9fa;
                                    }
                                    .calendar-day.day-full {
                                        background-color: rgba(220, 53, 69, 0.1);
                                    }
                                    .calendar-day.day-partial {
                                        background-color: rgba(255, 193, 7, 0.1);
                                    }
                                    .calendar-day.day-free {
                                        background-color: rgba(40, 167, 69, 0.1);
                                    }
                                    .day-number {
                                        font-weight: 600;
                                    }
                                    .availability-notification {
                                        position: absolute;
                                        top: 5px;
                                        right: 5px;
                                        background: #007bff;
                                        color: white;
                                        border-radius: 50%;
                                        width: 20px;
                                        height: 20px;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        font-size: 12px;
                                    }
                                    .time-slot {
                                        border: 1px solid #dee2e6;
                                        border-radius: 0.25rem;
                                        padding: 0.5rem;
                                        margin-bottom: 0.5rem;
                                        background: #f8f9fa;
                                    }
                                    .slot-time {
                                        font-weight: 600;
                                        color: #495057;
                                    }
                                    .group-name {
                                        font-weight: 500;
                                    }
                                    .discipline {
                                        font-size: 0.875rem;
                                        color: #6c757d;
                                    }
                                    .participants {
                                        font-size: 0.875rem;
                                        color: #28a745;
                                    }
                                    .available-time {
                                        padding: 0.25rem 0.5rem;
                                        background: #d4edda;
                                        border: 1px solid #c3e6cb;
                                        border-radius: 0.25rem;
                                        margin-bottom: 0.25rem;
                                        font-size: 0.875rem;
                                    }
                                </style>
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
                                            <h3>Suivi Clubs et Groupes</h3>
                                        </div>

                                        <div class="page-content">
                                            <section class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Planning Mensuel</h4>
                                                            <div class="calendar-nav">
                                                                <button class="btn btn-sm btn-outline-primary" onclick="changeMonth(-1)" title="Mois précédent" aria-label="Mois précédent">
                                                                    <i class="bi bi-chevron-left"></i>
                                                                </button>
                                                                <span id="currentMonth" class="mx-3 fw-bold">
                                                                    <?php
                                                                        $year = $currentYear ?? date('Y');
                                                                        $month = $currentMonth ?? date('m');
                                                                        echo date('F Y', mktime(0, 0, 0, $month, 1, $year));
                                                                    ?>
                                                                </span>
                                                                <button class="btn btn-sm btn-outline-primary" onclick="changeMonth(1)" title="Mois suivant" aria-label="Mois suivant">
                                                                    <i class="bi bi-chevron-right"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="card-body">
                                                            <!-- Légende -->
                                                            <div class="calendar-legend mb-4">
                                                                <div class="d-flex gap-4">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="legend-color day-full me-2"></div>
                                                                        <small>Jour plein</small>
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="legend-color day-partial me-2"></div>
                                                                        <small>Heures disponibles</small>
                                                                    </div>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="legend-color day-free me-2"></div>
                                                                        <small>Totalement libre</small>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <!-- Calendrier -->
                                                                <div class="col-md-8">
                                                                    <div class="calendar">
                                                                        <div class="calendar-header">
                                                                            <div class="day-name">Lun</div>
                                                                            <div class="day-name">Mar</div>
                                                                            <div class="day-name">Mer</div>
                                                                            <div class="day-name">Jeu</div>
                                                                            <div class="day-name">Ven</div>
                                                                            <div class="day-name">Sam</div>
                                                                            <div class="day-name">Dim</div>
                                                                        </div>
                                                                        <div class="calendar-body" id="calendarBody">
                                                                            <!-- Les jours seront générés par JavaScript -->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Détails du jour sélectionné -->
                                                                <div class="col-md-4">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title mb-0">Détails du jour</h5>
                                                                            <div class="text-muted" id="selectedDate">Sélectionnez une date</div>
                                                                        </div>

                                                                        <div class="card-body" id="detailsContent">
                                                                            <div class="occupied-slots">
                                                                                <h6><i class="bi bi-clock me-1"></i> Créneaux occupés</h6>
                                                                                <div id="occupiedSlots">
                                                                                    <!-- Les créneaux occupés seront chargés dynamiquement -->
                                                                                </div>
                                                                            </div>

                                                                            <div class="available-slots mt-3" id="availableSlots" style="display: none;">
                                                                                <h6><i class="bi bi-plus-circle me-1"></i> Créneaux disponibles</h6>
                                                                                <div id="availableList">
                                                                                    <!-- Les créneaux disponibles seront chargés dynamiquement -->
                                                                                </div>
                                                                            </div>

                                                                            <div class="empty-day text-center" id="emptyDay" style="display: none;">
                                                                                <i class="bi bi-calendar-x text-muted" style="font-size: 2rem;"></i>
                                                                                <h6 class="mt-2">Aucune activité programmée</h6>
                                                                                <p class="text-muted small">Cette journée est entièrement libre</p>
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

                                <!-- Charger Perfect Scrollbar d'abord -->
                                <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

                                <!-- Charger le script du calendrier -->
                                <script src="<?= Flight::base() ?>/public/js/club/calendar.js"></script>

                                <!-- Initialiser le calendrier après le chargement du DOM -->
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Attendre un peu pour que tous les éléments soient bien dans le DOM
                                        setTimeout(function() {
                                            <?php
                                            $defaultYear = $currentYear ?? date('Y');
                                            $defaultMonth = $currentMonth ?? date('m');
                                            $defaultScheduleData = $scheduleData ?? [];
                                            ?>

                                            const calendarData = <?= json_encode($defaultScheduleData) ?>;
                                            const success = initCalendar(<?= $defaultYear ?>, <?= $defaultMonth ?>, calendarData);

                                            if (!success) {
                                                console.error('Échec de l\'initialisation du calendrier');
                                            }
                                        }, 250);
                                    });
                                </script>

                                <!-- Ne PAS charger app.js sur cette page -->
                            </body>
</html>