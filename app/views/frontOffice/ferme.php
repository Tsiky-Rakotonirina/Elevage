<h2>Filtre</h2>
<form action="/fermeFiltre" method="get">
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
            <option value="1">Boeuf</option>
            <option value="2">Cochon</option>
            <option value="3">Coq</option>
        </select>
    </p>
</form>

<h1>Situation de vos animaux</h1>
<?php for($i=0;$i<4;$i++){ ?>
<p>Id : 1</p>
<img src="/S3/Elevage/public/assets/images/boeuf1.jpg" alt="">
<p>Poids : 30 kg</p>
<p>Vivant</p>
<p>Prix de vente : 100000 ariary</p>
<p>Voir info sur l'espece : </p>
<ul>
    <li>Espece :  boeuf</li>
    <li>Poids Maximal :  50kg </li>
    <li>Poids Minimal de Vente :  boeuf</li>
    <li>Nombre de jour de faim pour mourir :  5 jours</li>
    <li>Prix Vente en Kg :  10000 ariary</li>
    <li>Perte de Poids par Jour : 5%</li>
</ul>
<?php } ?>
