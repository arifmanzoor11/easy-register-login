<?php
 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
// Filter wp_nav_menu() to add additional links and other output
$get_easy_use_login_shortcode = get_option('easy_use_login_shortcode');
if ($get_easy_use_login_shortcode) {
    function easy_login_btn_func($items) {
         $esylogin_menu_btn = unserialize(get_option('esylogin_menu_btn'));
        if (is_user_logged_in() && easy_get_dashboard_uri()) {
            // ($esylogin_menu_btn[4]) ? $homelink = '<a href="' . easy_get_dashboard_uri() . '">' . __($esylogin_menu_btn[4]) . '</a>' : $homelink = '<a href="' . easy_get_dashboard_uri() . '">' . __('Dashboard') . '</a>' ;
            $homelink .= '<div class="profile">'
                . '<div class="user">'
                // . '<h3 style="text-transform:">' . $current_user->first_name .' '. $current_user->last_name . '</h3>'
                // . '<p>'. $current_user->user_login . '</p>'
                . '</div>'
                . '<div class="img-box">'
                . '<img src="' . esc_url( get_avatar_url( $current_user->ID ) ) . '" alt="some user image">'
                . '</div>'
                . '</div>'
                . '<div class="dropdownmenu" style="display:none">'
                . '<ul>'
                .  '<li><a href="' . get_edit_profile_url() . '"><i class="ph-bold ph-user"></i>&nbsp;Profile</a></li>'
                .  '<li><a href="'. wp_logout_url(home_url($get_login_url)) .'"><i class="ph-bold ph-sign-out"></i>&nbsp;Sign Out</a></li>'
                .  '</ul>'
                .  '</div>';    
        }
        if (!is_user_logged_in() && easy_get_login_uri()) {
           ($esylogin_menu_btn[1]) ? $homelink = '<a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __('Login') . '</a>' : '' ;
           ($esylogin_menu_btn[3]) ? $homelink = '<a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __('Register') . '</a>' : '' ;
           ($esylogin_menu_btn[3] && $esylogin_menu_btn[1]) ? $homelink = '<a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __('Login') . '</a><a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __('Register') . '</a>' : "" ;
    
           ($esylogin_menu_btn[0] && $esylogin_menu_btn[1]) ? $homelink = '<a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __($esylogin_menu_btn[0]) . '</a>' : '' ;
           ($esylogin_menu_btn[2] && $esylogin_menu_btn[3]) ? $homelink = '<a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __($esylogin_menu_btn[2]) . '</a>' : '' ;
           ($esylogin_menu_btn[0] && $esylogin_menu_btn[1] && $esylogin_menu_btn[2] && $esylogin_menu_btn[3]) ? $homelink = '<a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __($esylogin_menu_btn[0]) . '</a><a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __($esylogin_menu_btn[2]) . '</a>' : "" ;
        }
        // add the home link to the end of the menu
        $items = $items . $homelink;
        return $items;  
    }
    add_shortcode( 'easy_login_btn', 'easy_login_btn_func' );
} else {
    function new_nav_menu_items($items, $args)
    {
         global $current_user; wp_get_current_user(); 
            $esylogin_menu_btn = unserialize(get_option('esylogin_menu_btn'));
            $menuitems = "";
            $homelink = "";
            $get_login_url = get_option('login_url');

            // print_r($args);
            if (is_user_logged_in() && easy_get_dashboard_uri() && $args->theme_location == 'primary') {
                // ($esylogin_menu_btn[4]) ? $homelink = '<li class="home"><a href="' . easy_get_dashboard_uri() . '">' . __($esylogin_menu_btn[4]) . '</a></li>' : $homelink = '<li class="home"><a href="' . easy_get_dashboard_uri() . '">' . __('Dashboard') . '</a></li>' ;
                $homelink .= '<li class="menu-item">'
                . '<div class="profile">'
                . '<div class="user">'
                . '<h3 style="text-transform:">' . $current_user->first_name .' '. $current_user->last_name . '</h3>'
                . '<p>'. $current_user->user_login . '</p>'
                . '</div>'
                . '<div class="img-box">'
                . '<img src="' . esc_url( get_avatar_url( $current_user->ID ) ) . '" alt="some user image">'
                . '</div>'
                . '</div>'
                . '<div class="dropdownmenu" style="display:none">'
                . '<ul>'
                .  '<li><a href="/qr-nicole/create-dynamic-qr/"><i class="ph-bold ph-user"></i>&nbsp;Create Dynamic Qr</a></li>'
                .  '<li><a href="' . get_edit_profile_url() . '"><i class="ph-bold ph-user"></i>&nbsp;Profile</a></li>'
                .  '<li><a href="'. wp_logout_url(home_url($get_login_url)) .'"><i class="ph-bold ph-sign-out"></i>&nbsp;Sign Out</a></li>'
                .  '</ul>'
                .  '</div>'
                . '</li>';      
            }
            if (!is_user_logged_in() && easy_get_login_uri()) {
            ($esylogin_menu_btn[1]) ? $homelink = '<li class="home"><a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __('Login') . '</a></li>' : '' ;
            ($esylogin_menu_btn[3]) ? $homelink = '<li class="home-reg"><a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __('Register') . '</a></li>' : '' ;
            ($esylogin_menu_btn[3] && $esylogin_menu_btn[1]) ? $homelink = '<li class="home"><a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __('Login') . '</a></li><li class="home-reg"><a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __('Register') . '</a></li>' : "" ;
        
            ($esylogin_menu_btn[0] && $esylogin_menu_btn[1]) ? $homelink = '<li class="home"><a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __($esylogin_menu_btn[0]) . '</a></li>' : '' ;
            ($esylogin_menu_btn[2] && $esylogin_menu_btn[3]) ? $homelink = '<li class="home-reg"><a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __($esylogin_menu_btn[2]) . '</a></li>' : '' ;
            ($esylogin_menu_btn[0] && $esylogin_menu_btn[1] && $esylogin_menu_btn[2] && $esylogin_menu_btn[3]) ? $homelink = '<li class="home"><a class="easy-login-menu-btn" href="' . easy_get_login_uri() . '">' . __($esylogin_menu_btn[0]) . '</a></li><li class="home-reg"><a class="easy-register-menu-btn" href="' . easy_get_register_uri() . '">' . __($esylogin_menu_btn[2]) . '</a></li>' : "" ;
            }
            $items = $items . $homelink ;
            return $items;
    }
    add_filter('wp_nav_menu_items', 'new_nav_menu_items', 10, 2 );
}