<style>
#menuCaroussel {
    width: 100%;
    margin: auto;
    display: flex;
    justify-content: center;
}

.carousel-item {
    display: none; /* Add this line */
}

.carousel-item.active {
    display: block; /* Add this line */
}

.carousel-item img {
    max-height: 700px; /* Increase this line */
    object-fit: cover;
    width: 50%; /* Increase this line */
    height: auto;
    margin: auto;
}

.carousel-caption {
    background-color: rgba(0, 0, 0, 0.5);
    padding: 20px; /* Increase this line */
    border-radius: 5px;
    color: white;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    padding: 20px; /* Increase this line */
    color: white;
}

.carousel-control-prev,
.carousel-control-next {
    color: white; /* Add this line */
    font-size: 1.5em; /* Add this line */
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.6); /* Add this line */
}

.carousel-control-prev-icon::before,
.carousel-control-next-icon::before {
    content: ''; /* Remove this line */
}
</style>

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

<div id="menuCaroussel" class="carousel slide" data-ride="carousel">
    <a class="carousel-control-prev" href="#menuCaroussel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true">&lt;</span> <!-- Change this line -->
    </a>
    <div class="carousel-inner">
        <?php foreach ($caroussel as $index => $image): ?> <!-- Add $index variable -->
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>"> <!-- Use $index variable -->
                <img src="<?php echo $url.$image['image']; ?>" class="d-block" alt="">
            </div>
        <?php endforeach; ?>
    </div>
    <a class="carousel-control-next" href="#menuCaroussel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true">&gt;</span> <!-- Change this line -->
    </a>
</div>
