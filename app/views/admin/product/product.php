<div class="container-inset grid-1-4">
    <div class="side">
        <div class="sidebar">
            <button id="add-btn" class="flex align-center center">
                <i class='bx bx-plus'></i>
                <span class="mobile-hidden">Add product</span>
            </button>
            <div id="filter-categories">
                <button value="all" class="btn-active">All</button>
                <?php foreach ($categories as $cat): ?>
                    <button value=<?= $cat['catID'] ?>><?= $cat['catName'] ?></button>
                <?php endforeach; ?>
            </div>
        </div>

    </div>

    <div>
        <?php require "product_utils.php" ?>
        <div class="table-wrapper overflow-x">
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
                <tbody id="admin-product-display">
                    <?php foreach ($products as $prod): ?>
                        <tr>
                            <td><?= $prod["id"] ?></td>
                            <td><a class="info-group" href=<?= "admin.php?page=product&action=view&item=" . $prod['id'] ?>>
                                    <small><?= $prod["catName"] ?></small>
                                    <h3><?= $prod["title"] ?></h3>
                                </a></td>
                            <td>$<?= $prod["price"] ?></td>
                            <td><?= $prod["salesAmount"] ?></td>
                            <td><?= $prod["inStock"] ?></td>
                            <td><?= $prod["discount"] * 100 ?>%</td>
                            <td><img src=<?= "public/images/" . $prod["imageLink"] ?> alt=<?= $prod['title'] ?>></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="public/js/admin_products.js"></script>

<script>
    const sideBtn = document.createElement('button');
    sideBtn.innerHTML = "<i class='bx bx-menu-alt-left'></i>";
    sideBtn.id = "sidebar-btn";
    document.body.appendChild(sideBtn);


    const sidebar = document.querySelector(".sidebar");
    const addBtn = document.querySelector('#add-btn');
    const productUtils = document.querySelector("#product-utils");

    function changeSidebar() {

        if (window.matchMedia("(max-width: 768px)").matches) {

            sidebar.style.display = 'none';
            if (sidebar.contains(addBtn)) {
                sidebar.removeChild(addBtn);
            }

            productUtils.insertBefore(addBtn, productUtils.firstChild);
            productUtils.insertBefore(sideBtn, productUtils.firstChild);

        } else {
            sidebar.style.display = 'flex';
            if (productUtils.contains(addBtn)) {
                productUtils.removeChild(addBtn);
            }
            if (productUtils.contains(sideBtn)) {
                productUtils.removeChild(sideBtn);
            }
            sidebar.insertBefore(addBtn, sidebar.firstChild);
        }
    }

    window.addEventListener('resize', changeSidebar);
    window.addEventListener('load', changeSidebar);

    sideBtn.addEventListener('click', () => {
        sidebar.classList.toggle('sidebar-collapsed')
    })

    addBtn.addEventListener('click', () => {
        window.location.href = "admin.php?page=product&action=add";
    })
</script>