<div class="grid-1-3 container-inset">
    <?php require __DIR__ . "/filter.php"; ?>
    <div class="container">
        <?php require __DIR__ . "/sort.php" ?>
        <div id="product-display">
            <?php foreach ($products as $prod): ?>
                <a class="card container space-between" href=<?= "?page=product&item=" . urlencode(strtolower($prod["title"])) . "-" . $prod["id"]; ?>>
                    <div>
                        <div class="img-div" style="background-image: url('public/images/<?= $prod["imageLink"] ?>')">
                            <div class="flex space-between">
                                <button class="tag tag-left"><?= $prod["catName"] ?></button>
                                <button class="tag tag-right flex"><?= $prod['salesAmount'] ?><i class='bx bxs-heart                '></i></button>
                            </div>
                        </div>
                        <h1 class="center p-1 mt-2"><?= $prod["title"] ?></h1>
                    </div>
                    <h2 class="mb-2">$<?= $prod["price"] ?></h2>
                </a>
            <?php endforeach; ?>
        </div>
        <?php require __DIR__ . "/pagination.php" ?>
    </div>
</div>

<script src="public/js/load_products.js"></script>