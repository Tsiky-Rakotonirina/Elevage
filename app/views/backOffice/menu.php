<link rel="stylesheet" href="<?= $url ?>/public/assets/css/menu.css">
<link rel="stylesheet" href="<?= $url ?>/public/assets/bootstrap5/css/bootstrap.min.css">

<div class="container-carousel">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php foreach ($caroussel as $index => $image): ?>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?= $index ?>" 
                        class="<?= $index === 0 ? 'active' : '' ?>" 
                        aria-current="<?= $index === 0 ? 'true' : 'false' ?>" 
                        aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
        <div class="carousel-inner">
            <?php foreach ($caroussel as $index => $image): ?>
                <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" data-bs-interval="10000">
                    <img id='car' src="<?php echo $url . $image['image'] ?>" class="d-block w-100" alt="Slide <?= $index + 1 ?>">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

