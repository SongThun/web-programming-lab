<div class="auth-page">
    <div class="container auth-display">
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
                    <img class="icon auth-icon me-2 ms-1" src="public/images/visibility_off.svg" data-id="password-input">
                </div>
                <span class="err c-red"></span>
            </div>
            <div class="input-field" id="confirm-password-input">
                <label>Confirm password:</label> <div class="input-wrap">
                    <input class="input-hidden" type="password" required>
                    <span class="c-red">*</span>
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
