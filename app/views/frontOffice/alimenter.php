<!-- filepath: /c:/xampp/htdocs/Elevage/app/views/frontOffice/alimenter.php -->
<?php
if (!isset($Error)) {
    echo $Error;
}
if (!isset($Success)) {
    echo $Success;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alimenter un Animal</title>
</head>

<body>
    <h1>Alimenter un Animal</h1>
    <form action="/nourrir" method="post">
        <label for="IdAnimal">Sélectionnez un Animal:</label>
        <select name="IdAnimal" id="IdAnimal" required>
            <?php foreach ($animals as $animal): ?>
                <option value="<?= $animal['id'] ?>"><?= $animal['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="idAlimentation">Sélectionnez une Alimentation:</label>
        <select name="idAlimentation" id="idAlimentation" required>
            <?php foreach ($alimentations as $alimentation): ?>
                <option value="<?= $alimentation['id'] ?>"><?= $alimentation['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="nbPortion">Nombre de Portions:</label>
        <input type="number" name="nbPortion" id="nbPortion" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <br>
        <button type="submit">Valider</button>
    </form>
</body>

</html>