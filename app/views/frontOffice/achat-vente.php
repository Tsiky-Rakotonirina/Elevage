<?php foreach ($animaux as $animal){ ?>
    <p>
        Animal ID: <?= $animal['idAnimal'] ?><br>
        Espece: <?= $animal['espece_nom'] ?><br>
        Poids: <?= $animal['poids'] ?> kg<br>
        Prix: <?= $animal['prix'] ?> ar<br>
        <form action="achatAnimal" method="GET">
            <input type="hidden" name="idAnimal" value="<?= $animal['idAnimal'] ?>">
            <input type="hidden" name="prixAchat" value="<?= $animal['prix'] ?>">
            <button type="submit">Acheter</button>
        </form>
    </p>
<?php } ?>

<?php if(isset($erreur)) { 
    echo $erreur;
}?>
