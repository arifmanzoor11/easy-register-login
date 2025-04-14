<?php
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
use League\OAuth2\Client\Provider\Facebook;

$get_esylogin_reg_facebook_auth = unserialize(get_option('esylogin_reg_facebook_auth'));

// Check if Facebook auth is enabled before initializing
if(empty($get_esylogin_reg_facebook_auth) || 
   !isset($get_esylogin_reg_facebook_auth[3]) || 
   $get_esylogin_reg_facebook_auth[3] !== '1') {
    return;
}

// Facebook OAuth2 configuration
define('FACEBOOK_APP_ID', $get_esylogin_reg_facebook_auth[0]);
define('FACEBOOK_APP_SECRET', $get_esylogin_reg_facebook_auth[1]);
define('FACEBOOK_REDIRECT_URI', $get_esylogin_reg_facebook_auth[2]);

$facebookProvider = new Facebook([
    'clientId'          => FACEBOOK_APP_ID,
    'clientSecret'      => FACEBOOK_APP_SECRET,
    'redirectUri'       => FACEBOOK_REDIRECT_URI,
    'graphApiVersion'   => 'v19.0',
]);

function facebook_oauth_callback() {
    global $facebookProvider;
    if (isset($_GET['code'])) {
        try {
            $accessToken = $facebookProvider->getAccessToken('authorization_code', ['code' => $_GET['code']]);
            $facebookUser = $facebookProvider->getResourceOwner($accessToken);
            $user = get_user_by('email', $facebookUser->getEmail());
            if (!$user) {
                $user_data = [
                    'user_login'    => $facebookUser->getEmail(),
                    'user_email'    => $facebookUser->getEmail(),
                    'first_name'    => $facebookUser->getFirstName(),
                    'last_name'     => $facebookUser->getLastName(),
                    'role'          => 'subscriber',
                    'user_pass'     => wp_generate_password(),
                    'show_admin_bar_front' => 'false',
                ];
                $user_id = wp_insert_user($user_data);
                if (!is_wp_error($user_id)) {
                    wp_set_auth_cookie($user_id, true);
                    wp_redirect(easy_get_after_login_redirect_uri());
                    exit;
                } else {
                    wp_redirect(easy_get_after_login_redirect_uri());
                    exit;
                }
            } else {
                wp_set_auth_cookie($user->ID, true);
                wp_redirect(easy_get_after_login_redirect_uri());
                exit;
            }
        } catch (Exception $e) {
            wp_redirect(wp_login_url());
            exit;
        }
    }
}
add_action('init', 'facebook_oauth_callback');

function facebook_oauth_button_shortcode() {
    global $facebookProvider;
    if (!FACEBOOK_APP_ID || !FACEBOOK_APP_SECRET || !FACEBOOK_REDIRECT_URI) {
        return '<p>Error: Facebook authentication credentials not configured.</p>';
    }
    $authorizationUrl = $facebookProvider->getAuthorizationUrl(['scope' => ['email', 'public_profile']]);
    ob_start();
    ?>
    <style>
    .facebook-oauth-button { 
        width: 100%; 
        background: #1877F2; 
        color: white;
        padding: 15px; 
        display: block; 
        text-align: center; 
        text-decoration: none; 
        border-radius: 4px;
        font-family: Arial, sans-serif;
    }
    .facebook-oauth-button:hover {
        background: #166FE5; 
        color: white;
    }
    </style>
    <a href="<?php echo esc_url($authorizationUrl); ?>" class="facebook-oauth-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16" style="margin-right: 8px; vertical-align: middle;">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.95v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </svg>
        <span style="vertical-align: middle;">Login with Facebook</span>
    </a>
    <?php
    return ob_get_clean();
}
add_shortcode('facebook_oauth_button', 'facebook_oauth_button_shortcode');