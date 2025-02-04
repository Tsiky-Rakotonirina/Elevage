<link rel="stylesheet" href="<?= $url ?>/public/assets/css/ferme.css">

<div class="contain">
    <div class="filtre">
        <div class="title">
            <h2>F I L T R E</h2>
        </div>
        <div class="container-input">
            <form action="fermeFiltre" method="get">
                <label for="">Poids : </label>
                <input type="number" name="poidsMin" placeholder="Poids min" min="0"><br><br>
                <label for="">Prix : </label>
                <div class="prix">
                    <input type="number" name="prixMin" placeholder="Prix min" min="0">
                    <input type="number" name="prixMax" placeholder="Prix max" min="0"></p>
                </div><br>
                <label for="">Etat : </label>
                <select name="etat" class="custom-select" id="">
                    <option value="">Tous</option>
                    <option value="true">Vivant</option>
                    <option value="false">Mort</option>
                </select><br><br>
                <label for="">Espece : </label>
                <select name="espece" id="">
                    <option value="">Tous les especes</option>
                    <?php foreach ($especes as $espece) { ?>
                        <option value="<?php echo $espece["id"] ?>"><?php echo $espece["nom"] ?></option>
                    <?php } ?>
                </select><br><br>
                <input type="hidden" name="date" value=<?php echo $date ?>>
                <button type="submit">Filtrer</button>
            </form>
        </div>
    </div>
    <div class="liste">
        <?php foreach ($animaux as $animal) { ?>
            <div class="item">
                <div class="pics">
                    <img src="<?php echo $url . $animal["image"] ?>" alt="">
                </div>
                <div class="infos">
                    <h3><span>Id :</span> <?php echo $animal["animal_id"] ?></h3>
                    <h3><span></span>Poids :</span> <?php echo $animal["poids"] ?> kg</h3>
                    <h3><span>Prix de vente :</span> <?php echo $animal["prixDeVente"] ?> ariary</h3>
                    <br>
                    <h3 id="lien-espece"><i class="fa-classic fa-solid fa-circle-info fa-fw"></i> Info sur l'espece</h3>
                </div>
                <div class="etat">
                    <div class="message">
                        <?php if ($animal["etat"] == true) { ?>
                            <h2 style="color:green;">V I V A N T</h2>
                        <?php } else { ?>
                            <h3 style="color:black">M O R T</h3>
                        <?php } ?>
                    </div>
                    <div class="bt">
                        <form action="" method="get">
                            <button type="submit">Blabla</button>
                        </form>
                    </div>
                </div>
                <div class="espece">
                    <img src="<?php echo $url ?>/public/assets/css/image/logo2.jpg" alt="">
                </div>
                <div class="espece-info">
                    <h3><?php echo $animal["espece_nom"] ?></h3>
                    <h4>Poids Maximal : <?php echo $animal["poidsMax"] ?> kg </h4>
                    <h4>Poids Minimal de Vente : <?php echo $animal["poidsMinVente"] ?> </h4>
                    <h4>Nombre de jour de faim pour mourir : <?php echo $animal["nbJourFaim"] ?> jours</h4>
                    <h4>Prix Vente en Kg : <?php echo $animal["prixVenteKg"] ?> ariary</h4>
                    <h4>Perte de Poids par Jour : <?php echo $animal["pertePoidsJour"] ?>%</h4>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const infoLinks = document.querySelectorAll("#lien-espece");

        infoLinks.forEach(link => {
            const especeInfo = link.closest(".item").querySelector(".espece-info");

            link.addEventListener("mouseenter", function() {
                especeInfo.style.display = "block";
            });

            link.addEventListener("mouseleave", function() {
                especeInfo.style.display = "none";
            });
        });
    });
</script>