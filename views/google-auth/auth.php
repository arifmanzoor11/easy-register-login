<?php
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';
use League\OAuth2\Client\Provider\Google;
$get_esylogin_reg_google_auth = unserialize(get_option('esylogin_reg_google_auth'));

if(empty($get_esylogin_reg_google_auth)) {
    return;
}
//Google OAuth2 configuration
define('GOOGLE_CLIENT_ID', $get_esylogin_reg_google_auth[0]);
define('GOOGLE_CLIENT_SECRET', $get_esylogin_reg_google_auth[1]);
define('GOOGLE_REDIRECT_URI', $get_esylogin_reg_google_auth[2]);

// Initialize Google OAuth2 provider
$googleProvider = new Google([
    'clientId'     => GOOGLE_CLIENT_ID,
    'clientSecret' => GOOGLE_CLIENT_SECRET,
    'redirectUri'  => GOOGLE_REDIRECT_URI,
]);

// Callback function for Google OAuth2
function google_oauth_callback() {
    global $googleProvider;

    // Check if we have an authorization code
    if (isset($_GET['code'])) {
        try {
            // Get access token
            $accessToken = $googleProvider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

            // Get user info
            $googleUser = $googleProvider->getResourceOwner($accessToken);

            // Check if the user already exists
            $user = get_user_by('email', $googleUser->getEmail());

            // If user doesn't exist, create a new user
            if (!$user) {
                $user_data = [
                    'user_login'    => $googleUser->getEmail(),
                    'user_email'    => $googleUser->getEmail(),
                    'first_name'    => $googleUser->getFirstName(),
                    'last_name'     => $googleUser->getLastName(),
                    'role'          => 'subscriber', // Set default role
                    'user_pass'     => wp_generate_password(),
                    'show_admin_bar_front' 	=> 'false', 
                ];

                // Create user
                $user_id = wp_insert_user($user_data);

                if (!is_wp_error($user_id)) {
                    // Log in the user
                    wp_set_auth_cookie($user_id, true);
                    wp_redirect(easy_get_after_login_redirect_uri());
                    exit;
                } else {
                    wp_redirect(easy_get_after_login_redirect_uri());
                    exit;
                }
            } else {
                // Log in existing user
                wp_set_auth_cookie($user->ID, true);
                wp_redirect(easy_get_after_login_redirect_uri());
                exit;
            }
        } catch (Exception $e) {
            // Handle errors
            wp_redirect(wp_login_url());
            exit;
        }
    }
}
add_action('init', 'google_oauth_callback');

// Shortcode to show OAuth2 button
function google_oauth_button_shortcode() {
    global $googleProvider;

    // Generate Google OAuth2 authorization URL
    $authorizationUrl = $googleProvider->getAuthorizationUrl();

    // Output Google OAuth2 login button
    ob_start();
    ?>
    <style>
    .google-oauth-button{ width: 100%; background: #4f86ec; color: white;
        padding: 15px; display: block; text-align: center; text-decoration: none; }
    .google-oauth-button:hover{background:#3f6ec4; color:white}
    </style>
    <a href="<?php echo esc_url($authorizationUrl); ?>" class="google-oauth-button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
            <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z"/>
        </svg>
        Login with Google</a>
    <?php
    return ob_get_clean();
}
add_shortcode('google_oauth_button', 'google_oauth_button_shortcode');