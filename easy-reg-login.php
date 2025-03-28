<?php
/**
 * Plugin Name: Easy Login & Register
 * Plugin URI: http://guitarchordslyrics.com/
 * Description: This plugin provides an easy and hassle-free way to add user registration and login features to your WordPress website. 
 *              It includes secure user management, shortcodes for login and registration, and integration with Google and Facebook authentication.
 * Version: 2.1
 * Author: Arif M.
 * Author URI: http://guitarchordslyrics.com/
 * License: GNU GENERAL PUBLIC LICENSE
 *
 * Features:
 * - Shortcodes for login and registration forms.
 * - Integration with Google and Facebook authentication.
 * - Customizable login and registration pages.
 * - Admin menu for managing plugin settings.
 * - AJAX-based user image refresh functionality.
 * - Redirects for logged-in and non-logged-in users.
 * - Email notifications for new user registration.
 * - Compatibility with WooCommerce for login redirection.
 * - Includes additional files for navigation, URI handling, and AJAX registration.
 *
 * Hooks and Actions:
 * - `add_shortcode`: Registers the `[easy_qr_code_login]` shortcode.
 * - `wp_enqueue_scripts`: Enqueues frontend scripts and styles.
 * - `admin_enqueue_scripts`: Enqueues admin scripts and styles.
 * - `wp_ajax_myprefix_get_image`: Handles AJAX requests for refreshing user images.
 * - `admin_menu`: Adds admin menu and submenus for plugin settings.
 * - `wp`: Checks user login status and redirects accordingly.
 * - `plugin_action_links`: Adds a settings link to the plugin's action links.
 * - `admin_notices`: Displays an admin notice if the EasyMedia plugin is not installed.
 *
 * Functions:
 * - `easy_qr_code_login`: Includes the login and registration view.
 * - `getTimeNow`: Returns a greeting based on the current time of day.
 * - `add_sideSection`: Includes the side area view.
 * - `easy_scripts`: Enqueues frontend scripts and styles.
 * - `easy_login_load_admin_style_login_reg`: Enqueues admin scripts and styles.
 * - `myprefix_get_image`: Handles AJAX requests for user image refresh.
 * - `plugin_assets_url`: Returns the plugin's assets URL.
 * - `easy_reg_login_menu`: Adds admin menu and submenus.
 * - `login_menu_init`: Includes the admin menu view.
 * - `sub_login_menu_init`: Includes the Google authentication settings view.
 * - `sub_facebook_menu_init`: Handles Facebook authentication settings.
 * - `add_login_check`: Redirects users based on login status and page.
 * - `the_slug_exists`: Checks if a post slug exists.
 * - `easy_login_links`: Adds a settings link to the plugin's action links.
 * - `notify_new_user`: Sends an email notification to new users with login details.
 * - `custom_plugin_check_admin_notice`: Displays an admin notice if the EasyMedia plugin is not installed.
 *
 * Additional Files Included:
 * - `inc/nav-menu.php`: Handles navigation menu functionality.
 * - `inc/uri.php`: Manages URI-related functionality.
 * - `inc/assign-template.php`: Assigns templates for specific pages.
 * - `inc/login-fun.php`: Contains login-related functions.
 * - `views/google-auth/auth.php`: Handles Google authentication.
 * - `views/google-auth/facebook-auth.php`: Handles Facebook authentication.
 * - `inc/ajax-register.php`: Handles AJAX-based user registration.
 * - `inc/shortcode/login-shortcode.php`: Defines the login shortcode.
 * - `inc/shortcode/register-shortcode.php`: Defines the registration shortcode.
 * - `inc/shortcode/forgot-pw-shortcode.php`: Defines the forgot password shortcode.
 * - `admin/documentation/documentation-tab.php`: Displays plugin documentation in the admin panel.
    */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function easy_qr_code_login()
{
    include __DIR__ . '/views/parts/easy-login-register.php';
}
add_shortcode('easy_qr_code_login', 'easy_qr_code_login');

function getTimeNow()
{
    $hour = date('H');
    $dayTerm = ($hour > 17) ? "Evening" : (($hour > 12) ? "Afternoon" : "Morning");
    return "Good " . $dayTerm;
}

function add_sideSection()
{
    include __DIR__ . '/views/parts/easy-sidearea.php';
}

/**
 * Enqueue scripts and styles.
 */
