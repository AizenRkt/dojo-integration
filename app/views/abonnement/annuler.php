<!DOCTYPE html>
            <html lang="fr">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Annuler Abonnement - Self Defense</title>
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
                      <h1><i class="fas fa-ban"></i> Annuler Abonnement</h1>
                      <p class="subtitle">
                        <i class="fas fa-exclamation-triangle"></i>
                        Confirmation d'annulation de l'abonnement #<?= $abonnement['id_abonnement'] ?>
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

                    <div class="confirmation-container">
                      <div class="confirmation-card">
                        <div class="confirmation-icon">
                          <i class="fas fa-question-circle"></i>
                        </div>

                        <div class="confirmation-content">
                          <h3>Confirmation d'annulation</h3>
                          <p class="confirmation-text">
                            Voulez-vous vraiment annuler cet abonnement n°<strong><?= $abonnement['id_abonnement'] ?></strong> ?
                          </p>

                          <div class="subscription-details">
                            <div class="detail-item">
                              <i class="fas fa-dumbbell"></i>
                              <span>Club ID: <?= $abonnement['id_club'] ?></span>
                            </div>
                            <div class="detail-item">
                              <i class="fas fa-calendar"></i>
                              <span>Date: <?= $abonnement['jour'] ?>/<?= $abonnement['mois'] ?>/<?= $abonnement['annee'] ?? date('Y') ?></span>
                            </div>
                            <div class="detail-item">
                              <i class="fas fa-check-circle"></i>
                              <span>Statut: <?= $abonnement['actif'] ? 'Actif' : 'Inactif' ?></span>
                            </div>
                          </div>
                        </div>

                        <div class="form-container">
                          <form method="post" action="<?= Flight::base() ?>/abonnement/annuler/<?= $abonnement['id_abonnement'] ?>" class="confirmation-form">
                            <div class="form-actions confirmation-actions">
                              <button type="submit" class="btn btn-danger">
                                <i class="fas fa-ban"></i>
                                Oui, annuler l'abonnement
                              </button>

                              <a href="<?= Flight::base() ?>/abonnements" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                                Non, retour à la liste
                              </a>
                            </div>
                          </form>
                        </div>
                      </div>
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

              // Animation d'apparition du contenu
              function animateConfirmation() {
                const confirmationCard = document.querySelector('.confirmation-card');
                if (confirmationCard) {
                  confirmationCard.style.opacity = '0';
                  confirmationCard.style.transform = 'scale(0.9) translateY(30px)';
                  setTimeout(() => {
                    confirmationCard.style.transition = 'all 0.8s ease';
                    confirmationCard.style.opacity = '1';
                    confirmationCard.style.transform = 'scale(1) translateY(0)';
                  }, 300);
                }
              }

              // Effet de pulsation sur l'icône
              function animateIcon() {
                const icon = document.querySelector('.confirmation-icon i');
                if (icon) {
                  setInterval(() => {
                    icon.style.transform = 'scale(1.1)';
                    setTimeout(() => {
                      icon.style.transform = 'scale(1)';
                    }, 200);
                  }, 2000);
                }
              }

              // Initialisation
              document.addEventListener('DOMContentLoaded', function() {
                createParticles();
                animateConfirmation();
                animateIcon();
              });
            </script>
            </body>
            </html>