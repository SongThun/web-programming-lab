<?php
if (isset($_SESSION['role']) and $_SESSION['role'] == 'user') {
    echo "<h2> Welcome " . $_SESSION['username'] . "</h2>";
}
?>

<div>
    <?php foreach ($categories as $cat): ?>
        <div>
            <?= $cat['catName']?>
        </div>
    <?php endforeach; ?> 
</div>