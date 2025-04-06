<div class="flex">
    <div class="container auth-display">
        <h1>Welcome back!</h1>
        <form novalidate class="container" id="login-form" action="?page=login" method="POST">
            <div class="input-field" id="username-input">
                <label for="username">Username</label>
                <input type="text" name="username" required autocomplete="current-password">
            </div>
            <div class="input-field" id="password-input">
                <label for="password">Password</label>
                <input type="password" name="password" required autocomplete="current-password">
            </div>
            <span class="err flex mt-1 c-red"></span>
            <button type="submit">Login</button>
        </form>
        <span>Not a member? <a href="?page=register" class="c-iris">Register now</a></span>
    </div>
    <div class="big-img" style="background-image: url('public/images/login-illustration.jpg')"></div>
</div>

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
            fetch("api.php?page=login", {
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
                        window.location.href = "index.php"; 
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