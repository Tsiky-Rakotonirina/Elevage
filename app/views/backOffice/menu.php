<link rel="stylesheet" href="<?= $url ?>/public/assets/css/menu.css">
<link rel="stylesheet" href="<?= $url ?>/public/assets/bootstrap5/css/bootstrap.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const prevButton = document.querySelector('.carousel-control-prev');
    const nextButton = document.querySelector('.carousel-control-next');
    const items = document.querySelectorAll('.carousel-item');

    let currentIndex = 0;

    function showItem(index) {
        items[currentIndex].classList.remove('active');
        currentIndex = (index + items.length) % items.length;
        items[currentIndex].classList.add('active');
    }

    prevButton.addEventListener('click', function() {
        showItem(currentIndex - 1);
    });

    nextButton.addEventListener('click', function() {
        showItem(currentIndex + 1);
    });
});
</script>

<div id="menuCaroussel" class="carousel">
    <button class="carousel-control-prev" aria-label="Précédent">
        &#10094;
    </button>
    <div class="carousel-inner">
        <?php foreach ($caroussel as $index => $image): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <img src="<?php echo $url . $image['image']; ?>" alt="Image <?php echo $index + 1; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-next" aria-label="Suivant">
        &#10095;
    </button>
</div>
