<div class="flex">
    <div class="container auth-display">
        <h1>Create an account</h1>
        <form novalidate class="container" id="register-form" action="?page=login" method="POST">
            <div class="input-field" id="email-input">
                Email: <input type="email" required placeholder="example@email.com">
                <span class="err c-red"></span>
            </div>
            <div class="input-field" id="username-input">
                Username: <input type="text" required minlength="8" placeholder="ex: user123">
                <span class="err c-red"></span>
            </div>
            <div class="input-field" id="password-input">
                Password:
                <div class="input-wrap">
                    <input class="input-hidden" type="password" required minlength="8">
                    <img class="icon auth-icon me-2 ms-1" src="public/images/visibility_off.svg" data-id="password-input">
                </div>
                <span class="err c-red"></span>
            </div>
            <div class="input-field" id="confirm-password-input">
                Confirm password: <div class="input-wrap">
                    <input class="input-hidden" type="password" required>
                    <img class="icon auth-icon me-2 ms-1" src="public/images/visibility_off.svg" data-id="confirm-password-input">
                </div>
                <span class="err c-red"></span>
            </div>
            <button type="submit">Register</button>
        </form>
        <span>Have an account? <a href="?page=login" class="c-iris">Login</a></span>
    </div>
    <div class="big-img" style="background-image: url('public/images/register-illustration.jpg')"></div>
</div>
<script src="public/js/auth.js"></script>
