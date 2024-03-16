<?php 
if (isset($_POST['easy_login_submit'])) {

    $login_url = $_POST['login_url'];
    $register_url = $_POST['register_url'];
    $dashboard_url = $_POST['dashboard_url'];
    $forgot_pass_url = $_POST['forgot_pass_url'];
    $easy_register_url_primary = $_POST['easy_register_url_primary'];
    $easy_use_login_shortcode = $_POST['easy_use_login_shortcode'];
    $easy_bg_color_1 = $_POST['easy_bg_color_1'];
    $easy_bg_color_2 = $_POST['easy_bg_color_2'];
    $easy_login_bg_angle = $_POST['easy_login_bg_angle'];
    $easy_block_size = $_POST['easy_block_size'];
    $after_login_redirect = $_POST['after_login_redirect'];
    $easy_login_sideimg = $_POST['easy_login_sideimg'];
    $easy_login_dashboard_img = $_POST['easy_login_dashboard_img'];
    $esyregister_content = $_POST['esyregister_content'];
    $esylogin_content = $_POST['esylogin_content'];
    $esyforgot_content = $_POST['esyforgot_content'];
    $esydashboard_content = $_POST['esydashboard_content'];
    $reg_with_gmail_pass = $_POST['reg_with_gmail_pass'];

    // Input Setting serialized and in array
    $esylogin_input = serialize(array($_POST['esylogin_input_bgcolor'],
    $_POST['esylogin_input_border_radius'], $_POST['esylogin_input_pdding'], $_POST['esylogin_input_bordewidth'], 
    $_POST['esylogin_input_bordercolor'], $_POST['esylogin_input_borderstyle'], $_POST['esylogin_input_fontsize'],
    $_POST['esylogin_input_color'], $_POST['esylogin_input_width']));
    
    // Button Setting serialized and in array
    $esylogin_btn = serialize(array($_POST['esylogin_btn_bgcolor'],
    $_POST['esylogin_btn_border_radius'], $_POST['esylogin_btn_pdding'], $_POST['esylogin_btn_bordewidth'], 
    $_POST['esylogin_btn_bordercolor'], $_POST['esylogin_btn_borderstyle'], $_POST['esylogin_btn_fontsize'],
    $_POST['esylogin_btn_color'], $_POST['esylogin_btn_width'], $_POST['esylogin_btn_margin'], $_POST['esylogin_btn_bghvrcolor']));
    
       // Menu Btn Setting serialized and in array
    $esylogin_menu_btn = serialize(array($_POST['easy_login_btn_text'],$_POST['easy_login_btn_text_enable'], 
    $_POST['easy_reg_btn_text'],$_POST['easy_reg_btn_text_enable'],$_POST['easy_dashboard_btn_text']));


    // $data = sanitize_text_field( $_POST['breadcrumb_delimiter'] ); 
        update_option('login_url', $login_url);
        update_option('register_url', $register_url);
        update_option('dashboard_url', $dashboard_url);
        update_option('forgot_pass_url', $forgot_pass_url);
        update_option('easy_register_url_primary', $easy_register_url_primary);
        update_option('easy_use_login_shortcode', $easy_use_login_shortcode);
        update_option('easy_bg_color_1', $easy_bg_color_1);
        update_option('easy_bg_color_2', $easy_bg_color_2);
        update_option('easy_login_bg_angle', $easy_login_bg_angle);
        update_option('easy_block_size', $easy_block_size);
        update_option('after_login_redirect', $after_login_redirect);
        update_option('easy_login_sideimg', $easy_login_sideimg);
        update_option('easy_login_dashboard_img', $easy_login_dashboard_img);
        update_option('esyregister_content', $esyregister_content);
        update_option('esylogin_content', $esylogin_content);
        update_option('esyforgot_content', $esyforgot_content);
        update_option('esydashboard_content', $esydashboard_content);

        update_option('esylogin_input', $esylogin_input);
        update_option('esylogin_btn', $esylogin_btn);

        update_option('esylogin_menu_btn', $esylogin_menu_btn);
        update_option('reg_with_gmail_pass', $reg_with_gmail_pass);

}
$get_login_url = get_option('login_url');
$get_register_url = get_option('register_url');
$get_dashboard_url = get_option('dashboard_url');
$get_easy_register_url_primary = get_option('easy_register_url_primary');
$get_easy_use_login_shortcode = get_option('easy_use_login_shortcode');
$get_easy_bg_color_1 = get_option('easy_bg_color_1');
$get_easy_bg_color_2 = get_option('easy_bg_color_2');
$get_forgot_pass_url = get_option('forgot_pass_url');
$get_easy_login_bg_angle = get_option('easy_login_bg_angle');
$get_easy_block_size = get_option('easy_block_size');
$get_after_login_redirect = get_option('after_login_redirect');
$get_easy_login_sideimg = get_option('easy_login_sideimg');
$get_easy_login_dashboard_img = get_option('easy_login_dashboard_img');
$get_esyregister_content = get_option('esyregister_content');

$esylogin_output_input = unserialize(get_option('esylogin_input'));
$esylogin_output_btn = unserialize(get_option('esylogin_btn'));

$esylogin_menu_btn = unserialize(get_option('esylogin_menu_btn'));
$reg_with_gmail_pass = get_option('reg_with_gmail_pass');