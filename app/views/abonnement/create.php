<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Nouvel Abonnement</title>
  <style>
      :root {
        --primary-color: #2c3e50;
        --secondary-color: #e74c3c;
        --accent-color: #f39c12;
        --light-color: #ecf0f1;
        --dark-color: #1a1a1a;
        --success-color: #27ae60;
      }

      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }

      body {
        background-color: #f5f5f5;
        color: var(--dark-color);
        line-height: 1.6;
        padding: 20px;
        background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                          url('https://images.unsplash.com/photo-1547347298-4074fc3086f0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
      }

      h2 {
        color: var(--primary-color);
        text-align: center;
        margin-bottom: 30px;
        font-size: 2.2rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        position: relative;
        padding-bottom: 10px;
      }

      h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background-color: var(--secondary-color);
      }

      form {
        max-width: 600px;
        margin: 0 auto;
        padding: 30px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-top: 5px solid var(--secondary-color);
      }

      label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--primary-color);
      }

      input[type="number"],
      input[type="text"],
      select {
        width: 100%;
        padding: 12px;
        margin-bottom: 20px;
        border: 2px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        transition: border 0.3s;
      }

      input[type="number"]:focus,
      input[type="text"]:focus,
      select:focus {
        border-color: var(--accent-color);
        outline: none;
      }

      button[type="submit"] {
        background-color: var(--secondary-color);
        color: white;
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
      }

      button[type="submit"]:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      }

      a {
        display: inline-block;
        padding: 10px 20px;
        background-color: var(--primary-color);
        color: white;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s;
        font-weight: 600;
      }

      a:hover {
        background-color: #1a252f;
        transform: translateY(-2px);
      }

      p {
        text-align: center;
        margin-bottom: 30px;
        font-size: 1.1rem;
      }

      /* Animation pour les boutons */
      @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
      }

      button[type="submit"]:hover,
      a:hover {
        animation: pulse 0.5s ease-in-out;
      }

      /* Style spécifique pour la page d'annulation */
      body.annulation {
        background-image: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                          url('https://images.unsplash.com/photo-1517438322307-e67111335449?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
      }

      /* Style pour les messages */
      .message {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
        text-align: center;
        font-weight: 600;
      }

      .success {
        background-color: rgba(46, 204, 113, 0.2);
        color: var(--success-color);
        border-left: 4px solid var(--success-color);
      }

      .error {
        background-color: rgba(231, 76, 60, 0.2);
        color: var(--secondary-color);
        border-left: 4px solid var(--secondary-color);
      }
      /* Votre CSS existant */
    .btn-retour {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: var(--primary-color);
      color: white;
      text-decoration: none;
      border-radius: 4px;
      transition: all 0.3s;
      font-weight: 600;
    }

    .btn-retour:hover {
      background-color: #1a252f;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <h2>Créer un abonnement</h2>
    <?php if (isset($message)): ?>
    <div class="message <?= strpos($message, 'réussie') !== false ? 'success' : 'error' ?>">
      <?= $message ?>
    </div>
  <?php endif; ?>
  <form method="post" action="<?= Flight::base() ?>/abonnement/create">
    <label>ID Club :</label>
    <input type="number" name="id_club" required><br>

    <label>Jour :</label>
    <input type="number" name="jour" required><br>

    <label>Mois :</label>
    <input type="number" name="mois" required><br>

    <label>Année :</label>
    <input type="number" name="annee" value="<?= date('Y') ?>" required><br>

    <label>Actif :</label>
    <select name="actif">
      <option value="true">Oui</option>
      <option value="false">Non</option>
    </select><br><br>

    <button type="submit">Créer</button>
  </form>
 <a href="<?= Flight::base() ?>/abonnements" class="btn-retour">← Retour à la liste</a>
</body>
</html>
