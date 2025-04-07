<div class="container-inset">
    <div class="item-display mb-2">
        <!-- <div class=""> -->
        <img class="item-img" src=<?= "public/images/" . $item['imageLink'] ?> alt="">
        <!-- </div> -->
        <div class="ms-2">
            <a href="index.php?page=product&category=<?= urlencode($item['catName']) ?>-<?= $item['catID'] ?>"><?= $item['catName'] ?></a>
            <h1><?= $item['title'] ?></h1>
            <?php if ($item['discount'] > 0): ?>
                <span class="flex">
                    <h2 class="old-text me-1">$<?= $item['price'] ?></h2>
                    <h2 class="new-text">$<?= round($item['price'] * (1 - $item['discount']), 2) ?></h2>
                </span>
            <?php else: ?>
                <h2>$<?= $item['price'] ?></h2>
            <?php endif; ?>
            <p><?= $item["productDesc"] ?></p>
            <label for="item-amount">Amount:</label>
            <input name="item-amount" id="item-amount" type="number" min="1" max=<?= $item['inStock'] ?> value="1">
            <button id="add-cart-btn" value=<?= $item['id'] ?>>Add to cart</button>
        </div>
    </div>
    <div id="similar-display" class="container mt-2">
        <h2>Similar items</h2>
        <div class="flex">
            <?php foreach ($similar_items as $sim): ?>
                <div class="card container align-flex-start space-between">
                    <div class="img-card">
                        <img src=<?= "public/images/" . $sim["imageLink"] ?> alt="">
                        <h3 class="mt-2"><?= $sim['title'] ?></h3>
                    </div>
                    <span>$<?= $sim['price'] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    document.querySelector("#add-cart-btn").addEventListener('click', (e) => {
        e.preventDefault();
        let item_id = document.querySelector("#add-cart-btn").value;
        let amount = document.querySelector("#item-amount").value;

        let url = `api.php?page=cart&item=${item_id}&amount=${amount}`;
        fetch(url)
            .then(response => response.json())
            .then(res => {
                if (res["status"] == "success") {
                    alert(`Add item to cart!`);
                } else {
                    alert(`Please login to add item to cart`);
                }
            })
            .catch(err => {
                console.log(err);
            })
    })
</script>