<h3>Solde actuel : <?php echo $solde; ?></h3>

<h3>Faire un depot pour augmenter votre solde</h3>
<form action="depot" method="post">
    <label for="">Montant : </label>
    <input type="number" min="0" name="montant" required> ar
    <input type="submit" value="Deposer ">
</form>

<h3>Achter des aliments : </h3>
<form action="achatAlimentation" method="post">
    <label for="">Nombre de portions : </label>
    <input type="number" min="0" name="nbPortion" required>
    <label for="">Alimentation</label>
    <select name="idAlimentation" id="">
        <?php foreach($alimentations as $alimentation) { ?>
            <option value="<?php echo $alimentation["id"]; ?>"><?php echo $alimentation["nom"]; ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Acheter">
</form>
<?php if(isset($succes)) {
    echo $succes;
} ?>

<?php if(isset($erreur)) {
    echo $erreur;
} ?>

<h3>Vos dix derniers mouvements : </h3>
<table border="1">
    <tr>
        <th>Date</th>
        <th>Rubrique</th>
        <th>Montant</th>
    </tr>
    <?php foreach($mouvements as $mouvement) { ?>
    <tr>
        <td><?php echo $mouvement["date"]; ?></td>
        <td><?php echo $mouvement["nom"]; ?></td>
        <td><?php echo $mouvement["montant"]*$mouvement["effet"] ; ?></td>
    </tr>
    <?php } ?>
</table>