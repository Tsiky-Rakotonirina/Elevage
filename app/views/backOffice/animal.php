<link rel="stylesheet" href="<?= $url ?>/public/assets/css/animal.css">

<div class="container-section">
    <div class="section1">
        <div class="title">
            <img src="<?php echo $url?>/public/assets/css/image/mort.png" alt="">
            <h3 style="color:brown">Ajout Animal</h3>
        </div>
        <div class="container-input">
            <form action="ajoutAnimal" method="post">
                <label for="">Espece : </label>
                <select name="idEspece" id="">
                    <?php foreach($especes as $espece) { ?>
                        <option value="<?php echo $espece["id"] ?>"><?php echo $espece["nom"] ?></option>
                    <?php } ?>
                </select><br>
                <label for="">Date Mort : </label>
                <input type="date" name="dateMort" required>
                <br>
                <label for=""></label>
                <label for="">Poids : </label>
                <input type="number" name="poids" min="0" required>
                <button type="submit" >Ajouter</button>
            </form>
        </div>
    </div>
    <div class="section2">
        <?php foreach($animaux as $animal) { ?>
            <div class="item">
                <div class="info">
                    <h3><i class="fa-classic fa-solid fa-id-badge fa-fw"></i> ID : <?php echo $animal["animal_id"] ?></h3>
                    <h3><i class="fa-classic fa-solid fa-circle-info fa-fw"></i> Espece : <?php echo $animal["espece_nom"] ?></h3>
                    <h3><i class="fa-classic fa-solid fa-gauge fa-fw"></i> Poids : <?php echo $animal["poidsInitial"] ?></h3>
                    <h3><i class="fa-classic fa-solid fa-dollar-sign fa-fw"></i> Prix de vente par kg : <?php echo $animal["prixVenteKg"]*$animal["poidsInitial"] ?></h3>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
