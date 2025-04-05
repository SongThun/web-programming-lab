<?php
if (isset($_SESSION['role']) and $_SESSION['role'] == 'user') {
    echo "<h2> Welcome " . $_SESSION['username'] . "</h2>";
}
?>

<div class="home-categories">
    <?php foreach ($categories as $cat): ?>
        <div class="card-image" style="background-image: url('public/images/<?= $cat['imageLink'] ?>')">
            <div>
                <h1><?= $cat['catName']?></h1>
                <button>See more</button>
            </div>
        </div>
    <?php endforeach; ?> 
</div>