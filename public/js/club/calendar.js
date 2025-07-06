// Variables globales
let currentDate = null;
let selectedDateString = null;
let scheduleData = {};

const monthNames = [
    'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
    'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
];

// Initialisation sécurisée
function initCalendar(year, month, data) {
    currentDate = new Date(year, month - 1, 1);
    scheduleData = data || {};

    // Vérifier que tous les éléments existent
    const requiredElements = ['calendarBody', 'currentMonth', 'selectedDate', 'occupiedSlots', 'availableSlots', 'emptyDay'];
    const missingElements = requiredElements.filter(id => !document.getElementById(id));

    if (missingElements.length > 0) {
        console.error('Éléments manquants:', missingElements);
        return false;
    }

    updateCalendar();

    // Sélectionner le jour actuel par défaut
    const today = new Date().toISOString().split('T')[0];
    if (scheduleData[today]) {
        setTimeout(() => selectDay(today, new Date()), 100);
    }

    return true;
}

function generateCalendar(year, month) {
    const calendarBody = document.getElementById('calendarBody');
    if (!calendarBody) return;

    const firstDay = new Date(year, month, 1);

    // Correction : gérer le décalage pour commencer par lundi
    let dayOfWeek = firstDay.getDay();
    // Convertir dimanche (0) en 7 pour que lundi soit 1
    if (dayOfWeek === 0) dayOfWeek = 7;

    // Calculer le premier jour à afficher (lundi de la première semaine)
    const startDate = new Date(firstDay);
    startDate.setDate(firstDay.getDate() - (dayOfWeek - 1));

    calendarBody.innerHTML = '';

    for (let i = 0; i < 42; i++) { // 6 semaines
        const date = new Date(startDate);
        date.setDate(startDate.getDate() + i);

        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';

        if (date.getMonth() !== month) {
            dayElement.classList.add('other-month');
        }

        // Correction importante : utiliser le fuseau horaire local
        const dateString = date.getFullYear() + '-' +
            String(date.getMonth() + 1).padStart(2, '0') + '-' +
            String(date.getDate()).padStart(2, '0');

        const dayData = scheduleData[dateString];

        if (dayData) {
            dayElement.classList.add(`day-${dayData.status}`);

            if (dayData.status === 'partial' && dayData.available && dayData.available.length > 0) {
                const notification = document.createElement('div');
                notification.className = 'availability-notification';
                notification.innerHTML = '<i class="bi bi-plus"></i>';
                notification.onclick = (e) => {
                    e.stopPropagation();
                    showAvailableSlots(dateString);
                };
                dayElement.appendChild(notification);
            }
        } else {
            dayElement.classList.add('day-free');
        }

        dayElement.innerHTML += `<span class="day-number">${date.getDate()}</span>`;
        dayElement.onclick = (e) => {
            e.preventDefault();
            e.stopPropagation();
            selectDay(dateString, date);
        };

        if (dateString === selectedDateString) {
            dayElement.classList.add('selected');
        }

        calendarBody.appendChild(dayElement);
    }
}

function selectDay(dateString, date) {
    document.querySelectorAll('.calendar-day').forEach(day => {
        day.classList.remove('selected');
    });

    // Correction : trouver le bon élément à sélectionner
    const targetDay = Array.from(document.querySelectorAll('.calendar-day'))
        .find(day => {
            const dayNumber = day.querySelector('.day-number')?.textContent;
            const dayElement = day;
            const isOtherMonth = dayElement.classList.contains('other-month');

            // Vérifier que c'est le bon jour du bon mois
            return dayNumber == date.getDate().toString() &&
                ((date.getMonth() !== currentDate.getMonth()) === isOtherMonth);
        });

    if (targetDay) {
        targetDay.classList.add('selected');
    }

    selectedDateString = dateString;
    loadDayDetails(dateString, date);
}

