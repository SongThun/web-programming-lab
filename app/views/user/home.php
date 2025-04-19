<!-- <?php
        if (isset($_SESSION['role']) and $_SESSION['role'] == 'user') {
            echo "<h2> Welcome " . $_SESSION['username'] . "</h2>";
        }
        ?> -->
<?php include "app/utils.php" ?>

<div class="container">
    <div class="banner container" style="background-image: url('<?= IMAGE_PATH ?>bg-purple.jpg')">
        <h1>Shopping with joy</h1>
        <div class="container">
            <form id="search-item" action="index.php?page=product" method="POST">
                <div id="search-bar">
                    <input type="text" name='title' placeholder="Search your item">
                    <button type="submit" class="btn-transparent"><i class='bx bx-search-alt'></i></button>
                </div>
                <div id="search-hint"></div>
            </form>
        </div>
    </div>
    <div class="home-box" id="home-popular">
        <h1>Most Loved by Customers</h1>
        <span class="c-iris">Discover what everyone’s raving about</span>
        <div class="flex">
            <button class="btn-transparent" onclick="overflowMove('home-popular', -500)">
                <i class='bx bx-chevron-left'></i>
            </button>
            <div class="flex overflow-x stretch">
                <?php foreach ($popular as $pop): ?>
                    <a
                        href="<?= PRODUCT_URL . slugify($pop["title"]) . "-" . $pop["id"]; ?>"
                        class="card container space-between">
                        <div>
                            <img src="<?= IMAGE_PATH . $pop["imageLink"] ?>" alt="">
                            <h3 class="mt-2"><?= $pop['title'] ?></h3>
                        </div>
                        <div class="flex space-between end">
                            <!-- <h2>$<?= $pop['price'] ?></h2> -->
                            <?php getDiscount($pop) ?>
                            <span class="flex c-yellow"><?= $pop['salesAmount'] ?><i class='bx bxs-heart'></i></span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
            <button class="btn-transparent" onclick="overflowMove('home-popular',500)">
                <i class='bx bx-chevron-right'></i>
            </button>
        </div>
        <a href="<?= PRODUCT_URL ?>">View all products<i class='ms-1 bx bx-arrow-back bx-rotate-180' ></i></a>
    </div>
    <div class="home-box" id="home-categories">
        <h1>Our Current Collections</h1>
        <span class="c-iris">Explore our wide range of products</span>
        <div class="flex">
            <button class="btn-transparent" onclick="overflowMove('home-categories',-500)">
                <i class='bx bx-chevron-left'></i>
            </button>
            <div class="flex overflow-x stretch">
                <?php foreach ($categories as $cat): ?>
                    <a
                        href="<?= PRODUCT_URL ?>category/<?= slugify($cat['catName']) ?>-<?= $cat['catID'] ?>"
                        class="card container">
                        <img src="<?= IMAGE_PATH . $cat["imageLink"] ?>" alt="">
                        <span><?= $cat['catName'] ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
            <button class="btn-transparent" onclick="overflowMove('home-categories',500)">
                <i class='bx bx-chevron-right'></i>
            </button>
        </div>
    </div>
</div>

<script>
    function debounce(fn, delay = 500) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => fn.apply(this, args), delay);
        };
    }

    function overflowMove(id, amount) {
        const container = document.querySelector(`#${id} .overflow-x`);
        const card = container.querySelector(".card");

        const cardStyle = getComputedStyle(card);
        const gap = parseFloat(getComputedStyle(container).gap) || 0;
        
        const cardWidth = card.offsetWidth + parseFloat(cardStyle.marginLeft) + parseFloat(cardStyle.marginRight) + gap;
        const isMobile = window.matchMedia("(max-width: 480px)").matches;
    
        container.scrollBy({
            left: isMobile ? (amount > 0 ? cardWidth : -cardWidth) : amount,
            behavior: "smooth"
        });
    }
    const searchbar = document.querySelector("#search-item input");
    const hintBox = document.querySelector("#search-hint");
    searchbar.addEventListener('input', debounce(async () => {
        const query = slugify(searchbar.value.trim());

        hintBox.innerHTML = "";

        if (!query) return;

        const url = `api.php?page=product&title=${query}`;
        try {
            const response = await fetch(url);
            const result = await response.json();
            if (result["data"].length > 0) {
                const ul = document.createElement("ul");

                result["data"].forEach(item => {
                    const li = document.createElement("li");
                    li.innerText = item["title"];
                    li.addEventListener("click", () => {
                        searchbar.value = item["title"];
                        hintBox.innerHTML = "";
                    });
                    ul.appendChild(li);
                });

                hintBox.appendChild(ul);
                console.log(ul);
            }
        } catch (err) {
            console.log(err);
        }
    }, 300));
</script>