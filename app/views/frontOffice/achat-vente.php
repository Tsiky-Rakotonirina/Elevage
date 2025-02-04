<link rel="stylesheet" href="<?=$url ?>/public/assets/css/achat-vente.css">
<div class="container-items">
    <?php  foreach ($animaux as $animal) { ?>
        <div class="item" style="background-image:url('<?php echo $url ?>/public/assets/css/image/papier.jpg')">
            <h3>Animal ID : <?= $animal['idAnimal'] ?></h3>
            <h3>Espece : <?= $animal['espece_nom'] ?></h3>
            <h3>Poids : <?= $animal['poids'] ?> kg</h3>
            <h3>Prix: <?= $animal['prix'] ?> Ariary</h3>
            <form action="achatAnimal" method="GET">
                <input type="hidden" name="idAnimal" value="<?= $animal['idAnimal'] ?>">
                <input type="hidden" name="prixAchat" value="<?= $animal['prix'] ?>">
                <button type="submit">Acheter</button>
            </form>
        </div>
    <?php } ?>
</div>