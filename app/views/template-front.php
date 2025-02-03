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
    <link rel="stylesheet" href="<?=$url ?>/public/assets/css/templateFront.css">
</head>
<body>
    <header>
        <nav class="menu">
            
        </nav>
    </header>
    <main>
        <?php include("frontOffice/".$page.".php") ?>    
    </main>
    <footer>

    </footer>
</body>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->

</html>