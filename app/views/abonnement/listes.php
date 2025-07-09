<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion des Abonnements - Self Defense</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg,rgb(49, 49, 71) 0%, #16213e 50%, #0f0f23 100%);
      min-height: 100vh;
      color: #ffffff;
      line-height: 1.6;
    }

    .container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 20px;
    }

    /* Header avec effet glassmorphism */
    .header {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 20px;
      padding: 30px;
      margin-bottom: 30px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .header::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: conic-gradient(from 0deg, transparent, rgba(255, 215, 0, 0.1), transparent);
      animation: rotate 20s linear infinite;
      z-index: -1;
    }

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .header h1 {
      font-size: 2.5rem;
      margin-bottom: 10px;
      background: linear-gradient(45deg, #ff6b6b, #ffd93d, #6bcf7f);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      text-shadow: 0 0 30px rgba(255, 107, 107, 0.3);
      animation: pulse 2s ease-in-out infinite alternate;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      100% { transform: scale(1.05); }
    }

    .header .subtitle {
      font-size: 1.2rem;
      color: #b0b0b0;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    /* Bouton d'ajout stylisé */
    .add-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 15px 30px;
      background: linear-gradient(45deg, #ff6b6b, #ff8e8e);
      color: white;
      text-decoration: none;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      box-shadow: 0 8px 25px rgba(255, 107, 107, 0.3);
      margin-bottom: 30px;
      position: relative;
      overflow: hidden;
    }

    .add-btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: left 0.5s ease;
    }

    .add-btn:hover::before {
      left: 100%;
    }

    .add-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 12px 35px rgba(255, 107, 107, 0.4);
    }

    /* Conteneur du tableau avec effet glassmorphism */
    .table-container {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px;
      overflow: hidden;
      position: relative;
    }

    .table-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 3px;
      background: linear-gradient(90deg, #ff6b6b, #ffd93d, #6bcf7f, #4ecdc4, #45b7d1);
      background-size: 200% 100%;
      animation: gradient-shift 3s ease infinite;
    }

    @keyframes gradient-shift {
      0%, 100% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
    }

    /* Styles du tableau */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th {
      background: linear-gradient(135deg, #2c3e50, #34495e);
      color: #ffffff;
      padding: 18px 15px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      border-bottom: 2px solid #3498db;
      position: relative;
    }

    th::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      width: 0;
      height: 2px;
      background: #3498db;
      transition: all 0.3s ease;
      transform: translateX(-50%);
    }

    th:hover::after {
      width: 100%;
    }

    td {
      padding: 15px;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      transition: all 0.3s ease;
    }

    tr {
      transition: all 0.3s ease;
    }

    tr:hover {
      background: rgba(255, 255, 255, 0.1);
      transform: scale(1.01);
    }

    /* Status badges */
    .status-badge {
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .status-active {
      background: linear-gradient(135deg, #27ae60, #2ecc71);
      color: white;
      box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
    }

    .status-inactive {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      color: white;
      box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }

    /* Boutons d'action */
    .action-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      text-decoration: none;
      border-radius: 25px;
      font-weight: 500;
      font-size: 0.9rem;
      margin: 0 3px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-edit {
      background: linear-gradient(135deg, #3498db, #2980b9);
      color: white;
      box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }

    .btn-edit:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    }

    .btn-delete {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      color: white;
      box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
    }

    .btn-delete:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
    }

    .btn-cancel {
      background: linear-gradient(135deg, #f39c12, #e67e22);
      color: white;
      box-shadow: 0 4px 15px rgba(243, 156, 18, 0.3);
    }

    .btn-cancel:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(243, 156, 18, 0.4);
    }

    /* Animations d'entrée */
    @keyframes slideInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .table-container {
      animation: slideInUp 0.8s ease-out;
    }

    .header {
      animation: slideInUp 0.6s ease-out;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      .container {
        padding: 15px;
      }

      .header h1 {
        font-size: 2rem;
      }

      .table-container {
        padding: 20px;
        overflow-x: auto;
      }

      table {
        min-width: 600px;
      }

      th, td {
        padding: 12px 8px;
        font-size: 0.9rem;
      }

      .action-btn {
        padding: 6px 12px;
        font-size: 0.8rem;
        margin: 2px;
      }
    }

    /* Effets de particules en arrière-plan */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: -1;
    }

    .particle {
      position: absolute;
      width: 2px;
      height: 2px;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 50%;
      animation: float 15s infinite linear;
    }

    @keyframes float {
      0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      90% {
        opacity: 1;
      }
      100% {
        transform: translateY(-100vh) rotate(360deg);
        opacity: 0;
      }
    }
  </style>
</head>
<body>
  <div class="particles" id="particles"></div>

  <div class="container">
    <div class="header">
      <h1><i class="fas fa-shield-alt"></i> Gestion des Abonnements</h1>
      <p class="subtitle">
        <i class="fas fa-users"></i>
        Système de gestion pour votre club de self-défense
      </p>
    </div>

    <a class="add-btn" href="<?= Flight::base() ?>/abonnement/create">
      <i class="fas fa-plus"></i>
      Ajouter un abonnement
    </a>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th><i class="fas fa-hashtag"></i> ID</th>
            <th><i class="fas fa-dumbbell"></i> Club</th>
            <th><i class="fas fa-calendar-day"></i> Jour</th>
            <th><i class="fas fa-calendar-alt"></i> Mois</th>
            <th><i class="fas fa-calendar-year"></i> Année</th>
            <th><i class="fas fa-check-circle"></i> Statut</th>
            <th><i class="fas fa-cogs"></i> Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($abonnements as $abonnement): ?>
            <tr>
              <td><strong><?= $abonnement['id_abonnement'] ?></strong></td>
              <td><?= $abonnement['id_club'] ?></td>
              <td><?= $abonnement['jour'] ?></td>
              <td><?= $abonnement['mois'] ?></td>
              <td><?= $abonnement['annee'] ?? date('Y') ?></td>
              <td>
                <span class="status-badge <?= $abonnement['actif'] ? 'status-active' : 'status-inactive' ?>">
                  <?= $abonnement['actif'] ? 'Actif' : 'Inactif' ?>
                </span>
              </td>
              <td>
                <a class="action-btn btn-edit" href="<?= Flight::base() ?>/abonnement/edit/<?= $abonnement['id_abonnement'] ?>">
                  <i class="fas fa-edit"></i> Modifier
                </a>
                <a class="action-btn btn-delete" href="<?= Flight::base() ?>/abonnement/delete/<?= $abonnement['id_abonnement'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonnement ?')">
                  <i class="fas fa-trash"></i> Supprimer
                </a>
                <?php if ($abonnement['actif']): ?>
                  <a class="action-btn btn-cancel" href="<?= Flight::base() ?>/abonnement/annuler/<?= $abonnement['id_abonnement'] ?>">
                    <i class="fas fa-ban"></i> Annuler
                  </a>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    // Création d'un effet de particules flottantes
    function createParticles() {
      const particlesContainer = document.getElementById('particles');
      const particleCount = 50;

      for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 15 + 's';
        particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
        particlesContainer.appendChild(particle);
      }
    }

    // Animation d'apparition des lignes du tableau
    function animateTableRows() {
      const rows = document.querySelectorAll('tbody tr');
      rows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateX(-50px)';
        setTimeout(() => {
          row.style.transition = 'all 0.6s ease';
          row.style.opacity = '1';
          row.style.transform = 'translateX(0)';
        }, index * 100);
      });
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', function() {
      createParticles();
      animateTableRows();
    });
  </script>
</body>
</html>