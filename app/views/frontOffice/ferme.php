<h2>Filtre</h2>
<form action="fermeFiltre" method="get">
    <p>Par poids <input type="number" name="poidsMin" placeholder="Poids min" min="0">
    <input type="number" name="poidsMax" placeholder="Poids max" min="0"></p>
    <p>Par prix <input type="number" name="prixMin" placeholder="Prix min" min="0">
    <input type="number" name="prixMax" placeholder="Prix max" min="0"></p>
    <p>
        Par etat : <select name="etat" id="">
            <option value="">Tous</option>
            <option value="true">Vivant</option>
            <option value="false">Decede</option>
        </select>
    </p>
    <p>Par espece : 
        <select name="espece" id="">
            <option value="">Tous les especes</option>
            <?php foreach($especes as $espece){ ?>
                <option value="<?php echo $espece["id"] ?>"><?php echo $espece["nom"] ?></option>
            <?php }?>
        </select>
    </p>
    <p><input type="hidden" name="date" value=<?php echo $date ?> ></p>
    <input type="submit" value="Filtrer">
</form>

<h1>Situation de vos animaux</h1>
<?php foreach($animaux as $animal){ ?>
<p>Id : <?php echo $animal["animal_id"] ?></p>
<img src="<?php echo $url.$animal["image"] ?>" alt="">
<p>Poids : <?php echo $animal["poids"] ?> kg</p>
<?php if($animal["etat"]==true) {
    echo 'Vivant';
} else {
    echo 'Mort';
} ?>
<p>Prix de vente : <?php echo $animal["prixDeVente"] ?> ariary</p>
<p>Voir info sur l'espece : </p>
<ul>
    <li>Espece :  <?php echo $animal["espece_nom"] ?></li>
    <li>Poids Maximal :  <?php echo $animal["poidsMax"] ?> kg </li>
    <li>Poids Minimal de Vente :  <?php echo $animal["poidsMinVente"] ?> </li>
    <li>Nombre de jour de faim pour mourir :  <?php echo $animal["nbJourFaim"] ?> jours</li>
    <li>Prix Vente en Kg :  <?php echo $animal["prixVenteKg"] ?> ariary</li>
    <li>Perte de Poids par Jour : <?php echo $animal["pertePoidsJour"] ?>%</li>
</ul>
<?php } ?>
