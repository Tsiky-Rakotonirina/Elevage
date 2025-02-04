<link rel="stylesheet" href="<?= $url ?>/public/assets/css/espece.css">
<link rel="stylesheet" href="<?= $url ?>/public/assets/bootstrap5/css/bootstrap.min.css">

<div class="container-table">
    <form action="" method="post">
        <table class="table">
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
                    <td>
                        <input type="text" name="nom" value="<?php echo $espece["nom"] ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="poidsMax" value="<?php echo $espece["poidsMax"] ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="poidsMinVente" value="<?php echo $espece["poidsMinVente"] ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="nbJourFaim" value="<?php echo $espece["nbJourFaim"] ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="prixVenteKg" value="<?php echo $espece["prixVenteKg"] ?>" class="form-control">
                    </td>
                    <td>
                        <input type="text" name="pertePoidsJour" value="<?php echo $espece["pertePoidsJour"] ?>" class="form-control">
                    </td>
                    <td><?php echo $espece["image"] ?></td>
                </tr>
            <?php } ?>
        </table>
        <div class="container-button">
            <button type="submit">Sauvegarder les changements</button>
        </div>
    </form>
</div>
