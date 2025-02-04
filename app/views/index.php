<?php
    $url=Flight::get('flight.base_url');
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
    <link rel="icon" type="image/x-icon" href="<?=$url ?>/public/assets/css/image/logo2.jpg" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$url ?>/public/assets/css/login.css">
</head>
<body>
    <header>
        
    </header>
    <main>
    <div class="container-form">
            <div class="container-div">
                <div class="logo">
                    <img src="<?=$url ?>/public/assets/css/image/logo2.png" alt="">
                </div>
                <h1>Connexion <span style="color:#FF5A5F; font-weight:bold;">Eleveur</span></h1>
                <form action="connexionEleveur" method="post">
                    <label for="">Nom :</label>
                    <input type="text" placeholder="Entrez votre nom" name="nom" value="Pierre" required >
                    <label for="">Mot de passe :</label>
                    <input type="password" placeholder="Entrez votre mot de passe" name="motDePasse" value="Pierre" required >
                    <button type="submit">Se connecter</button>
                </form>
                    <?php if(isset($error)) { ?>
                        <div class="error">
                            <?php echo $error ?>
                        </div>
                    <?php } ?>
            </div>
            <div class="container-admin">
                <div class="logo">
                    <img style="width:125px;margin-top:5vh" src="<?=$url ?>/public/assets/css/image/admin.png" alt="">
                </div><br>
                <h1>Connexion <span style="color:#FF5A5F; font-weight:bold;">Admin</span></h1>
                <form action="connexionAdmin"  method="post">
                    <label for="">Nom :</label>
                    <input type="text" placeholder="Entrez votre nom" name="nom" value="Ezechiel" required >
                    <label for="">Mot de passe :</label>
                    <input type="password" placeholder="Entrez votre mot de passe" name="motDePasse" value="Ezechiel" required >
                    <button type="submit">Je suis Admin</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        
    </footer>
</body>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
</html>