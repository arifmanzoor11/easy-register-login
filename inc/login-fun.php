<?php 
function custom_user_login($username, $password) {
if (is_user_logged_in()) {
    // User is already logged in, no need to log in again.
    return;
}
// Define user credentials
$user_credentials = array(
'user_login' => $username,
'user_password' => $password,
'remember' => true, // Set to true to remember the user's login (optional)
);

// Attempt to sign in the user
$alert = '';
$user = wp_signon($user_credentials);
if (is_wp_error($user)) {
     $alert = $user->get_error_message();
     echo json_encode(array('Success' => '400', 'Content' => $alert));
     exit;
    // Login failed; handle the error
} else {
        // Login successful; you can now perform actions as the logged-in user
        // For example, you can use $user to access user data, such as $user->ID
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        $alert = 'Logged in successfully as ' . $user->user_login . ' redirecting...'; 
        echo json_encode(array('Success' => '200', 'Content' => $alert));
        exit;
    }
}

add_shortcode('custom_login_form', 'custom_login_form');

function custom_login_form() {
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
            <i id="eyeIcon" class="fa fa-eye">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                    class="bi bi-eye-fill" viewBox="0 0 16 16">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                    <path
                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                </svg>
            </i>
        </button>
    </div>
    </p>
    <img src="https://www.vyvapts.com/wp-content/uploads/loading.gif" width="25px" class="loading-img"
        style="display:none; position: absolute; margin-top: 10px; margin-left: 10px;" alt="">
    <input type="submit" class="esylogin-btn" value="Log In">
    
    <?php
    $get_esylogin_reg_google_auth = unserialize(get_option('esylogin_reg_google_auth'));
    if($get_esylogin_reg_google_auth) {
        echo do_shortcode('[google_oauth_button]');
    } ?>
    <br>
    <?php $get_esylogin_reg_facebook_auth = unserialize(get_option('esylogin_reg_facebook_auth')); 
    if($get_esylogin_reg_facebook_auth) {
    echo do_shortcode('[facebook_oauth_button]'); } ?>
    <br>
    <a class="forgot-btn" href="<?php echo wp_lostpassword_url() ?>">Forgot Password?</a>
        <?php //echo wp_lostpassword_url(); ?>
    <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
</form>
<span id="vote_counter" style="display:none"></span>
<script>
    let passwordInput = document.getElementById('txtPassword'),
    toggle = document.getElementById('btnToggle'),
    icon = document.getElementById('eyeIcon');

function togglePassword() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.add("fa-eye-slash");
        //toggle.innerHTML = 'hide';
    } else {
        passwordInput.type = 'password';
        icon.classList.remove("fa-eye-slash");
        //toggle.innerHTML = 'show';
    }
}
// function checkInput() { }

toggle.addEventListener('click', togglePassword, false);
</script>
<?php
    return ob_get_clean(); // Return the captured HTML content.
}

add_action('wp_ajax_nopriv_easy_get_login', 'easy_get_login');
add_action('wp_ajax_easy_get_login', 'easy_get_login');

function easy_get_login(){
       // First check the nonce, if it fails the function will break
       check_ajax_referer( 'ajax-login-nonce', 'security' );
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = sanitize_user($_POST['username']);
        $password = sanitize_text_field($_POST['password']);
        
        // Call the custom_user_login function with the submitted credentials.
        custom_user_login($username, $password); }
}