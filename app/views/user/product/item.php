<div class="container-inset">
    <div class="item-display mb-2">
        <!-- <div class=""> -->
        <img class="item-img" src=<?= e(IMAGE_PATH . $item['imageLink']) ?> alt="">
        <!-- </div> -->
        <div class="ms-2">
            <a href="<?= e(PRODUCT_URL . "category/" . slugify($item['catName']) . "-" . $item['catID']) ?>">
                <?= e($item['catName']) ?>
            </a>
            <h1><?= e($item['title']) ?></h1>
            <?php if ($item['discount'] > 0): ?>
                <span class="flex">
                    <h2 class="old-text me-1">$<?= $item['price'] ?></h2>
                    <h2 class="new-text">$<?= round($item['price'] * (1 - $item['discount']), 2) ?></h2>
                </span>
            <?php else: ?>
                <h2>$<?= $item['price'] ?></h2>
            <?php endif; ?>
            <!-- <?php getDiscount($item) ?> -->
            <p><?= e($item["productDesc"]) ?></p>
            <div class="flex align-center">
                <label class="me-1" for="item-amount">Amount:</label>
                <input class="me-1" name="item-amount" id="item-amount" type="number" min="1" max=<?= $item['inStock'] ?> value="1">
                <button id="add-cart-btn" value=<?= $item['id'] ?>>Add to cart</button>
            </div>
        </div>
    </div>
    <div id="similar-display" class="container mt-2">
        <h2>Similar items</h2>
        <div class="flex">
            <?php foreach ($similar_items as $sim): ?>
                <a 
                href="<?= e(PRODUCT_URL . slugify($sim["title"]) . "-" . $sim["id"]) ?>" 
                class="card container align-flex-start space-between">
                    <div class="img-card">
                        <img src=<?= e(IMAGE_PATH . $sim["imageLink"]) ?> alt="">
                        <h3 class="mt-2"><?= e($sim['title']) ?></h3>
                    </div>
                    <!-- <span>$<?= $sim['price'] ?></span> -->
                     <?php getDiscount($sim) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<script>
    document.querySelector("#add-cart-btn").addEventListener('click', (e) => {
        e.preventDefault();
        // let item_id = document.querySelector("#add-cart-btn").value;
        let amount = document.querySelector("#item-amount").value;

        let url = `${window.API}cart/${<?=$item['id']?>}?amount=${amount}`;
        fetch(url)
            .then(response => response.json())
            .then(res => {
                if (res["status"] == "success") {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        text: `<?=$item['title']?> added to cart!`,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1200,
                        timerProgressBar: true
                    })
                } else {
                    Swal.fire({
                        position: 'top',
                        title: 'Login required',
                        html: `Please <a href="${window.BASE_URL}/login/">Login</a> to add item to cart`,
                        icon: 'error',
                        height: '1rem',
                        showConfirmButton: false,
                        timer: 2400,
                        timerProgressBar: true
                    })
                }
            })
            .catch(err => {
                console.log(err);
            })
    })
</script>