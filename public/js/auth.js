const authIcons = document.querySelectorAll(".auth-icon");

authIcons.forEach((e) => {
    e.addEventListener('click', () => {
        const isInvisible = e.src.includes('visibility_off');
        const id = e.getAttribute('data-id');
        const input = document.querySelector(`#${id} .input-hidden`);

        if (isInvisible) {
            input.type = 'text';
            e.src = "public/images/visibility.svg";
        } else {
            input.type = 'password';
            e.src = "public/images/visibility_off.svg";
        }
    });
});

const register_form = document.getElementById('register-form');
console.log("register")
register_form.addEventListener("submit", function (e) {
    e.preventDefault();
    let email = document.querySelector("#email-input input").value;
    let username = document.querySelector("#username-input input").value;
    let password = document.querySelector("#password-input input").value;
    let confirm_pw = document.querySelector("#confirm-password-input input").value;

    const emailError = document.querySelector("#email-input .err");
    const usernameError = document.querySelector("#username-input .err");
    const passwordError = document.querySelector("#password-input .err");
    const confirmPasswordError = document.querySelector("#confirm-password-input .err");

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

    fetch("api.php?page=register", {
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
            window.location.href = "index.php";
        } 
    })
    .catch(error => {
        console.error(error);
    });
});


document.querySelector("#email-input input").addEventListener("input", function () {
    const emailError = document.querySelector("#email-input .err");
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (emailPattern.test(this.value)) {
        emailError.innerHTML = "";
    }
});

document.querySelector("#username-input input").addEventListener("input", function () {
    const usernameError = document.querySelector("#username-input .err");
    if (this.value.length > 0) {
        usernameError.innerHTML = "";
    }
});

document.querySelector("#password-input input").addEventListener("input", function () {
    const passwordError = document.querySelector("#password-input .err");
    if (this.value.length >= 8) {
        passwordError.innerHTML = "";
    }
});

document.querySelector("#confirm-password-input input").addEventListener("input", function () {
    const confirmPasswordError = document.querySelector("#confirm-password-input .err");
    const password = document.querySelector("#password-input input").value;
    if (this.value === password) {
        confirmPasswordError.innerHTML = "";
    }
});