async function loadDayDetails(dateString, date) {
    try {
        const baseUrl = window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/');
        const response = await fetch(`${baseUrl}/api/day-details/${dateString}`);
        const dayData = await response.json();

        if (response.ok) {
            updateDayDetails(dayData, date);
        } else {
            console.error('Erreur API:', dayData.error);
            updateDayDetails(null, date);
        }
    } catch (error) {
        console.error('Erreur réseau:', error);
        updateDayDetails(null, date);
    }
}

// Dans calendar.js, modifiez la fonction updateDayDetails
function updateDayDetails(dayData, date) {
    const selectedDate = document.getElementById('selectedDate');
    const occupiedSlots = document.getElementById('occupiedSlots');
    const availableSlots = document.getElementById('availableSlots');
    const emptyDay = document.getElementById('emptyDay');

    if (!selectedDate || !occupiedSlots || !availableSlots || !emptyDay) return;

    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    selectedDate.textContent = date.toLocaleDateString('fr-FR', options);

    // Vérifier si c'est un jour fermé
    if (dayData && dayData.status === 'closed') {
        occupiedSlots.parentElement.style.display = 'none';
        availableSlots.style.display = 'none';
        emptyDay.style.display = 'block';
        emptyDay.innerHTML = '<p class="text-muted">' + (dayData.message || 'Dojo fermé ce jour') + '</p>';
        return;
    }

    if (!dayData || !dayData.slots || dayData.slots.length === 0) {
        occupiedSlots.parentElement.style.display = 'none';
        emptyDay.style.display = 'block';
        emptyDay.innerHTML = '<p class="text-muted">Aucune réservation ce jour</p>';
    } else {
        emptyDay.style.display = 'none';
        occupiedSlots.parentElement.style.display = 'block';

        occupiedSlots.innerHTML = '';
        dayData.slots.forEach(slot => {
            const slotElement = document.createElement('div');
            slotElement.className = 'time-slot';
            slotElement.innerHTML = `
                <div class="slot-time">${slot.time}</div>
                <div class="group-name">${slot.group}</div>
                <div class="discipline">${slot.discipline}</div>
                <div class="participants">${slot.participants} participants</div>
            `;
            occupiedSlots.appendChild(slotElement);
        });
    }

    // Afficher les créneaux disponibles
    if (dayData && dayData.available && dayData.available.length > 0) {
        const availableList = document.getElementById('availableList');
        if (availableList) {
            availableList.innerHTML = '';
            dayData.available.forEach(timeSlot => {
                const timeElement = document.createElement('div');
                timeElement.className = 'available-time';
                timeElement.innerHTML = `
                    <i class="bi bi-clock text-success"></i>
                    <span>${timeSlot}</span>
                `;
                availableList.appendChild(timeElement);
            });
            availableSlots.style.display = 'block';
        }
    } else {
        availableSlots.style.display = 'none';
    }
}

function showAvailableSlots(dateString) {
    const dayData = scheduleData[dateString];
    const availableSlots = document.getElementById('availableSlots');

    if (dayData && dayData.available && dayData.available.length > 0 && availableSlots) {
        availableSlots.style.display = 'block';
        availableSlots.scrollIntoView({ behavior: 'smooth' });
    }
}

async function changeMonth(direction) {
    if (!currentDate) return;

    currentDate.setMonth(currentDate.getMonth() + direction);

    try {
        const baseUrl = window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/');
        const response = await fetch(
            `${baseUrl}/api/month/${currentDate.getFullYear()}/${currentDate.getMonth() + 1}`
        );
        const data = await response.json();

        if (response.ok) {
            scheduleData = data.schedule || {};
            updateCalendar();
        } else {
            console.error('Erreur changement de mois:', data.error);
        }
    } catch (error) {
        console.error('Erreur réseau:', error);
    }
}

function updateCalendar() {
    const currentMonthElement = document.getElementById('currentMonth');
    if (currentMonthElement && currentDate) {
        currentMonthElement.textContent =
            `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
    }
    generateCalendar(currentDate.getFullYear(), currentDate.getMonth());
}

// Export des fonctions globales
window.changeMonth = changeMonth;
window.initCalendar = initCalendar;