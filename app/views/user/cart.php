<div>
    <?php foreach ($items as $item):?>
        <div>
            <img src=<?= "public/images/" . $item['imageLink'] ?> alt="">
            <div>
                <h2><?= $item['title']?></h2>
                <span><?= $item['price']?></span>
            </div>
            <div>
                <span><?= $item['amount'] ?></span>
                <h3><?= $item['total'] ?></h3>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if ($items != null and count($items) > 0):?>
        <button id="checkout-btn">Check out</button>
    <?php else:?>
        <div>No items in cart yet. Enjoy your shopping</div>
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
