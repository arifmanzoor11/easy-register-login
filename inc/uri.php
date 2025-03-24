<?php
 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// plugin uri's 
function easy_get_login_uri() {
    $get_login_url = get_option('login_url');
    if (empty($get_login_url)) {
        return;
    }
    if ($get_login_url) {
        $login_uri = home_url($get_login_url);
    }
    return $login_uri;
}
function easy_get_register_uri() {
    $register_url = get_option('register_url');
    if (empty($register_url)) {
        return;
    }
    if ($register_url) {
        $register_uri = home_url($register_url);
    }
    return $register_uri;
}

function easy_get_forgot_pass_uri() {
    $forgot_pass_url = get_option('forgot_pass_url');
    if ($forgot_pass_url) {
        $forgot_pass_uri = home_url($forgot_pass_url);
    }
    return $forgot_pass_uri;
}

function easy_get_after_login_redirect_uri() {   
    $after_login_redirect = get_option('after_login_redirect');
    if ($after_login_redirect) {
        $after_login_redirect_uri = home_url($after_login_redirect);
    }
    return $after_login_redirect_uri;
}


function easy_get_dashboard_uri() {
    if(is_user_logged_in()){
        if ( class_exists( 'WooCommerce' ) ) {
                $dashboard_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
                if ($dashboard_url) {
                    $dashboard_uri = $dashboard_url;
                }
            }
       else {
                $dashboard_url = home_url(get_option('dashboard_url'));
                if ($dashboard_url) {
                    $dashboard_uri = $dashboard_url;
            }
        } 
        return $dashboard_uri;
    } 
}

add_filter( 'lostpassword_url',  'wdm_lostpassword_url', 100, 0 );
function wdm_lostpassword_url() {
    return easy_get_forgot_pass_uri();
}