<table border="1">
    <tr>
        <th>Nom</th>
        <th>Poids Maximum</th>
        <th>Poids Minimum de Vente</th>
        <th>NbJour Faim pour Mourir</th>
        <th>Prix de Vente par Kg</th>
        <th>Perte de Poids par Jour</th>
        <th>Image</th>
    </tr>
    <?php foreach($especes as $espece) { ?>
        <tr>
            <td><?php echo $espece["nom"] ?></td>
            <td><?php echo $espece["poidsMax"] ?></td>
            <td><?php echo $espece["poidsMinVente"] ?></td>
            <td><?php echo $espece["nbJourFaim"] ?></td>
            <td><?php echo $espece["prixVenteKg"] ?></td>
            <td><?php echo $espece["pertePoidsJour"] ?></td>
            <td><?php echo $espece["image"] ?></td>
        </tr>
    <?php } ?>
</table>