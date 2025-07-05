<h2>Ajouter une Réservation</h2>

<form method="post" action="<?= Flight::base() ?>/reservation/insert">
    <label>Club / Groupe :</label><br>
    <select name="id_club" required>
        <option value="" disabled selected>-- choisissez --</option>
        <?php foreach ($groupes as $g): ?>
            <option value="<?= $g['id'] ?>">
                <?= htmlspecialchars($g['nom_responsable']) ?> (<?= $g['nombre'] ?> pers)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Date de réservation :</label><br>
    <input type="datetime-local" name="date_reservation" required><br>

    <label>Date réservée :</label><br>
    <input type="datetime-local" name="date_reserve" required><br>

    <label>Heure de début :</label><br>
    <input type="time" name="heure_debut" required><br>

    <label>Heure de fin :</label><br>
    <input type="time" name="heure_fin" required><br>

    <label>Statut :</label><br>
    <select name="valeur" required>
        <option value="" disabled selected>-- statut --</option>
        <option value="demande">Demande</option>
        <option value="confirme">Confirmé</option>
    </select><br><br>

    <input type="submit" value="Ajouter">
</form>

<?php if (!empty($message)): ?>
    <p style="color:green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<a href="/reservations">← Retour à la liste</a>
