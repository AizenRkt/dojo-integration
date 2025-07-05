<h2>Détails de la Réservation</h2>

<?php if (!empty($message)): ?>
    <p style="color:green;"><?= $message ?></p>
<?php endif; ?>

<form method="post" action="<?= Flight::base() ?>/reservation/update/<?= $reservation['id_reservation'] ?>">
    <label>ID Club:</label><br>
    <input type="number" name="id_club" value="<?= $reservation['id_club'] ?>" required><br>

    <label>Date de réservation:</label><br>
    <input type="datetime-local" name="date_reservation" value="<?= date('Y-m-d\TH:i', strtotime($reservation['date_reservation'])) ?>" required><br>

    <label>Date réservée:</label><br>
    <input type="datetime-local" name="date_reserve" value="<?= date('Y-m-d\TH:i', strtotime($reservation['date_reserve'])) ?>" required><br>

    <label>Heure de début:</label><br>
    <input type="time" name="heure_debut" value="<?= $reservation['heure_debut'] ?>" required><br>

    <label>Heure de fin:</label><br>
    <input type="time" name="heure_fin" value="<?= $reservation['heure_fin'] ?>" required><br><br>

    <input type="submit" value="Mettre à jour">
</form>

<a href="<?= Flight::base() ?>/reservations">← Retour à la liste</a>
