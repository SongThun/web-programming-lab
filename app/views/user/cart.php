<div class="container container-inset">
    <div class="grid-2 mb-2">
        <?php foreach ($items as $item):?>
            <div class="cart-item flex">
                <img src=<?= "public/images/" . $item['imageLink'] ?> alt="">
                <div class="flex">
                    <div class="cart-info">
                        <h2><?= $item['title']?></h2>
                        <span>$<?= $item['price']?></span>
                    </div>
                    <div class="container right div-sm">
                        <span>Amount: <?= $item['amount'] ?></span>
                        <h3>$<?= $item['total'] ?></h3>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if ($items != null and count($items) > 0):?>
        <h2 class="mb-2">Total: $<?= array_sum(array_column($items, "total")) ?></h2>
        <button id="checkout-btn">Check out</button>
    <?php else:?>
        <div class="empty" style="background-image: url('public/images/empty.jpg');" >No items in cart yet. Enjoy your shopping</div>
    <?php endif; ?>
</div>

<script>
    const btn = document.querySelector('#checkout-btn');
    btn.addEventListener('click', async (e) => {
        e.preventDefault();
        if (confirm("Are you sure you want to checkout?")) {
            try {
                const response = await fetch("api.php?page=cart&action=checkout")
                const res = await response.json();
                if (res['status'] == 'success') {
                    alert("You successfully checkout! Hooray!");
                    window.location.href = "index.php";
                }
            } catch (err) {
                console.log(err);
            }
        }
    })
</script>
