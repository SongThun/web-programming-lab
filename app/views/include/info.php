<div class="info flex">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="<?= BASE_URL ?>cart/"><i class='bx bx-cart-alt'></i></a>
        <span class="flex">
            <i class='bx bx-user me-1'></i> 
            <?= $_SESSION["username"] ?>
        </span>
        <a class="mobile-hidden" href="<?= BASE_URL ?>logout/">Log out</a>
    <?php else: ?>
        <a id="login-btn" href="<?= BASE_URL ?>login/">Login</a>
    <?php endif; ?>
</div>