function easy_scripts()
{
    $dir = plugin_dir_url(__FILE__);
    wp_enqueue_style('easy-dynamic-plugin', $dir . 'assets/css/dynamic-css-login.css.php');
    wp_enqueue_style('easy-plugin', $dir . 'assets/css/easy-plugin.css');

    wp_enqueue_script('easy-plugin', $dir . 'assets/js/easy-loginreg.js', array('jquery'));
    wp_localize_script('easy-plugin', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'easy_scripts');

add_action('admin_enqueue_scripts', 'easy_login_load_admin_style_login_reg');
function easy_login_load_admin_style_login_reg()
{
    $dir = plugin_dir_url(__FILE__);
    wp_enqueue_style('easy-login-register_url-admin', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', false, '1.0.0');
    wp_enqueue_style('easy-login-register_url-admin');

    wp_register_script('easy-login-register_url-admin', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', false, true);
    wp_enqueue_script('easy-login-register_url-admin');

    wp_enqueue_style('easy-loginreg-admin', $dir . 'admin/assets/css/esy-loginreg-admin.css', false, '1.0.0');
    wp_enqueue_style('easy-loginreg-admin');

    wp_register_script('easy-loginreg_js', $dir . 'admin/assets/js/easy-loginreg-admin.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('easy-loginreg_js');

    wp_enqueue_media();
}

// Ajax action to refresh the user image
add_action('wp_ajax_myprefix_get_image', 'myprefix_get_image');
function myprefix_get_image()
{
    if (isset($_GET['id'])) {
        $image = wp_get_attachment_image(filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT), 'medium', false, array('id' => 'myprefix-preview-image'));
        $data = array('image' => $image);
        wp_send_json_success($data);
    } else {
        wp_send_json_error();
    }
}

function plugin_assets_url()
{
    return plugin_dir_url(__FILE__);
}

// Include additional files
include_once(plugin_dir_path(__FILE__) . 'inc/nav-menu.php');
include_once(plugin_dir_path(__FILE__) . 'inc/uri.php');
include_once(plugin_dir_path(__FILE__) . 'inc/assign-template.php');
include_once(plugin_dir_path(__FILE__) . 'inc/login-fun.php');
include_once(plugin_dir_path(__FILE__) . 'views/google-auth/auth.php');
include_once(plugin_dir_path(__FILE__) . 'views/google-auth/facebook-auth.php'); // Added Facebook auth
// include_once(plugin_dir_path(__FILE__) . 'views/google-auth/twitter-auth.php'); // Added Facebook auth
include_once(plugin_dir_path(__FILE__) . 'inc/ajax-register.php');
include_once(plugin_dir_path(__FILE__) . 'inc/shortcode/login-shortcode.php');
include_once(plugin_dir_path(__FILE__) . 'inc/shortcode/register-shortcode.php');
include_once(plugin_dir_path(__FILE__) . 'inc/shortcode/forgot-pw-shortcode.php');


// Admin menu
add_action('admin_menu', 'easy_reg_login_menu');
function easy_reg_login_menu()
{
    add_menu_page(
        'Easy Login Register',
        'Easy Login',
        'manage_options',
        'easy-login-register',
        'login_menu_init',
        'dashicons-forms',
        21
    );
    add_submenu_page(
        'easy-login-register',
        __('Google Auth', 'textdomain'),
        __('Google Auth', 'textdomain'),
        'manage_options',
        'sub-login-menu',
        'sub_login_menu_init'
    );
    add_submenu_page(
        'easy-login-register',
        __('Facebook Auth', 'textdomain'),
        __('Facebook Auth', 'textdomain'),
        'manage_options',
        'sub-facebook-menu',
        'sub_facebook_menu_init'
    );

    add_submenu_page(
        'easy-login-register', // Parent menu slug (Easy Login Register)
        __('Auth Documentation', 'textdomain'), // Page title
        __('Auth Documentation', 'textdomain'), // Menu title
        'manage_options', // Capability
        'auth_documentation', // Menu slug (same as callback function)
        'auth_documentation' // Function to display content
    );

}

include __DIR__ . '/admin/documentation/documentation-tab.php';
function login_menu_init()
{
    include __DIR__ . '/admin/easy-login-admin.php';
}

function sub_login_menu_init()
{
    include __DIR__ . '/admin/includes/model/google-auth.php';
}

function sub_facebook_menu_init()
{
    // Save settings if form submitted
    if (isset($_POST['esylogin_reg_facebook_auth_nonce']) && wp_verify_nonce($_POST['esylogin_reg_facebook_auth_nonce'], 'save_facebook_auth')) {
        $facebook_auth = [
            sanitize_text_field($_POST['facebook_app_id']),
            sanitize_text_field($_POST['facebook_app_secret']),
            sanitize_text_field($_POST['facebook_redirect_uri'])
        ];
        update_option('esylogin_reg_facebook_auth', serialize($facebook_auth));
        echo '<div class="updated"><p>Facebook settings saved.</p></div>';
    }

    // Get current settings
    $current_settings = unserialize(get_option('esylogin_reg_facebook_auth')) ?: ['', '', ''];
    ?>
    <div class="wrap">
        <h1>Facebook Authentication Settings</h1>
        <form method="post" action="">
            <?php wp_nonce_field('save_facebook_auth', 'esylogin_reg_facebook_auth_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="facebook_app_id">Facebook App ID</label></th>
                    <td><input type="text" name="facebook_app_id" id="facebook_app_id"
                            value="<?php echo esc_attr($current_settings[0]); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="facebook_app_secret">Facebook App Secret</label></th>
                    <td><input type="text" name="facebook_app_secret" id="facebook_app_secret"
                            value="<?php echo esc_attr($current_settings[1]); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="facebook_redirect_uri">Redirect URI</label></th>
                    <td><input type="text" name="facebook_redirect_uri" id="facebook_redirect_uri"
                            value="<?php echo esc_attr($current_settings[2]); ?>" class="regular-text"><br>
                        <small>Use: <?php echo esc_url(home_url('/?facebook_oauth_callback=1')); ?></small>
                    </td>
                </tr>
            </table>
            <?php submit_button('Save Facebook Settings'); ?>
        </form>
    </div>
    <?php
}

// Check if the user is logged in and redirect
add_action('wp', 'add_login_check');
function add_login_check()
{
    if (easy_get_login_uri() && easy_get_register_uri()) {
        if (is_user_logged_in()) {
            $get_login_url = get_option('login_url');
            $register_url = get_option('register_url');
            if ($get_login_url & $register_url) {
                if (is_page($get_login_url) || is_page($register_url)) {
                    $after_login_redirect = get_option('after_login_redirect');
                    if ($after_login_redirect) {
                        wp_redirect($after_login_redirect);
                        exit;
                    } else {
                        wp_redirect(get_home_url());
                        exit;
                    }
                }
            }
        }
    }
    if (!is_user_logged_in()) {
        if (class_exists('WooCommerce')) {
            $dashboard_url = get_option('woocommerce_myaccount_page_id');
            if ($dashboard_url && is_page($dashboard_url)) {
                wp_redirect(easy_get_login_uri());
                exit;
            }
        } else {
            $dashboard_url = get_option('dashboard_url');
            if ($dashboard_url && is_page($dashboard_url)) {
                wp_redirect(easy_get_login_uri());
                exit;
            }
        }
    }
}

function the_slug_exists($post_name)
{
    global $wpdb;
    if ($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $post_name . "'", 'ARRAY_A')) {
        return true;
    } else {
        return false;
    }
}

$register_url = get_option('register_url');
$get_login_url = get_option('login_url');

if (easy_get_register_uri() && the_slug_exists($register_url)) {
    if ($GLOBALS['pagenow'] === 'wp-login.php' && !empty($_REQUEST['action']) && $_REQUEST['action'] === 'register') {
        header('Location: ' . easy_get_register_uri());
    }
}

if (easy_get_login_uri() && the_slug_exists($get_login_url)) {
    if ($GLOBALS['pagenow'] === 'wp-login.php' && $_GET['action'] != "logout" && $_GET['action'] != "lostpassword" && $_GET['action'] != "rp") {
        $get_login_url = get_option('login_url');
        $full_uri = home_url($get_login_url);
        header('Location: ' . easy_get_login_uri());
    }
}

// Plugins setting link
function easy_login_links($plugin_actions, $plugin_file)
{
    $new_actions = array();
    if (basename(plugin_dir_path(__FILE__)) . '/easy-reg-login.php' === $plugin_file) {
        $new_actions['cl_settings'] = sprintf(__('<a href="%s">Settings</a>', 'comment-limiter'), esc_url(admin_url('admin.php?page=easy-login-register')));
    }
    return array_merge($new_actions, $plugin_actions);
}
add_filter('plugin_action_links', 'easy_login_links', 10, 2);

function notify_new_user($user_id)
{
    $user = get_userdata($user_id);
    $subject = '[website] Connection details';
    $mail_from = get_bloginfo('admin_email');
    $mail_to = $user->user_email;
    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $mail_from,
    );

    $key = get_password_reset_key($user);
    if (is_wp_error($key)) {
        return;
    }
    $url_password = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login));

    $body = '<p>HTML body in your own style.</p>';
    $body .= '<p>It must include the login identifier: ' . $user->user_login . '</p>';
    $body .= '<p>And the link: ' . $url_password . '</p>';

    wp_mail($mail_to, $subject, $body, $headers);
}

function custom_plugin_check_admin_notice()
{
    if (!function_exists('EasyMedia')) {
        echo '<div class="notice notice-error"><p>';
        echo 'EasyMedia plugin is not installed. Please download and install it using the following <a href="https://github.com/arifmanzoor11/easy-media-uploader/archive/refs/heads/master.zip">link</a><br>';
        echo 'Then activate the plugin from the WordPress admin panel.';
        echo '</p></div>';
    }
}
add_action('admin_notices', 'custom_plugin_check_admin_notice');
