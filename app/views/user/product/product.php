<div>
    <?php require __DIR__ . "/filter.php"; ?>
    <div>
        <?php require __DIR__ . "/sort.php"?>
        <div id="product-display">
            <?php foreach ($products as $prod): ?>
                <a href=<?= "?page=product&item=" . urlencode(strtolower($prod["title"])) . "-" . $prod["id"]; ?>>
                    <img src=<?="public/images/" . $prod["imageLink"]?> alt=<?= $prod["title"]?>>
                    <span><?= $prod["catName"] ?></span>
                    <h1><?= $prod["title"]?></h1>
                    <div>
                        <span><?= $prod["price"]?></span>
                        <span><?= $prod["salesAmount"]?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php require __DIR__ . "/pagination.php" ?>
    </div>
</div>

<script src="public/js/load_products.js"></script>