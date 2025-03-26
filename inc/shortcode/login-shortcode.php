<?php
add_shortcode('login_shortcode', 'login_shortcode');
function login_shortcode()
{
    ob_start(); // Start output buffering to capture the form HTML.
// Check if the user is already logged in.
    if (is_user_logged_in()) {
        // Display a message if the user is logged in.
        return 'You are already logged in.';
    } ?>
    <form id="easy-login-form" action="" method="post">
        <p>
            <label for="username">Username:</label>
            <input class="esylogin-input" type="text" name="username" id="username" required>
        </p>
        <p>
            <label for="password">Password:</label>
        <div class="password-group">
            <input class="esylogin-input" type="password" name="password" id="txtPassword" required>
            <button type="button" id="btnToggle" class="toggle">
                <span id="eyeIcon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                        <path
                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                    </svg>
                </span>
            </button>
        </div>
        </p>
        <div style="position: relative;">
            <img src="<?php echo plugin_assets_url() . 'img/loading.gif' ?>" width="25px" class="loading-img"
                style="display:none; position: absolute;top: calc(50% + -12px);left: 10px;" alt="">
            <input type="submit" class="esylogin-btn" value="Log In">
        </div>
        <?php
        $get_esylogin_reg_google_auth = unserialize(get_option('esylogin_reg_google_auth'));
        if ($get_esylogin_reg_google_auth) {
            echo do_shortcode('[google_oauth_button]');
        } ?>
        <br>
        <?php $get_esylogin_reg_facebook_auth = unserialize(get_option('esylogin_reg_facebook_auth'));
        if ($get_esylogin_reg_facebook_auth) {
            echo do_shortcode('[facebook_oauth_button]');
        } ?>
        <br>
        <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
    </form>
    <span id="vote_counter" style="display:none"></span>
    <script>
        let passwordInput = document.getElementById('txtPassword'),
            toggle = document.getElementById('btnToggle'),
            icon = document.getElementById('eyeIcon');

        function togglePassword() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
        toggle.addEventListener('click', togglePassword, false);
    </script>
    <?php
    return ob_get_clean(); // Return the captured HTML content.
}
