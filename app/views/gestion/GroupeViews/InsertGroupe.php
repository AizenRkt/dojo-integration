<h2>Ajouter un Groupe</h2>
<form method="post" action="<?= Flight::base() ?>/groupe/insert">
    <label>Responsable:</label><br>
    <input type="text" name="nom_responsable" required><br>
    <label>Contact:</label><br>
    <input type="text" name="contact" required><br>
    <label>Discipline:</label><br>
    <input type="text" name="discipline" required><br>
    <label>Nombre:</label><br>
    <input type="number" name="nombre" required><br><br>
    <input type="submit" value="Ajouter">
</form>
<?= isset($message) ? "<p>$message</p>" : "" ?>
