<div class="info flex">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="index.php?page=cart"><i class='bx bx-cart-alt'></i></a>
        <span><?= $_SESSION["username"] ?></span>
        <a href="index.php?page=logout">Log out</a>
    <?php else: ?>
        <a id="logout-btn" href="index.php?page=login">Login</a>
    <?php endif; ?>
</div>
