<h2>Liste des Groupes</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Responsable</th>
        <th>Contact</th>
        <th>Nombre</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($groupes as $groupe): ?>
        <tr>
            <td><?= $groupe['id'] ?></td>
            <td><?= $groupe['nom_responsable'] ?></td>
            <td><?= $groupe['contact'] ?></td>
            <td><?= $groupe['nombre'] ?></td>
            <td>
                <a href="<?= Flight::base() ?>/groupe/<?= $groupe['id'] ?>">Voir</a> |
                <a href="<?= Flight::base() ?>/groupe/delete/<?= $groupe['id'] ?>" onclick="return confirm('Supprimer ce groupe ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
