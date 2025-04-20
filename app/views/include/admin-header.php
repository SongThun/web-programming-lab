<header>
    <h1><a href="<?= e(ADMIN_URL) ?>"><img class="logo" src="<?= e(IMAGE_PATH . "logo.png") ?>" alt="lorem ipsum"></a></h1>
    <ul>
        <li><a href="<?= e(ADMIN_URL . 'product/') ?>" class=<?= ($page === 'product') ? "selected" : "" ?>>Products</a></li>
        <!-- <li><a href="admin.php?page=sales">Sales</a></li> -->
    </ul>
    <div class="info">
        <span>
            <i class='bx bx-user me-1'></i>
            <?= e($_SESSION['username']) ?>
        </span>
        <a href="<?= BASE_URL ?>logout/">Log out</a>
    </div>
</header>