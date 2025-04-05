<div>
    <div>
        <img src=<?= "public/images/" . $item['imageLink'] ?> alt="">
    </div>
    <div>
        <h1 id="item-title" value=<?= $item['id']?>><?= $item['title'] ?></h1>
        <span><?= $item['catName'] ?></span>
        <p><?= $item["productDesc"] ?></p>
        <h2><?= $item['price']?></h2>
        Amount: <input id="item-amount" type="number" min="1" max=<?= $item['inStock']?> value="1">
        <button id="add-cart-btn">Add to cart</button>
    </div>
</div>

<script>
    document.querySelector("#add-cart-btn").addEventListener('click', (e) => {
        e.preventDefault();
        let item_id = document.querySelector("#item-title").value;
        let amount = document.querySelector("#item-amount").value;

        let url = `api.php?role=user&item=${item_id}&amount=${amount}`;
        fetch(url)
        .then(response => response.json())
        .then(res => {
            if (res["status"] == "success") {
                alert(`Add item to cart!`);
            }
        })
        .catch(err => {
            console.log(err);
        })
    })
</script>