<div>
    <section>
        <form novalidate id="login-form" action="?page=login" method="POST">
            <div id="username-input">
                Username: <input type="text" name="username" required autocomplete="current-password">
            </div>
            <div id="password-input">
                Password: <input type="password" name="password" required autocomplete="current-password">
            </div>
            <span class="err"></span>
            <button type="submit">Login</button>
        </form>
        <span>Not a member? <a href="?page=register">Register now</a></span>
    </section>
    <section>Some image here</section>
</div>

<script>
    const login_form = document.getElementById('login-form');

    login_form.addEventListener("submit", function(e) {
        e.preventDefault();
        let username = document.querySelector("#username-input input").value;
        let password = document.querySelector("#password-input input").value;

        const err = login_form.querySelector("span.err");

        if (username == "" || password == "") {
            err.innerText = "All fields are required";
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
                        err.innerText = "Incorrect username or password"; 
                        document.querySelector("#password-input input").value = "";
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    })
</script>