<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Sorties</title>
    <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png">
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">

    <!-- modul css -->    
    <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">

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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Statistiques des Sorties</h3>
                            <p class="text-subtitle text-muted">Analyse des dépenses et sorties financières</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= Flight::base() ?>/">Accueil</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Statistiques des Sorties</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="container-fluid">
                            <h2 class="text-center mb-4">Statistiques des Sorties</h2>
    
    <!-- Filtre par période -->
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Filtre par période</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="date_debut">Date de début</label>
                            <input type="date" id="date_debut" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="date_fin">Date de fin</label>
                            <input type="date" id="date_fin" class="form-control">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button id="filter-btn" class="btn btn-primary btn-block">Filtrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Résumé global -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Résumé global</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 id="total-sorties">0</h3>
                                    <p>Nombre total de sorties</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 id="total-montant">0 Ar</h3>
                                    <p>Montant total des sorties</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 id="moyenne-montant">0 Ar</h3>
                                    <p>Montant moyen par sortie</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 id="sorties-mois">0</h3>
                                    <p>Sorties ce mois-ci</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Graphique par catégorie -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Répartition par catégorie</h5>
                </div>
                <div class="card-body">
                    <canvas id="categorie-chart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Graphique par statut -->
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Répartition par statut</h5>
                </div>
                <div class="card-body">
                    <canvas id="statut-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mb-4">
        <!-- Graphique évolution par période -->
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Évolution des sorties par période</h5>
                </div>
                <div class="card-body">
                    <canvas id="periode-chart"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Top motifs de sortie -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Top motifs de sortie</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-striped table-sm" id="motifs-table">
                            <thead>
                                <tr>
                                    <th>Motif</th>
                                    <th>Nombre</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Les données seront chargées par JavaScript -->
                            </tbody>
                        </table>
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
            
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2025 &copy; Dojo Integration</p>
                    </div>
                    <div class="float-end">
                        <p>
                            Développé avec 
                            <span class="text-danger">
                                <i class="bi bi-heart-fill"></i>
                            </span>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <!-- Scripts -->

    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Objets pour stocker nos graphiques
    let categorieChart;
    let statutChart;
    let periodeChart;
    
    // Fonction pour formater les montants en Ariary
    function formatMoney(amount) {
        return new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'MGA',
            minimumFractionDigits: 0
        }).format(amount).replace('MGA', 'Ar');
    }
    
    // Fonction pour charger toutes les statistiques
    function loadAllStats() {
        // Charger les stats par catégorie
        $.ajax({
            url: '<?= Flight::base() ?>/api/stats/sorties/categorie',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    renderCategorieChart(response.stats);
                }
            },
            error: function(xhr) {
                console.error('Erreur lors du chargement des statistiques par catégorie', xhr);
            }
        });
        
        // Charger les stats par statut
        $.ajax({
            url: '<?= Flight::base() ?>/api/stats/sorties/statut',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    renderStatutChart(response.stats);
                }
            },
            error: function(xhr) {
                console.error('Erreur lors du chargement des statistiques par statut', xhr);
            }
        });
        
        // Charger les stats par motif
        $.ajax({
            url: '<?= Flight::base() ?>/api/stats/sorties/motif',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    renderMotifsTable(response.stats);
                }
            },
            error: function(xhr) {
                console.error('Erreur lors du chargement des statistiques par motif', xhr);
            }
        });
        
        // Charger les stats par période
        $.ajax({
            url: '<?= Flight::base() ?>/api/stats/sorties/periode',
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    renderPeriodeChart(response.stats);
                    updateGlobalStats(response.stats);
                }
            },
            error: function(xhr) {
                console.error('Erreur lors du chargement des statistiques par période', xhr);
            }
        });
    }
    
    // Fonction pour mettre à jour les statistiques globales
    function updateGlobalStats(periodesData) {
        let totalSorties = 0;
        let totalMontant = 0;
        let sortiesMoisCourant = 0;
        let montantMoisCourant = 0;
        
        // Get current month in format YYYY-MM
        const now = new Date();
        const currentPeriod = `${now.getFullYear()}-${(now.getMonth() + 1).toString().padStart(2, '0')}`;
        
        periodesData.forEach(periode => {
            totalSorties += parseInt(periode.total_sorties);
            totalMontant += parseFloat(periode.montant_total);
            
            if (periode.periode === currentPeriod) {
                sortiesMoisCourant = parseInt(periode.total_sorties);
                montantMoisCourant = parseFloat(periode.montant_total);
            }
        });
        
        const moyenneMontant = totalSorties > 0 ? totalMontant / totalSorties : 0;
        
        $('#total-sorties').text(totalSorties);
        $('#total-montant').text(formatMoney(totalMontant));
        $('#moyenne-montant').text(formatMoney(moyenneMontant));
        $('#sorties-mois').text(sortiesMoisCourant);
    }
    
    // Fonction pour rendre le graphique par catégorie
    function renderCategorieChart(data) {
        const ctx = document.getElementById('categorie-chart').getContext('2d');
        
        const labels = data.map(item => item.categorie);
        const montants = data.map(item => parseFloat(item.montant_total));
        const nombreSorties = data.map(item => parseInt(item.total_sorties));
        
        // Définir les couleurs pour les catégories
        const backgroundColors = {
            'materiel': 'rgba(54, 162, 235, 0.7)',
            'maintenance': 'rgba(255, 206, 86, 0.7)',
            'facture': 'rgba(75, 192, 192, 0.7)',
            'salaire': 'rgba(153, 102, 255, 0.7)'
        };
        
        // Si le graphique existe déjà, le détruire
        if (categorieChart) {
            categorieChart.destroy();
        }
        
        categorieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Montant total (Ar)',
                    data: montants,
                    backgroundColor: labels.map(label => backgroundColors[label] || 'rgba(201, 203, 207, 0.7)'),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw;
                                const index = context.dataIndex;
                                const count = nombreSorties[index];
                                
                                return [
                                    `${label}: ${formatMoney(value)}`,
                                    `Nombre de sorties: ${count}`
                                ];
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Fonction pour rendre le graphique par statut
    function renderStatutChart(data) {
        const ctx = document.getElementById('statut-chart').getContext('2d');
        
        const labels = data.map(item => item.statut);
        const montants = data.map(item => parseFloat(item.montant_total));
        const nombreSorties = data.map(item => parseInt(item.total_sorties));
        
        // Utiliser les couleurs définies dans la base de données
        const backgroundColors = data.map(item => {
            // Transformer les couleurs textuelles en couleurs rgba
            const colorMap = {
                'warning': 'rgba(255, 193, 7, 0.7)',
                'success': 'rgba(40, 167, 69, 0.7)',
                'danger': 'rgba(220, 53, 69, 0.7)',
                'secondary': 'rgba(108, 117, 125, 0.7)',
                'info': 'rgba(23, 162, 184, 0.7)'
            };
            
            return colorMap[item.couleur] || 'rgba(201, 203, 207, 0.7)';
        });
        
        // Si le graphique existe déjà, le détruire
        if (statutChart) {
            statutChart.destroy();
        }
        
        statutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Montant total (Ar)',
                    data: montants,
                    backgroundColor: backgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw;
                                const index = context.dataIndex;
                                const count = nombreSorties[index];
                                
                                return [
                                    `${label}: ${formatMoney(value)}`,
                                    `Nombre de sorties: ${count}`
                                ];
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Fonction pour rendre le tableau des motifs
    function renderMotifsTable(data) {
        const tableBody = $('#motifs-table tbody');
        tableBody.empty();
        
        data.forEach(item => {
            const row = $('<tr>');
            row.append($('<td>').text(item.motif));
            row.append($('<td>').text(item.total_sorties));
            row.append($('<td>').text(formatMoney(item.montant_total)));
            tableBody.append(row);
        });
    }
    
    // Fonction pour rendre le graphique par période
    function renderPeriodeChart(data) {
        const ctx = document.getElementById('periode-chart').getContext('2d');
        
        // Inverser les données pour afficher du plus ancien au plus récent
        const reversedData = [...data].reverse();
        
        const labels = reversedData.map(item => {
            // Transformer YYYY-MM en format plus lisible (ex: Janv 2025)
            const [year, month] = item.periode.split('-');
            const monthNames = ['Janv', 'Fév', 'Mars', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'];
            return `${monthNames[parseInt(month) - 1]} ${year}`;
        });
        
        const montants = reversedData.map(item => parseFloat(item.montant_total));
        const nombreSorties = reversedData.map(item => parseInt(item.total_sorties));
        
        // Si le graphique existe déjà, le détruire
        if (periodeChart) {
            periodeChart.destroy();
        }
        
        periodeChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Montant total (Ar)',
                        data: montants,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Nombre de sorties',
                        data: nombreSorties,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderWidth: 2,
                        borderDash: [5, 5],
                        fill: false,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Montant (Ar)'
                        },
                        ticks: {
                            callback: function(value) {
                                return formatMoney(value);
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Nombre de sorties'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.dataset.label || '';
                                const value = context.raw;
                                
                                if (label.includes('Montant')) {
                                    return `${label}: ${formatMoney(value)}`;
                                } else {
                                    return `${label}: ${value}`;
                                }
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Événement au chargement de la page
    $(document).ready(function() {
        // Initialiser la date de fin à aujourd'hui
        const today = new Date();
        $('#date_fin').val(today.toISOString().split('T')[0]);
        
        // Initialiser la date de début à un mois auparavant
        const lastMonth = new Date();
        lastMonth.setMonth(today.getMonth() - 1);
        $('#date_debut').val(lastMonth.toISOString().split('T')[0]);
        
        // Charger toutes les statistiques
        loadAllStats();
        
        // Événement du bouton de filtrage
        $('#filter-btn').click(function() {
            // Implémentation du filtrage à faire
            // Pour l'instant, juste recharger toutes les stats
            loadAllStats();
        });
    });
</script>
