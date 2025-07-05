<h2>Liste des Réservations</h2>

<?php if (!empty($message)): ?>
    <p style="color:green;"><?= $message ?></p>
<?php endif; ?>

<a href="<?= Flight::base() ?>/reservation/insert">+ Ajouter une nouvelle réservation</a>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>ID Club</th>
        <th>Date de réservation</th>
        <th>Date réservée</th>
        <th>Heure début</th>
        <th>Heure fin</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($reservations as $res): ?>
        <tr>
            <td><?= $res['id_reservation'] ?></td>
            <td><?= $res['id_club'] ?></td>
            <td><?= $res['date_reservation'] ?></td>
            <td><?= $res['date_reserve'] ?></td>
            <td><?= $res['heure_debut'] ?></td>
            <td><?= $res['heure_fin'] ?></td>
            <td>
                <a href="<?= Flight::base() ?>/reservation/<?= $res['id_reservation'] ?>">Voir</a> |
                <a href="<?= Flight::base() ?>/reservation/delete/<?= $res['id_reservation'] ?>" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
