<header>
    <h1><a href="admin.php"><img class="logo" src="public/images/logo.png" alt="lorem ipsum"></a></h1>
    <ul>
        <li><a href="admin.php?page=product" class=<?= ($page === 'product') ? "selected" : "" ?>>Products</a></li>
        <!-- <li><a href="admin.php?page=sales">Sales</a></li> -->
    </ul>
    <div class="info">
        <span>
            <i class='bx bx-user me-1'></i>
            <?= $_SESSION['username'] ?>
        </span>
        <a href="index.php?page=logout">Log out</a>
    </div>
</header>