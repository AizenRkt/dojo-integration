<!DOCTYPE html>
    <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Nouvel Abonnement - Self Defense</title>
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
      <link rel="shortcut icon" href="<?= Flight::base() ?>/public/assets/compiled/svg/favicon.svg" type="image/x-icon">
      <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/app.css">
      <link rel="stylesheet" href="<?= Flight::base() ?>/public/assets/compiled/css/iconly.css">
    </head>
    <body>
    <div id="app">
        <?= Flight::menuAdmin()?>
        <div id="main">
          <div class="particles" id="particles"></div>

          <div class="container">
            <div class="header">
              <h1><i class="fas fa-plus-circle"></i> Créer un Abonnement</h1>
              <p class="subtitle">
                <i class="fas fa-shield-alt"></i>
                Ajouter un nouvel abonnement au système
              </p>
            </div>

            <?php if (isset($message)): ?>
              <div class="alert-container">
                <div class="message alert <?= strpos($message, 'réussie') !== false ? 'alert-success' : 'alert-error' ?>">
                  <i class="fas <?= strpos($message, 'réussie') !== false ? 'fa-check-circle' : 'fa-exclamation-triangle' ?>"></i>
                  <?= $message ?>
                </div>
              </div>
            <?php endif; ?>

            <div class="form-container">
              <form method="post" action="<?= Flight::base() ?>/abonnement/create" class="subscription-form">
                <div class="form-grid">
                  <div class="form-group">
                    <label for="id_club" class="form-label">
                      <i class="fas fa-dumbbell"></i> ID Club :
                    </label>
                    <input type="number" id="id_club" name="id_club" class="form-input" required>
                  </div>

                  <div class="form-group">
                    <label for="jour" class="form-label">
                      <i class="fas fa-calendar-day"></i> Jour :
                    </label>
                    <input type="number" id="jour" name="jour" class="form-input" min="1" max="31" required>
                  </div>

                  <div class="form-group">
                    <label for="mois" class="form-label">
                      <i class="fas fa-calendar-alt"></i> Mois :
                    </label>
                    <input type="number" id="mois" name="mois" class="form-input" min="1" max="12" required>
                  </div>

                  <div class="form-group">
                    <label for="annee" class="form-label">
                      <i class="fas fa-calendar-year"></i> Année :
                    </label>
                    <input type="number" id="annee" name="annee" class="form-input" value="<?= date('Y') ?>" min="<?= date('Y') ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="actif" class="form-label">
                      <i class="fas fa-toggle-on"></i> Statut :
                    </label>
                    <select id="actif" name="actif" class="form-select">
                      <option value="true" selected>
                        <i class="fas fa-check"></i> Actif
                      </option>
                      <option value="false">
                        <i class="fas fa-times"></i> Inactif
                      </option>
                    </select>
                  </div>
                </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Créer l'abonnement
                  </button>

                  <a href="<?= Flight::base() ?>/abonnements" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Retour à la liste
                  </a>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <script src="<?= Flight::base() ?>/public/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= Flight::base() ?>/public/assets/compiled/js/app.js"></script>
    <script>
      // Création d'un effet de particules flottantes
      function createParticles() {
        const particlesContainer = document.getElementById('particles');
        if (!particlesContainer) return;

        const particleCount = 30;

        for (let i = 0; i < particleCount; i++) {
          const particle = document.createElement('div');
          particle.className = 'particle';
          particle.style.left = Math.random() * 100 + '%';
          particle.style.animationDelay = Math.random() * 15 + 's';
          particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
          particlesContainer.appendChild(particle);
        }
      }

      // Animation d'apparition du formulaire
      function animateForm() {
        const formContainer = document.querySelector('.form-container');
        if (formContainer) {
          formContainer.style.opacity = '0';
          formContainer.style.transform = 'translateY(30px)';
          setTimeout(() => {
            formContainer.style.transition = 'all 0.8s ease';
            formContainer.style.opacity = '1';
            formContainer.style.transform = 'translateY(0)';
          }, 300);
        }
      }

      // Validation en temps réel
      function setupFormValidation() {
        const form = document.querySelector('.subscription-form');
        const inputs = form.querySelectorAll('input, select');

        inputs.forEach(input => {
          input.addEventListener('blur', function() {
            if (this.checkValidity()) {
              this.classList.add('valid');
              this.classList.remove('invalid');
            } else {
              this.classList.add('invalid');
              this.classList.remove('valid');
            }
          });
        });
      }

      // Initialisation
      document.addEventListener('DOMContentLoaded', function() {
        createParticles();
        animateForm();
        setupFormValidation();
      });
    </script>
    </body>
    </html>