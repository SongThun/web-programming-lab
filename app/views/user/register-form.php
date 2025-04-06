<div class="flex">
    <div class="container auth-display">
        <h1>Create an account</h1>
        <form novalidate class="container" id="register-form" action="?page=login" method="POST">
            <div class="input-field" id="username-input">
                Username: <input type="text" required minlength="8">
            </div>
            <div class="input-field" id="password-input">
                Password: <input type="password" required minlength="8">
            </div>
            <div class="input-field" id="confirm-password-input">
                Confirm password: <input type="confirm-password" required>
            </div>
            <span class="err flex mt-1 c-red"></span>
            <button type="submit">Register</button>
        </form>
        <span>Have an account? <a href="?page=login" class="c-iris">Login</a></span>
    </div>
    <div class="big-img" style="background-image: url('public/images/register-illustration.jpg')"></div>
</div>

<script>
    const register_form = document.getElementById('register-form');

    register_form.addEventListener("submit", function(e) {
        e.preventDefault();
        let username = document.querySelector("#username-input input").value;
        let password = document.querySelector("#password-input input").value;
        let confirm_pw = document.querySelector("#confirm-password-input input").value;

        const err = register_form.querySelector("span.err");

        err.innerHTML = "";
        if (username == "" || password == "" || confirm_pw == "") {
            err.innerHTML = "<i class='bx bx-error-circle me-1'></i> All fields are required";
        } else {
            fetch("api.php?page=register", {
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
                        err.innerHTML = `<i class='bx bx-error-circle me-1'></i> ${username} is already taken.`; 
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        }
    })
</script>