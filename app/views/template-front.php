<?php
$url = Flight::get('flight.base_url');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Elevage</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= $url ?>/public/assets/css/image/logo2.jpg" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $url ?>/public/assets/css/templateFront.css">
</head>

<body>
    <header>
        <nav class="menu">
            <div class="container-menu">
                <div class="left">
                    <a href="tableauDeBord">
                        Tableau de Bord
                    </a>
                    <a href="listeAnimalEnVente">
                        Achat - Vente
                    </a>
                </div>
                <div class="logo">
                    <img src="<?php echo $url ?>/public/assets/css/image/logo2.jpg" alt="">
                </div>
                <div class="right">
                    <a href="solde">
                        Solde
                    </a>
                    <a href="nourirView">
                        Alimenter les animaux
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php include("frontOffice/" . $page . ".php") ?>
    </main>
    <footer>

    </footer>
</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->

</html>