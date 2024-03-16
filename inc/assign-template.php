<?php 
 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
function esylogin_page_template($page_template) {
    $get_login_url = get_option('login_url');
    $register_url = get_option('register_url');
    $dashboard_url = get_option('dashboard_url');
    $forgot_pass_url = get_option('forgot_pass_url');
    
    if ($get_login_url) {
        if (is_page($get_login_url)) {
          $page_template = WP_PLUGIN_DIR . '/easy-register-login/views/parts/easy-login.php'; 
        }
    }
    if ($register_url) {
        if (is_page($register_url)) {
            $page_template = WP_PLUGIN_DIR . '/easy-register-login/views/parts/easy-register.php';
        }
    }

    if ( !class_exists( 'WooCommerce' ) ) {
        if ($dashboard_url) {
            if (is_page($dashboard_url)) {
                $page_template = WP_PLUGIN_DIR . '/easy-register-login/views/parts/easy-dashboard.php';
            }
        }
    }
    if ($forgot_pass_url) {
        if (is_page($forgot_pass_url)) {
            $page_template = WP_PLUGIN_DIR . '/easy-register-login/views/parts/easy-forgot-password.php';
        }
    }
        return $page_template;
}
add_filter('page_template', 'esylogin_page_template');