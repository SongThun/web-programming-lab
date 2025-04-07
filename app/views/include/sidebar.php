<header>
    <h1><a href="admin.php">Lorem_ipsum</a></h1>
    <ul class="vnav">
        <li><a href="admin.php?page=product" class=<?= ($page === 'product') ? "selected" : "" ?>>Products</a></li>
        <!-- <li><a href="admin.php?page=sales">Sales</a></li> -->
    </ul>
    <div class="info">
        <span><?= $_SESSION['username'] ?></span>
        <a href="index.php?page=logout">Log out</a>
    </div>
</header>