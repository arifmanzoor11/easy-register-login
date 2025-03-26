<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['easy_login_submit'])) {

    // Sanitize inputs
    $login_url = esc_url_raw($_POST['login_url']);
    $register_url = esc_url_raw($_POST['register_url']);
    $dashboard_url = esc_url_raw($_POST['dashboard_url']);
    $forgot_pass_url = esc_url_raw($_POST['forgot_pass_url']);
    $easy_register_url_primary = esc_url_raw($_POST['easy_register_url_primary']);
    $easy_use_login_shortcode = sanitize_text_field($_POST['easy_use_login_shortcode']);
    $easy_bg_color_1 = sanitize_text_field($_POST['easy_bg_color_1']);
    $easy_bg_color_2 = sanitize_text_field($_POST['easy_bg_color_2']);
    $easy_login_bg_angle = sanitize_text_field($_POST['easy_login_bg_angle']);
    $easy_block_size = sanitize_text_field($_POST['easy_block_size']);
    $after_login_redirect = esc_url_raw($_POST['after_login_redirect']);
    $easy_login_sideimg = esc_url_raw($_POST['easy_login_sideimg']);
    $easy_login_dashboard_img = esc_url_raw($_POST['easy_login_dashboard_img']);
    $esyregister_content = wp_kses_post($_POST['esyregister_content']);
    $esylogin_content = wp_kses_post($_POST['esylogin_content']);
    $esyforgot_content = wp_kses_post($_POST['esyforgot_content']);
    $esydashboard_content = wp_kses_post($_POST['esydashboard_content']);
    $reg_with_gmail_pass = sanitize_text_field($_POST['reg_with_gmail_pass']);

    // Input Settings (Serialized Array)
    $esylogin_input = serialize(array_map('sanitize_text_field', [
        $_POST['esylogin_input_bgcolor'], $_POST['esylogin_input_border_radius'], 
        $_POST['esylogin_input_pdding'], $_POST['esylogin_input_bordewidth'], 
        $_POST['esylogin_input_bordercolor'], $_POST['esylogin_input_borderstyle'], 
        $_POST['esylogin_input_fontsize'], $_POST['esylogin_input_color'], 
        $_POST['esylogin_input_width']
    ]));

    // Button Settings (Serialized Array)
    $esylogin_btn = serialize(array_map('sanitize_text_field', [
        $_POST['esylogin_btn_bgcolor'], $_POST['esylogin_btn_border_radius'], 
        $_POST['esylogin_btn_pdding'], $_POST['esylogin_btn_bordewidth'], 
        $_POST['esylogin_btn_bordercolor'], $_POST['esylogin_btn_borderstyle'], 
        $_POST['esylogin_btn_fontsize'], $_POST['esylogin_btn_color'], 
        $_POST['esylogin_btn_width'], $_POST['esylogin_btn_margin'], 
        $_POST['esylogin_btn_bghvrcolor']
    ]));

    // Menu Button Settings (Serialized Array)
    $esylogin_menu_btn = serialize(array_map('sanitize_text_field', [
        $_POST['easy_login_btn_text'], $_POST['easy_login_btn_text_enable'], 
        $_POST['easy_reg_btn_text'], $_POST['easy_reg_btn_text_enable'], 
        $_POST['easy_dashboard_btn_text']
    ]));

    // Update options in a batch
    $options = [
        'login_url' => $login_url,
        'register_url' => $register_url,
        'dashboard_url' => $dashboard_url,
        'forgot_pass_url' => $forgot_pass_url,
        'easy_register_url_primary' => $easy_register_url_primary,
        'easy_use_login_shortcode' => $easy_use_login_shortcode,
        'easy_bg_color_1' => $easy_bg_color_1,
        'easy_bg_color_2' => $easy_bg_color_2,
        'easy_login_bg_angle' => $easy_login_bg_angle,
        'easy_block_size' => $easy_block_size,
        'after_login_redirect' => $after_login_redirect,
        'easy_login_sideimg' => $easy_login_sideimg,
        'easy_login_dashboard_img' => $easy_login_dashboard_img,
        'esyregister_content' => $esyregister_content,
        'esylogin_content' => $esylogin_content,
        'esyforgot_content' => $esyforgot_content,
        'esydashboard_content' => $esydashboard_content,
        'esylogin_input' => $esylogin_input,
        'esylogin_btn' => $esylogin_btn,
        'esylogin_menu_btn' => $esylogin_menu_btn,
        'reg_with_gmail_pass' => $reg_with_gmail_pass,
    ];

    foreach ($options as $key => $value) {
        update_option($key, $value);
    }
}

// Retrieve options
$get_options = [
    'login_url', 'register_url', 'dashboard_url', 'forgot_pass_url',
    'easy_register_url_primary', 'easy_use_login_shortcode', 'easy_bg_color_1',
    'easy_bg_color_2', 'easy_login_bg_angle', 'easy_block_size', 'after_login_redirect',
    'easy_login_sideimg', 'easy_login_dashboard_img', 'esyregister_content', 
    'esylogin_content', 'esyforgot_content', 'esydashboard_content', 'esylogin_input',
    'esylogin_btn', 'esylogin_menu_btn', 'reg_with_gmail_pass'
];

foreach ($get_options as $option) {
    ${"get_$option"} = get_option($option);
}

// Unserialize values
$esylogin_output_input = unserialize($get_esylogin_input);
$esylogin_output_btn = unserialize($get_esylogin_btn);
$esylogin_menu_btn = unserialize($get_esylogin_menu_btn);
?>
