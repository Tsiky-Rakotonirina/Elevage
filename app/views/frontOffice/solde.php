<link rel="stylesheet" href="<?=$url ?>/public/assets/css/solde.css">
<link rel="stylesheet" href="<?=$url ?>/public/assets/bootstrap5/css/bootstrap.min.css">

<div class="contains">
    <div class="solde">
        <?php echo $solde; ?> Ariary
    </div>
    <div class="formulaires">
        <div class="depot">
            <form action="depot" method="post">
                <div class="title">
                    <img src="<?=$url?>/public/assets/css/image/monney.png" alt="">
                    <h3 style="color:green">Depot</h3>
                </div>
                <div class="container-input">
                    <label for="">Montant : </label>
                    <input type="number" min="0" name="montant" required> 
                </div>
                <button type="submit" >Deposer</button>
            </form>
        </div>
        <div class="achat">
            <form action="achatAlimentation" method="post">
                <div class="title">
                    <img src="<?php echo $url?>/public/assets/css/image/achat.png" alt="">
                    <h3 style="color:brown">Achat d'aliment</h3>
                </div>
                <div class="container-input">
                    <label for="">Nombre de portions : </label>
                    <input type="number" min="0" name="nbPortion" required>
                    <label for="">Alimentation : </label>
                    <select name="idAlimentation" id="">
                        <?php foreach($alimentations as $alimentation) { ?>
                            <option value="<?php echo $alimentation["id"]; ?>"><?php echo $alimentation["nom"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" >Acheter</button>
            </form>
        </div>
    </div>
    <h3 style="text-align: center; font-weight:500;margin-top:5vh; margin-bottom:5vh">Vos dix derniers mouvements : </h3>
    <div class="tableau">
        <table class="table table-light table-hover">
            <tr>
                <th><i class="fa-classic fa-solid fa-calendar-days fa-fw"></i> Date</th>
                <th><i class="fa-classic fa-solid fa-paperclip fa-fw"></i> Rubrique</th>
                <th><i class="fa-classic fa-solid fa-money-bill fa-fw"></i> Montant</th>
            </tr>     
            <?php foreach($mouvements as $mouvement) { ?>
                <tr>
                    <td><?php echo $mouvement["date"]; ?></td>
                    <td><?php echo $mouvement["nom"]; ?></td>
                    <td><?php echo $mouvement["montant"]*$mouvement["effet"] ; ?></td>
                </tr>
            <?php } ?> 
        </table>
    </div>
</div><br><br><br>