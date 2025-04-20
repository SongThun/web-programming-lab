<?php
$username = $_SESSION['username'];
?>
<div class="big-img" style="background-image: url('<?= IMAGE_PATH ?>bg-purple.jpg')">
    <h2>Welcome back <?= e($username) ?></h2>
</div>