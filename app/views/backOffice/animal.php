<h2>Ajout de Animal</h2>
<form action="ajoutAnimal" method="post">
    <label for="">Espece</label>
    <select name="idEspece" id="">
        <?php foreach($especes as $espece) { ?>
            <option value="<?php echo $espece["id"] ?>"><?php echo $espece["nom"] ?></option>
        <?php } ?>
    </select>
    <label for="">Poids</label>
    <input type="number" name="poids" min="0" required>
    <label for="">Date Mort</label>
    <input type="date" name="dateMort" min="2025-02-03" required>
    <input type="sumbit" value="Ajouter">
</form>

<h2>Liste Animaux</h2>
<?php foreach($animaux as $animal) { ?>
    <p>Id : <?php echo $animal["animal_id"] ?></p>
    <p>Espece : <?php echo $animal["espece_nom"] ?></p>
    <p>Poids : <?php echo $animal["poidsInitial"] ?></p>
    <p>Date Mort : <?php echo $animal["dateMort"] ?></p>
    <p>Prix : <?php echo $animal["prixVenteKg"]*$animal["poids"] ?> ar </p>
<?php } ?>
