<?php
$min_price = 0;
$max_price = ceil($prices['max_price']);
?>
<div id="filter">
    <div id="filter-search" class="mb-2">
        <i class='c-iris bx bx-search bx-rotate-90 me-2'></i>
        <input type="text" placeholder="search an item..." value=<?= $title ?>>
    </div>
    <div id="filter-categories" class="mt-2">
        <h2>Categories</h2>
        <div class="container">
            <div class="flex mb-2">
                <button id="select-all" class="btn-transparent me-2">Select all</button>
                <button id="remove-all" class="btn-transparent">Remove all</button>
            </div>
            <div id="categories-list">
                <?php foreach ($categories as $cat): ?>
                    <button
                        class=<?= in_array($cat['catID'], $filter_cat) ? "btn-active" : "" ?>
                        value=<?= $cat['catID'] ?>>
                        <?= $cat['catName'] ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div id="filter-price-range" class="mt-2">
        <div class="flex space-between" id="price-display">
            <h2>Price</h2>
            <div>
                <button class="btn-transparent" id="min-price-display"></button>
                <i class='bx bx-arrow-back bx-rotate-180'></i>
                <button class="btn-transparent" id="max-price-display"></button>
            </div>
        </div>
        <div class="slider-wrapper">
            <div class="slider-track"></div>
            <div class="slider-runnable-track"></div>
            <input class="slider-min" id="price-min" step=0.01 type="range" min="0" max=<?= $max_price ?> value="0">
            <input class="slider-max" id="price-max" step=0.01 type="range" min="0" max=<?= $max_price ?> value=<?= $max_price ?>>
        </div>
    </div>
</div>

<script>

    const sliderMin = document.getElementById('price-min');
    const sliderMax = document.getElementById('price-max');
    const minDisplay = document.getElementById('min-price-display');
    const maxDisplay = document.getElementById('max-price-display');
    const sliderTrack = document.querySelector('.slider-track');
    const sliderRunnableTrack = document.querySelector('.slider-runnable-track')
    // Initialize displayed values on page load
    minDisplay.textContent = '$' + sliderMin.value;
    maxDisplay.textContent = '$' + sliderMax.value;

    // Ensure min value can't go above max and vice versa
    sliderMin.addEventListener('input', () => {
        if (parseInt(sliderMin.value) > parseInt(sliderMax.value)) {
            sliderMin.value = sliderMax.value;
        }
        updateSlider();
    });

    sliderMax.addEventListener('input', () => {
        if (parseInt(sliderMax.value) < parseInt(sliderMin.value)) {
            sliderMax.value = sliderMin.value;
        }
        updateSlider();
    });

    function updateSlider() {
        const min = parseInt(sliderMin.value);
        const max = parseInt(sliderMax.value);
        const rangeMin = parseInt(sliderMin.min);
        const rangeMax = parseInt(sliderMax.max);

        const leftPercent = ((min - rangeMin) / (rangeMax - rangeMin)) * 100;
        const rightPercent = ((max - rangeMin) / (rangeMax - rangeMin)) * 100;

        // Update the runnable track
        sliderRunnableTrack.style.left = leftPercent + '%';
        sliderRunnableTrack.style.width = (rightPercent - leftPercent) + '%';

        // Update the display
        minDisplay.textContent = '$' + min;
        maxDisplay.textContent = '$' + max;
    }
</script>