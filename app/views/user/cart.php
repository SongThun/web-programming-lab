<?php include "app/utils.php" ?>

<div id="cart-page" class="container container-inset">
    <div id="cart-display" class="grid-2 mb-2">
        <?php foreach ($items as $item): ?>
            <a id=<?= "cart-" . $item['id'] ?>
                href="<?= PRODUCT_URL . slugify($item["title"])?>-<?=$item["id"] ?>"
                class="cart-item flex">
                <img src="<?=IMAGE_PATH?><?=$item['imageLink'] ?>" alt="">
                <div class="flex">
                    <div class="cart-info">
                        <h2><?= $item['title'] ?></h2>
                        <!-- <span>$<?= $item['price'] ?></span> -->
                         <?php getDiscount($item) ?>
                    </div>
                    <div class="container align-right div-sm space-between">
                        <button  data-id=<?= $item['id'] ?> class="delete-btn btn-transparent" style="font-size: 3ex;"><i  data-id=<?= $item['id']?> class='bx bx-trash'></i></button>
                        <div class="container right align-right">
                            <span>Amount: <?= $item['amount'] ?></span>
                            <h3 class="item-total">$<?= $item['total'] ?></h3>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <?php if ($items != null and count($items) > 0): ?>
        <h2 class="mb-2">Total:
            <span id="checkout-total">$<?= array_sum(array_column($items, "total")) ?></span>
        </h2>
        <button id="checkout-btn">Check out</button>
    <?php else: ?>
        <div class="empty" style="background-image: url('<?= IMAGE_PATH ?>empty.jpg');">No items in cart yet. Enjoy your shopping</div>
    <?php endif; ?>
</div>

<script type="module">
    import {slugify} from "<?= SCRIPT_PATH ?>config.js"
    const btn = document.querySelector('#checkout-btn');
    if (btn) {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const result = await Swal.fire({
                text: `Are you sure you want to checkout?`,
                icon: 'question',
                showConfirmButton: true
            })
            if (result.isConfirmed) {
                try {
                    const response = await fetch(`${window.API}cart/checkout`)
                    const res = await response.json();
                    if (res['status'] == 'success') {
                        const _ = await Swal.fire({
                            toast: true,
                            position: 'top',
                            text: "Successfully checkout! \n Continue shopping!",
                            icon: 'success',
                            showConfirmButton: false,
                            timerProgressBar: true,
                            timer: 1200
                        })
                        window.location.href = window.BASE_URL;
                    }
                } catch (err) {
                    console.log(err);
                }
            }
        })
    }
    // import {slugify} from "public/js/config.js"

    async function updateCart(e) {
        e.preventDefault();
        e.stopPropagation();
        const url = `${window.API}cart/${e.target.dataset.id}`;
        const cartDisplay = document.querySelector('#cart-display');
        const cartPage = document.querySelector('#cart-page');
        try {
            const response = await fetch(url, {
                method: 'DELETE'
            });
            const result = await response.json();
            if (result['status'] === 'success') {
                let html = "";
                if (result["data"].length > 0) {
                    result["data"].forEach((item) => {
                        html += `<a id="cart-${item.id}" 
                                        href="<?= PRODUCT_URL ?>${slugify(item.title)}-${item.id}"
                                        class = "cart-item flex" >
                            <img src="<?= IMAGE_PATH ?>${item.imageLink}" alt = "" >
                                <div class = "flex" >
                                <div class = "cart-info" >
                                    <h2>${item.title}</h2> 
                                    <span> $${item.price}</span>
                                </div> 
                                <div class = "container align-right div-sm space-between" >
                                <button data-id=${item.id} class = "delete-btn btn-transparent"
                                    style = "font-size: 3ex;" > 
                                    <i  data-id=${item.id} class = 'bx bx-trash'> </i>
                                </button>
                                <div class = "container right align-right" >
                                <span> Amount: ${item.amount} </span> 
                                <h3 class = "item-total" > $${item.total}</h3> 
                                </div> 
                                </div> 
                                </div> 
                                </a>`
                    })
                    cartDisplay.innerHTML = html;
                } else {
                    <?php $img = IMAGE_PATH . "empty.jpg" ?>
                    cartPage.innerHTML = `<div class="empty" style="background-image: url('<?= $img ?>');">
                        No items in cart yet. Enjoy your shopping
                        </div>`;
                }
                attachDeleteHandle();
            }
        } catch (err) {
            console.log(err);
        }

    }

    function attachDeleteHandle() {
        document.querySelectorAll(".delete-btn").forEach((ele) => {
            ele.addEventListener("click", updateCart)
            ele.querySelector("i").addEventListener("click", updateCart)
        })
    }
    attachDeleteHandle();
</script>