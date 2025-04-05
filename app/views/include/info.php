<div class="info">
    <?php if (isset($_SESSION['user_id'])): ?>
        <button>favorite</button>;
        <span><?= $_SESSION["username"] ?></span>
        <a href="?page=logout">Log out</a>
    <?php else: ?>
        <a id="logout-btn" href="?page=login">Login</a>
    <?php endif; ?>
</div>