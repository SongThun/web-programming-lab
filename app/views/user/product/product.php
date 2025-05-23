<div class="grid-1-4 container-inset">
    <?php require __DIR__ . "/filter.php"; ?>
    <div class="container">
        <?php require __DIR__ . "/sort.php"; ?>
        <div id="product-display">
            <?php if ($products != null && count($products) > 0): ?>
                <?php foreach ($products as $prod): ?>
                    <a class="card container" href="<?= PRODUCT_URL . slugify($prod["title"]) . "-" . htmlspecialchars($prod["id"]) ?>">
                        <div class="img-div" style="background-image: url('<?= IMAGE_PATH . htmlspecialchars($prod["imageLink"]) ?>')">
                            <div class="flex space-between">
                                <button class="tag tag-left"><?= htmlspecialchars($prod["catName"]) ?></button>
                                <button class="tag tag-right flex"><?= htmlspecialchars($prod['salesAmount']) ?><i class='bx bxs-heart'></i></button>
                            </div>
                        </div>
                        <div class="img-info">
                            <span class="flex-column space-between">
                                <h1><?= htmlspecialchars($prod["title"]) ?></h1>
                                <!-- <span>$<?= htmlspecialchars($prod["price"]) ?></span> -->
                                <?php getDiscount($prod) ?>
                            </span>
                            <button
                                class="add-cart-btn"
                                data-id="<?= htmlspecialchars($prod['id']) ?>"
                                data-title="<?= htmlspecialchars($prod['title'], ENT_QUOTES) ?>">
                                <i class='bx bx-cart-add'></i>
                            </button>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty" style="background-image: url('<?= IMAGE_PATH ?>empty.jpg');">No item available</div>
            <?php endif; ?>
        </div>
        <?php require __DIR__ . "/pagination.php"; ?>
    </div>
</div>


<script type="module" src="<?= e(SCRIPT_PATH . "load_products.js") ?>"></script>
<!-- Add to Cart Handler -->
<script>
    async function addItem(id, title, e) {
        e.preventDefault(); // prevent <a> tag navigation
        e.stopImmediatePropagation(); // stop event bubbling
        const response = await fetch(`${window.API}cart/${id}?amount=1`);
        const res = await response.json();
        if (res["status"] === "success") {
            Swal.fire({
                toast: true,
                position: 'top-end',
                text: `${title} added to cart!`,
                icon: 'success',
                showConfirmButton: false,
                timer: 1200,
                timerProgressBar: true
            })
            // alert(`${title} added to cart!`);
        } else {
            alert(`Please login to add to cart`);
        }
    }

    function bindAddToCart() {
        const buttons = document.querySelectorAll(".add-cart-btn");
        buttons.forEach(btn => {
            btn.onclick = (e) => {
                const id = btn.dataset.id;
                const title = btn.dataset.title;
                addItem(id, title, e);
            };
        });
    }

    bindAddToCart(); // initial call for PHP-rendered products
</script>