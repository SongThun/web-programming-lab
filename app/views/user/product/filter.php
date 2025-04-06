<?php
    $min_price = $prices['min_price'];
    $max_price = $prices['max_price'];
?>
<div>
    <div id="filter-search">
        <input type="text" placeholder="search an item..." value=<?= $title?>>
    </div>
    <div id="filter-categories">
        <h2>Categories</h2>
        <div>
            <?php foreach ($categories as $cat):?>
                <button class="btn-active" value=<?= $cat['catID'] ?>><?= $cat['catName'] ?></button>
            <?php endforeach; ?>
        </div>
    </div>
    <div id="filter-price-range">
        min: <input id="price-min" type="number" min=<?= $min_price?> max=<?= $max_price?> value=<?= $min_price?>>
        max: <input id="price-max" type="number" min=<?= $min_price?> max=<?= $max_price?> value=<?= $max_price?>>
    </div>
</div>
