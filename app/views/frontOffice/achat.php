<link rel="stylesheet" href="<?=$url ?>/public/assets/css/achat-vente.css">
<div class="container-items">
    <?php  foreach ($animaux as $animal) { ?>
        <div class="item" style="background-image:url('<?php echo $url ?>/public/assets/css/image/papier.jpg')">
            <h3>Animal ID : <?= $animal['idAnimal'] ?></h3>
            <h3>Espece : <?= $animal['espece_nom'] ?></h3>
            <h3>Poids : <?= $animal['poidsInitial'] ?> kg</h3>
            <h3>Prix: <?= $animal['prix'] ?> Ariary</h3>
            <form action="achatAnimal" method="GET">
                <h3 for="">AutoVente</h3>
                <select name="autoVente" id="">
                    <option value="true">Oui</option>
                    <option value="false">Non</option>
                </select><br>
                <h3 for="">Date Vente</h3>
                <input type="date" name="dateVente" required>
                <input type="hidden" name="idAnimal" value="<?= $animal['idAnimal'] ?>">
                <input type="hidden" name="prixAchat" value="<?= $animal['prix'] ?>">
                <input type="hidden" name="idTransaction" value="<?= $animal['transaction_id'] ?>">
                <button type="submit">Acheter</button>
            </form>
        </div>
    <?php } ?>
</div>  