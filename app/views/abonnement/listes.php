<!DOCTYPE html>
                      <html lang="fr">
                      <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Gestion des Abonnements - Self Defense</title>
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
                                <h1><i class="fas fa-shield-alt"></i> Gestion des Abonnements</h1>
                                <p class="subtitle">
                                  <i class="fas fa-users"></i>
                                  Système de gestion pour votre club de self-défense
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

                              <div class="actions-container">
                                <a class="btn btn-primary add-btn" href="<?= Flight::base() ?>/abonnement/create">
                                  <i class="fas fa-plus"></i>
                                  Ajouter un abonnement
                                </a>
                              </div>

                              <div class="table-container">
                                <?php if (isset($abonnements) && !empty($abonnements)): ?>
                                  <div class="table-wrapper">
                                    <table class="data-table">
                                      <thead class="table-header">
                                        <tr>
                                          <th class="th-id"><i class="fas fa-hashtag"></i> ID</th>
                                          <th class="th-club"><i class="fas fa-dumbbell"></i> Club</th>
                                          <th class="th-day"><i class="fas fa-calendar-day"></i> Jour</th>
                                          <th class="th-month"><i class="fas fa-calendar-alt"></i> Mois</th>
                                          <th class="th-year"><i class="fas fa-calendar-year"></i> Année</th>
                                          <th class="th-status"><i class="fas fa-check-circle"></i> Statut</th>
                                          <th class="th-actions"><i class="fas fa-cogs"></i> Actions</th>
                                        </tr>
                                      </thead>
                                      <tbody class="table-body">
                                        <?php foreach ($abonnements as $index => $abonnement): ?>
                                          <tr class="table-row" data-index="<?= $index ?>">
                                            <td class="td-id">
                                              <span class="id-badge"><?= $abonnement['id_abonnement'] ?></span>
                                            </td>
                                            <td class="td-club">
                                              <span class="club-info">
                                                <i class="fas fa-building"></i>
                                                <?= $abonnement['id_club'] ?>
                                              </span>
                                            </td>
                                            <td class="td-day"><?= $abonnement['jour'] ?></td>
                                            <td class="td-month"><?= $abonnement['mois'] ?></td>
                                            <td class="td-year"><?= $abonnement['annee'] ?? date('Y') ?></td>
                                            <td class="td-status">
                                              <span class="status-badge <?= $abonnement['actif'] ? 'status-active' : 'status-inactive' ?>">
                                                <i class="fas <?= $abonnement['actif'] ? 'fa-check-circle' : 'fa-times-circle' ?>"></i>
                                                <?= $abonnement['actif'] ? 'Actif' : 'Inactif' ?>
                                              </span>
                                            </td>
                                            <td class="td-actions">
                                              <div class="action-buttons">
                                                <a class="action-btn btn-edit" href="<?= Flight::base() ?>/abonnement/edit/<?= $abonnement['id_abonnement'] ?>" title="Modifier">
                                                  <i class="fas fa-edit"></i>
                                                  <span class="btn-text">Modifier</span>
                                                </a>
                                                <a class="action-btn btn-delete" href="<?= Flight::base() ?>/abonnement/delete/<?= $abonnement['id_abonnement'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet abonnement ?')" title="Supprimer">
                                                  <i class="fas fa-trash"></i>
                                                  <span class="btn-text">Supprimer</span>
                                                </a>
                                                <?php if ($abonnement['actif']): ?>
                                                  <a class="action-btn btn-cancel" href="<?= Flight::base() ?>/abonnement/annuler/<?= $abonnement['id_abonnement'] ?>" title="Annuler">
                                                    <i class="fas fa-ban"></i>
                                                    <span class="btn-text">Annuler</span>
                                                  </a>
                                                <?php endif; ?>
                                              </div>
                                            </td>
                                          </tr>
                                        <?php endforeach; ?>
                                      </tbody>
                                    </table>
                                  </div>

                                  <div class="table-footer">
                                    <div class="table-info">
                                      <span class="total-count">
                                        <i class="fas fa-info-circle"></i>
                                        Total: <?= count($abonnements) ?> abonnement(s)
                                      </span>
                                    </div>
                                  </div>

                                <?php elseif (isset($abonnements) && empty($abonnements)): ?>
                                  <div class="empty-state">
                                    <div class="empty-icon">
                                      <i class="fas fa-inbox"></i>
                                    </div>
                                    <h3 class="empty-title">Aucun abonnement trouvé</h3>
                                    <p class="empty-message">Il n'y a actuellement aucun abonnement dans le système.</p>
                                    <a href="<?= Flight::base() ?>/abonnement/create" class="btn btn-primary">
                                      <i class="fas fa-plus"></i>
                                      Créer le premier abonnement
                                    </a>
                                  </div>

                                <?php else: ?>
                                  <div class="error-state">
                                    <div class="error-icon">
                                      <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <h3 class="error-title">Erreur de chargement</h3>
                                    <p class="error-message">Impossible de charger les abonnements. Veuillez réessayer.</p>
                                    <button onclick="location.reload()" class="btn btn-secondary">
                                      <i class="fas fa-refresh"></i>
                                      Actualiser
                                    </button>
                                  </div>
                                <?php endif; ?>
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
                          const rows = document.querySelectorAll('.table-row');
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

                        // Animation d'apparition du conteneur de table
                        function animateTableContainer() {
                          const tableContainer = document.querySelector('.table-container');
                          if (tableContainer) {
                            tableContainer.style.opacity = '0';
                            tableContainer.style.transform = 'translateY(30px)';
                            setTimeout(() => {
                              tableContainer.style.transition = 'all 0.8s ease';
                              tableContainer.style.opacity = '1';
                              tableContainer.style.transform = 'translateY(0)';
                            }, 200);
                          }
                        }

                        // Effet hover sur les boutons d'action
                        function setupActionButtons() {
                          const actionButtons = document.querySelectorAll('.action-btn');
                          actionButtons.forEach(btn => {
                            btn.addEventListener('mouseenter', function() {
                              this.style.transform = 'scale(1.05)';
                            });
                            btn.addEventListener('mouseleave', function() {
                              this.style.transform = 'scale(1)';
                            });
                          });
                        }

                        // Initialisation
                        document.addEventListener('DOMContentLoaded', function() {
                          createParticles();
                          animateTableContainer();
                          setTimeout(() => {
                            animateTableRows();
                          }, 400);
                          setupActionButtons();
                        });
                      </script>
                      </body>
                      </html>