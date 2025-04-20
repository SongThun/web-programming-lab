<div class="dynamic-nav" data-state="<?= isset($_SESSION['user_id']) ? 'login' : 'none' ?>">
    <ul class="hnav">
        <li><a href="<?= e(BASE_URL . 'home/') ?>" class="<?= ($page === 'home') ? 'selected' : '' ?>">Home</a></li>
        <li><a href="<?= e(BASE_URL . 'product/') ?>" class="<?= ($page === 'product') ? 'selected' : '' ?>">Product</a></li>
        <li><a href="<?= e(BASE_URL . 'about/') ?>" class="<?= ($page === 'about') ? 'selected' : '' ?>">About</a></li>
        <li id="logout-btn" style="display: none;"><a href="<?= e(BASE_URL . 'logout/') ?>">Logout</a></li>
    </ul>
</div>

<script>
    const nav = document.querySelector(".dynamic-nav");
    const desktopNav = nav.querySelector("ul");
    const collapsebtn = document.createElement("button");
    const logoutBtn = document.querySelector('#logout-btn');

    collapsebtn.classList.add('collapse-btn');
    collapsebtn.innerHTML = "<i class='bx bx-menu'></i>";

    const toggleMobileMenu = () => {
        const ul = nav.querySelector("ul");
        if (ul.classList.contains('collapsed')) {
            ul.classList.remove('collapsed');
            ul.style.display = 'none';
        } else {
            ul.classList.add('collapsed');
            ul.style.display = 'flex';
        }
    };

    collapsebtn.addEventListener('click', toggleMobileMenu);

    function changeNav() {
        if (window.matchMedia("(max-width: 768px)").matches) {
            if (!nav.contains(collapsebtn)) {
                nav.insertBefore(collapsebtn, nav.firstChild);
                desktopNav.style.display = 'none'; // Hide the navigation initially
                if (nav.dataset.state === 'login') {
                    logoutBtn.style.display = 'block';
                }
            }
        } else {
            if (nav.contains(collapsebtn)) {
                nav.removeChild(collapsebtn);
                desktopNav.style.display = 'flex'; // Show the navigation
                logoutBtn.style.display = 'none';
            }
        }
    }

    window.addEventListener('resize', changeNav);
    window.addEventListener('load', changeNav);

    document.addEventListener('click', (event) => {
        const isMobile = window.matchMedia("(max-width: 768px)").matches;
        const isClickInside = nav.contains(event.target);
        const ul = nav.querySelector("ul");

        if (isMobile && !isClickInside && ul.classList.contains('collapsed')) {
            ul.classList.remove('collapsed');
            ul.style.display = 'none';
        }
    })
</script>