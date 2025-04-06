<!-- <?php
        if (isset($_SESSION['role']) and $_SESSION['role'] == 'user') {
            echo "<h2> Welcome " . $_SESSION['username'] . "</h2>";
        }
        ?> -->
<div class="container">
    <div class="banner container" style="background-image: url('public/images/bg-purple.jpg')">
        <h1>Shopping with joy</h1>
        <form id="search-item" action="index.php?page=product" method="POST">
            <input type="text" name='title' placeholder="Search your item">
            <button type="submit" class="btn-transparent"><i class='bx bx-search-alt'></i></button>
        </form>
    </div>
    <div class="home-box" id="home-popular">
        <h1>Most Loved by Customers</h1>
        <span class="c-iris">Discover what everyone’s raving about</span>
        <div class="flex">
            <div class="flex overflow-x">
                <?php foreach ($popular as $pop): ?>
                    <div class="card container space-between">
                        <div>
                            <img src=<?= "public/images/" . $pop["imageLink"] ?> alt="">
                            <h3 class="mt-2"><?= $pop['title'] ?></h3>
                        </div>
                        <div class="flex space-between">
                            <h2>$<?= $pop['price'] ?></h2>
                            <span class="flex c-yellow"><?= $pop['salesAmount'] ?><i class='bx bxs-heart'></i></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="home-box" id="home-categories">
        <h1>Our Current Collections</h1>
        <span class="c-iris">Explore our wide range of products</span>
        <div class="flex">
            <button class="btn-transparent" onclick="overflowMove(-500)">
                <i class='bx bx-chevron-left'></i>
            </button>
            <div class="flex overflow-x">
                <?php foreach ($categories as $cat): ?>
                    <div class="card container">
                        <img src=<?= "public/images/" . $cat["imageLink"] ?> alt="">
                        <h3><?= $cat['catName'] ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="btn-transparent" onclick="overflowMove(500)">
                <i class='bx bx-chevron-right'></i>
            </button>
        </div>
    </div>
</div>

<script>
    function overflowMove(amount) {
        const container = document.querySelector("#home-categories .overflow-x");
        container.scrollBy({
            left: amount,
            behavior: "smooth"
        });
    }
</script>