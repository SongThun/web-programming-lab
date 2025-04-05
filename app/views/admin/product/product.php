<div>
    <div>
        <button>Add product</button>
        <div id="filter-categories">
            <button value="all" class="btn-active">All</button>
            <?php foreach ($categories as $cat): ?>
                <button value=<?= $cat['catName']?> ><?= $cat['catName'] ?></button>
            <?php endforeach; ?>
        </div>
    </div>
   
    <div>
        <?php require "product_utils.php" ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Total sales</th>
                    <th>In stock</th>
                    <th>Discount</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody id="product-display">
                <?php foreach ($products as $prod): ?>
                    <tr>
                        <td><?= $prod["id"] ?></td>
                        <td><div>
                            <span><?= $prod["catName"] ?></span>
                            <span><?= $prod["title"] ?></span>
                        </div></td>
                        <td><?= $prod["price"] ?></td>
                        <td><?= $prod["salesAmount"] ?></td>
                        <td><?= $prod["inStock"] ?></td>
                        <td><?= $prod["discount"] ?></td>
                        <td><img src=<?= "public/images/" . $prod["imageLink"] ?> alt=""></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="public/js/admin_products.js"></script>
<script src="public/js/crud.js">
    
</script>