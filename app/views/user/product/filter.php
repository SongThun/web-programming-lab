<?php
    $prices = array_column($products, "price");
    $min_price = min($prices);
    $max_price = max($prices);
?>
<div>
    <div id="filter-search">
        <input type="text" placeholder="search an item...">
    </div>
    <div id="filter-categories">
        <h2>Categories</h2>
        <div>
            <?php foreach ($categories as $cat):?>
                <button class="btn-active" value=<?= $cat['catName'] ?>><?= $cat['catName'] ?></button>
            <?php endforeach; ?>
        </div>
    </div>
    <div id="filter-price-range">
        min: <input id="price-min" type="number" min=<?= $min_price?> max=<?= $max_price?> value=<?= $min_price?>>
        max: <input id="price-max" type="number" min=<?= $min_price?> max=<?= $max_price?> value=<?= $max_price?>>
    </div>
</div>
