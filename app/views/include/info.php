<div class="info flex">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="index.php?page=cart"><i class='bx bx-cart-alt'></i></a>
        <span class="mobile-hidden flex">
            <i class='bx bx-user me-1'></i> 
            <?= $_SESSION["username"] ?>
        </span>
        <a class="mobile-hidden" href="index.php?page=logout">Log out</a>
    <?php else: ?>
        <a id="login-btn" href="index.php?page=login">Login</a>
    <?php endif; ?>
</div>
