<h2>Modifier un Groupe</h2>
<form method="post" action="<?= Flight::base() ?>/groupe/update/<?= $groupe['id'] ?>">
    <label>Responsable:</label><br>
    <input type="text" name="nom_responsable" value="<?= $groupe['nom_responsable'] ?>" required><br>
    <label>Contact:</label><br>
    <input type="text" name="contact" value="<?= $groupe['contact'] ?>" required><br>
    <label>Nombre:</label><br>
    <input type="number" name="nombre" value="<?= $groupe['nombre'] ?>" required><br><br>
    <input type="submit" value="Modifier">
</form>
<?= isset($message) ? "<p>$message</p>" : "" ?>
