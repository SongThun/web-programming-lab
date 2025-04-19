<div class="auth-page">
    <div class="container auth-display">
        <a href="<?= BASE_URL ?>" id="logo"><img class="logo" src="<?= IMAGE_PATH ?>logo.png" alt="lorem ipsum"></a>
        <h1>Welcome back!</h1>
        <form novalidate class="container" id="login-form" action="?page=login" method="POST">
            <div class="input-field" id="username-input">
                <label for="username">Username</label>
                <input type="text" name="username" required autocomplete="current-password">
            </div>
            <div class="input-field" id="password-input">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <input class="input-hidden" type="password" required minlength="8" autocomplete="current-password">
                    <img class="icon auth-icon me-2 ms-1" src="<?= IMAGE_PATH ?>visibility_off.svg" data-id="password-input">
                </div>
            </div>
            <span class="err flex mt-1 c-red"></span>
            <button type="submit">Login</button>
        </form>
        <span>Not a member? <a href="<?=BASE_URL?>register/" class="c-iris">Register now</a></span>
    </div>
    <div class="big-img" style="background-image: url('<?= IMAGE_PATH ?>login-illustration.jpg')"></div>
</div>
<script src="<?= SCRIPT_PATH ?>auth.js"></script>
<script>
    const login_form = document.getElementById('login-form');

    login_form.addEventListener("submit", function(e) {
        e.preventDefault();
        let username = document.querySelector("#username-input input").value;
        let password = document.querySelector("#password-input input").value;

        const err = login_form.querySelector("span.err");
        err.innerHTML = "";
        if (username == "" || password == "") {
            err.innerHTML = "<i class='bx bx-error-circle me-1'></i> All fields are required";
        } else {
            fetch(`${window.API}login`, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        "username": username,
                        "password": password
                    })
                })
                .then(response => {
                    // Check if the response is JSON
                    if (response.ok && response.headers.get("Content-Type").includes("application/json")) {
                        return response.json();
                    }
                    throw new Error("Expected JSON response");
                })
                .then(res => {
                    if (res.status === 'success') {
                        window.history.back();
                    } else {
                        err.innerHTML = "<i class='bx bx-error-circle me-1'></i> Incorrect username or password";
                        document.querySelector("#password-input input").value = "";
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    })
</script>