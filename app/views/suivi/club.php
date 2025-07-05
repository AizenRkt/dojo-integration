<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>titre</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">

    <!-- modul css -->    
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/css/suivi/club.css">
</head>
<body>
    <div id="app">
        <?= Flight::menuAdmin() ?>
        <div id="main">
            <main class="dashboard">
                <div class="clubs-dashboard">
                    <!-- Header -->
                    <div class="clubs-header">
                        <div class="clubs-title">
                            <h2>Suivi Clubs et Groupes</h2>
                        </div>
                        <div class="calendar-nav">
                            <button class="nav-btn" onclick="changeMonth(-1)">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <span id="currentMonth">Juin 2025</span>
                            <button class="nav-btn" onclick="changeMonth(1)">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Légende -->
                    <div class="calendar-legend">
                        <div class="legend-item">
                            <div class="legend-color day-full"></div>
                            <span>Jour plein</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color day-partial"></div>
                            <span>Heures disponibles</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color day-free"></div>
                            <span>Totalement libre</span>
                        </div>
                    </div>

                    <!-- Contenu principal -->
                    <div class="clubs-content">
                        <!-- Calendrier -->
                        <div class="calendar-container">
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
                        <div class="day-details">
                            <div class="details-header">
                                <h3>Détails du jour</h3>
                                <div class="selected-date" id="selectedDate">24 Juin 2025</div>
                            </div>
                            
                            <div class="details-content" id="detailsContent">
                                <div class="occupied-slots">
                                    <h4><i class="fas fa-clock"></i> Créneaux occupés</h4>
                                    <div class="slot-list" id="occupiedSlots">
                                        <div class="time-slot">
                                            <div class="slot-time">08:00 - 10:00</div>
                                            <div class="slot-info">
                                                <div class="group-name">Groupe Débutants A</div>
                                                <div class="discipline">Judo</div>
                                                <div class="participants">15 participants</div>
                                            </div>
                                        </div>
                                        
                                        <div class="time-slot">
                                            <div class="slot-time">10:30 - 12:00</div>
                                            <div class="slot-info">
                                                <div class="group-name">Club Self Defense</div>
                                                <div class="discipline">Self Defense</div>
                                                <div class="participants">12 participants</div>
                                            </div>
                                        </div>

                                        <div class="time-slot">
                                            <div class="slot-time">14:00 - 16:00</div>
                                            <div class="slot-info">
                                                <div class="group-name">Groupe Avancé</div>
                                                <div class="discipline">Aikido</div>
                                                <div class="participants">8 participants</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="available-slots" id="availableSlots" style="display: none;">
                                    <h4><i class="fas fa-plus-circle"></i> Créneaux disponibles</h4>
                                    <div class="available-list">
                                        <div class="available-time">16:30 - 18:00</div>
                                        <div class="available-time">18:30 - 20:00</div>
                                    </div>
                                </div>

                                <div class="empty-day" id="emptyDay" style="display: none;">
                                    <div class="empty-message">
                                        <i class="fas fa-calendar-times"></i>
                                        <h4>Aucune activité programmée</h4>
                                        <p>Cette journée est entièrement libre</p>
                                    </div>
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
    // Données d'exemple pour le calendrier
    const scheduleData = {
        '2025-06-24': {
            status: 'partial', // full, partial, free
            slots: [
                {
                    time: '08:00 - 10:00',
                    group: 'Groupe Débutants A',
                    discipline: 'Judo',
                    participants: 15
                },
                {
                    time: '10:30 - 12:00',
                    group: 'Club Self Defense',
                    discipline: 'Self Defense',
                    participants: 12
                },
                {
                    time: '14:00 - 16:00',
                    group: 'Groupe Avancé',
                    discipline: 'Aikido',
                    participants: 8
                }
            ],
            available: ['16:30 - 18:00', '18:30 - 20:00']
        },
        '2025-06-25': {
            status: 'full',
            slots: [
                {
                    time: '08:00 - 10:00',
                    group: 'Club Jujitsu',
                    discipline: 'Jujitsu',
                    participants: 18
                },
                {
                    time: '10:30 - 12:00',
                    group: 'Groupe Intermédiaire',
                    discipline: 'Judo',
                    participants: 20
                },
                {
                    time: '14:00 - 16:00',
                    group: 'Self Defense Avancé',
                    discipline: 'Self Defense',
                    participants: 10
                },
                {
                    time: '16:30 - 18:00',
                    group: 'Club Aikido',
                    discipline: 'Aikido',
                    participants: 12
                },
                {
                    time: '18:30 - 20:00',
                    group: 'Groupe Elite',
                    discipline: 'Judo',
                    participants: 8
                }
            ],
            available: []
        },
        '2025-06-26': {
            status: 'free',
            slots: [],
            available: ['08:00 - 10:00', '10:30 - 12:00', '14:00 - 16:00', '16:30 - 18:00', '18:30 - 20:00']
        },
        '2025-06-27': {
            status: 'partial',
            slots: [
                {
                    time: '08:00 - 10:00',
                    group: 'Groupe Enfants',
                    discipline: 'Judo',
                    participants: 22
                },
                {
                    time: '14:00 - 16:00',
                    group: 'Club Karate',
                    discipline: 'Karate',
                    participants: 14
                }
            ],
            available: ['10:30 - 12:00', '16:30 - 18:00', '18:30 - 20:00']
        }
    };

    let currentDate = new Date();
    let selectedDateString = '2025-06-24';

    function generateCalendar(year, month) {
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const startDate = new Date(firstDay);
        startDate.setDate(startDate.getDate() - firstDay.getDay() + 1); // Commencer le lundi

        const calendarBody = document.getElementById('calendarBody');
        calendarBody.innerHTML = '';

        for (let i = 0; i < 42; i++) { // 6 semaines
            const date = new Date(startDate);
            date.setDate(startDate.getDate() + i);
            
            const dayElement = document.createElement('div');
            dayElement.className = 'calendar-day';
            
            if (date.getMonth() !== month) {
                dayElement.classList.add('other-month');
            }

            const dateString = date.toISOString().split('T')[0];
            const dayData = scheduleData[dateString];
            
            if (dayData) {
                dayElement.classList.add(`day-${dayData.status}`);
                
                if (dayData.status === 'partial' && dayData.available.length > 0) {
                    const notification = document.createElement('div');
                    notification.className = 'availability-notification';
                    notification.innerHTML = '<i class="fas fa-plus"></i>';
                    notification.onclick = (e) => {
                        e.stopPropagation();
                        showAvailableSlots(dateString);
                    };
                    dayElement.appendChild(notification);
                }
            }

            dayElement.innerHTML += `<span class="day-number">${date.getDate()}</span>`;
            
            dayElement.onclick = () => selectDay(dateString, date);
            
            if (dateString === selectedDateString) {
                dayElement.classList.add('selected');
            }

            calendarBody.appendChild(dayElement);
        }
    }

    function selectDay(dateString, date) {
        // Retirer la sélection précédente
        document.querySelectorAll('.calendar-day').forEach(day => {
            day.classList.remove('selected');
        });
        
        // Ajouter la sélection à la nouvelle date
        event.target.closest('.calendar-day').classList.add('selected');
        selectedDateString = dateString;
        
        // Mettre à jour l'affichage des détails
        updateDayDetails(dateString, date);
    }

    function updateDayDetails(dateString, date) {
        const selectedDate = document.getElementById('selectedDate');
        const occupiedSlots = document.getElementById('occupiedSlots');
        const availableSlots = document.getElementById('availableSlots');
        const emptyDay = document.getElementById('emptyDay');
        
        // Formater la date
        const options = { day: 'numeric', month: 'long', year: 'numeric' };
        selectedDate.textContent = date.toLocaleDateString('fr-FR', options);
        
        const dayData = scheduleData[dateString];
        
        if (!dayData || dayData.slots.length === 0) {
            // Jour libre
            occupiedSlots.parentElement.style.display = 'none';
            availableSlots.style.display = 'none';
            emptyDay.style.display = 'block';
        } else {
            // Jour avec activités
            emptyDay.style.display = 'none';
            occupiedSlots.parentElement.style.display = 'block';
            
            // Mettre à jour les créneaux occupés
            occupiedSlots.innerHTML = '';
            dayData.slots.forEach(slot => {
                const slotElement = document.createElement('div');
                slotElement.className = 'time-slot';
                slotElement.innerHTML = `
                    <div class="slot-time">${slot.time}</div>
                    <div class="slot-info">
                        <div class="group-name">${slot.group}</div>
                        <div class="discipline">${slot.discipline}</div>
                        <div class="participants">${slot.participants} participants</div>
                    </div>
                `;
                occupiedSlots.appendChild(slotElement);
            });
            
            // Masquer les créneaux disponibles par défaut
            availableSlots.style.display = 'none';
        }
    }

    function showAvailableSlots(dateString) {
        const dayData = scheduleData[dateString];
        const availableSlots = document.getElementById('availableSlots');
        const availableList = availableSlots.querySelector('.available-list');
        
        if (dayData && dayData.available.length > 0) {
            availableList.innerHTML = '';
            dayData.available.forEach(time => {
                const timeElement = document.createElement('div');
                timeElement.className = 'available-time';
                timeElement.textContent = time;
                availableList.appendChild(timeElement);
            });
            
            availableSlots.style.display = 'block';
        }
    }

    function changeMonth(direction) {
        currentDate.setMonth(currentDate.getMonth() + direction);
        updateCalendar();
    }

    function updateCalendar() {
        const monthNames = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];
        
        document.getElementById('currentMonth').textContent = 
            `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;            
        generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
    }

    // Fonction pour basculer vers Superviseur
    function switchToSupervisor() {
        window.location.href = 'suivi-materiel.html';
    }

    // Initialisation
    updateCalendar();
    updateDayDetails(selectedDateString, new Date(selectedDateString));
</script>
</html>