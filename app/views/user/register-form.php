<div class="auth-page">
    <div class="container auth-display">
        <a href="<?= BASE_URL ?>" id="logo"><img class="logo" src="<?= IMAGE_PATH ?>logo.png" alt="lorem ipsum"></a>
        <h1>Create an account</h1>
        <form novalidate class="container" id="register-form" action="?page=login" method="POST">
            <div class="input-field" id="email-input">
                <label>Email: </label>
                <input type="email" required placeholder="example@email.com">
                <span class="err c-red"></span>
            </div>
            <div class="input-field" id="username-input">
                <label>Username: </label>
                <div class="input-wrap">
                    <input class="input-hidden" type="text" required minlength="8" placeholder="ex: user123">
                    <span class="c-red me-2">*</span>
                </div>
                <span class="err c-red"></span>
            </div>
            <div class="input-field" id="password-input">
                <label>Password <small>(minimum 8 characters)</small>:</label>
                <div class="input-wrap">
                    <input class="input-hidden" type="password" required minlength="8">
                    <span class="c-red">*</span>
                    <img class="icon auth-icon me-2 ms-1" src="<?= IMAGE_PATH ?>visibility_off.svg" data-id="password-input">
                </div>
                <span class="err c-red"></span>
            </div>
            <div class="input-field" id="confirm-password-input">
                <label>Confirm password:</label>
                <div class="input-wrap">
                    <input class="input-hidden" type="password" required>
                    <span class="c-red">*</span>
                    <img class="icon auth-icon me-2 ms-1" src="<?= IMAGE_PATH ?>visibility_off.svg" data-id="confirm-password-input">
                </div>
                <span class="err c-red"></span>
            </div>
            <span id="register-err" class="err c-red mt-2"></span>
            <button type="submit">Register</button>
        </form>
        <span>Have an account? <a href="<?= BASE_URL ?>login/" class="c-iris">Login</a></span>
    </div>
    <div class="big-img" style="background-image: url('<?= IMAGE_PATH ?>register-illustration.jpg')"></div>
</div>
<script src="<?= SCRIPT_PATH ?>auth.js"></script>
<script>
    const register_form = document.getElementById('register-form');

    register_form.addEventListener("submit", function(e) {
        e.preventDefault();
        let email = document.querySelector("#email-input input").value;
        let username = document.querySelector("#username-input input").value;
        let password = document.querySelector("#password-input input").value;
        let confirm_pw = document.querySelector("#confirm-password-input input").value;

        const emailError = document.querySelector("#email-input .err");
        const usernameError = document.querySelector("#username-input .err");
        const passwordError = document.querySelector("#password-input .err");
        const confirmPasswordError = document.querySelector("#confirm-password-input .err");
        const registerError = document.querySelector("#register-err");

        emailError.innerHTML = "";
        usernameError.innerHTML = "";
        passwordError.innerHTML = "";
        confirmPasswordError.innerHTML = "";

        let isValid = true;

        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (email !== '' && !emailPattern.test(email)) {
            console.log("email ", email);
            emailError.innerHTML = "<i class='bx bx-error-circle me-1'></i> Not a valid email";
            isValid = false;
        }

        if (username.length < 1) {
            usernameError.innerHTML = "<i class='bx bx-error-circle me-1'></i> Username must contain at least one character";
            isValid = false;
        }

        if (password.length < 8) {
            passwordError.innerHTML = "<i class='bx bx-error-circle me-1'></i> Password must be at least 8 characters long";
            isValid = false;
        }

        if (password !== confirm_pw) {
            confirmPasswordError.innerHTML = "<i class='bx bx-error-circle me-1'></i> Passwords must match";
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        fetch(`${window.API}register`, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "email": email,
                    "username": username,
                    "password": password
                })
            })
            .then(response => {
                if (response.ok && response.headers.get("Content-Type").includes("application/json")) {
                    return response.json();
                }
                throw new Error("Expected JSON response");
            })
            .then(res => {
                if (res.status === 'success') {
                    // window.location.href = window.BASE_URL;
                    window.history.back();
                    setTimeout(() => location.reload(), 100);
                }
                else {
                    registerError.innerHTML = "<i class='bx bx-error-circle me-1'></i> Username exists.";
                }
            })
            .catch(error => {
                console.error(error);
            });
    });


    document.querySelector("#email-input input").addEventListener("input", function() {
        const emailError = document.querySelector("#email-input .err");
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (emailPattern.test(this.value)) {
            emailError.innerHTML = "";
        }
    });

    document.querySelector("#username-input input").addEventListener("input", function() {
        const usernameError = document.querySelector("#username-input .err");
        if (this.value.length > 0) {
            usernameError.innerHTML = "";
        }
    });

    document.querySelector("#password-input input").addEventListener("input", function() {
        const passwordError = document.querySelector("#password-input .err");
        if (this.value.length >= 8) {
            passwordError.innerHTML = "";
        }
    });

    document.querySelector("#confirm-password-input input").addEventListener("input", function() {
        const confirmPasswordError = document.querySelector("#confirm-password-input .err");
        const password = document.querySelector("#password-input input").value;
        if (this.value === password) {
            confirmPasswordError.innerHTML = "";
        }
    });
</script>