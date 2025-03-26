<?php
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Check if the user has submitted the settings
if (isset($_POST['save_settings'])) {
    // Verify nonce for security
    if (!isset($_POST['custom_login_nonce']) || 
        !wp_verify_nonce($_POST['custom_login_nonce'], 'custom_login_settings_save')) {
        wp_die('Security check failed');
    }

    // Sanitize and save each option
    $options = [
        'login_url' => sanitize_text_field($_POST['login_url'] ?? ''),
        'register_url' => sanitize_text_field($_POST['register_url'] ?? ''),
        'forgot_pass_url' => sanitize_text_field($_POST['forgot_pass_url'] ?? ''),
        'after_login_redirect' => sanitize_text_field($_POST['after_login_redirect'] ?? ''),
        'dashboard_url' => sanitize_text_field($_POST['dashboard_url'] ?? ''),
        'reg_with_gmail_pass' => isset($_POST['reg_with_gmail_pass']) ? 'on' : 'off'
    ];

    // Save each non-empty option to WordPress options table
    foreach ($options as $key => $value) {
        // Skip empty values, except for checkbox
        if ($key === 'reg_with_gmail_pass' || ($value !== '' && $value !== null)) {
            update_option($key, $value);
        } else {
            // Delete the option if it's empty
            delete_option($key);
        }
    }

    // Add success message
    add_settings_error(
        'custom_login_settings', 
        'settings_updated', 
        'Settings saved successfully.', 
        'updated'
    );
}

// Retrieve current settings with additional checks
$login_url = get_option('login_url', '');
$register_url = get_option('register_url', '');
$forgot_pass_url = get_option('forgot_pass_url', '');
$after_login_redirect = get_option('after_login_redirect', '');
$dashboard_url = get_option('dashboard_url', '');
$reg_with_gmail_pass = get_option('reg_with_gmail_pass', '');

// Get all WordPress pages
$all_wp_pages = get_pages();
?>

<div class="wrap">
    <?php 
    // Display any error or success messages
    settings_errors('custom_login_settings'); 
    ?>

    <form method="post" action="">
        <?php 
        // Add nonce for security
        wp_nonce_field('custom_login_settings_save', 'custom_login_nonce'); 
        ?>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Login Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="login_url" class="js-example-basic-single" style="min-width: 200px">
                            <option value="">-- Select Login Page --</option>
                            <?php
                            foreach ($all_wp_pages as $page) { ?>
                                <option <?php echo ($login_url == $page->post_name) ? 'selected="selected"' : ''; ?>
                                    value="<?php echo esc_attr($page->post_name); ?>">
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php }; ?>
                        </select>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">
                        <label>Registration Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="register_url" class="js-example-basic-single" style="min-width: 200px">
                            <option value="">-- Select Registration Page --</option>
                            <?php
                            foreach ($all_wp_pages as $page) { ?>
                                <option <?php echo ($register_url == $page->post_name) ? 'selected="selected"' : ''; ?>
                                    value="<?php echo esc_attr($page->post_name); ?>">
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php }; ?>
                        </select>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">
                        <label>Forgot Password Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="forgot_pass_url" class="js-example-basic-single" style="min-width: 200px">
                            <option value="">-- Select Forgot Password Page --</option>
                            <?php
                            foreach ($all_wp_pages as $page) { ?>
                                <option <?php echo ($forgot_pass_url == $page->post_name) ? 'selected="selected"' : ''; ?>
                                    value="<?php echo esc_attr($page->post_name); ?>">
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php }; ?>
                        </select>
                    </td>
                </tr>
                
                <?php if (!class_exists('WooCommerce')) { ?>
                <tr valign="top">
                    <th scope="row">
                        <label>Dashboard Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="dashboard_url" class="js-example-basic-single" style="min-width: 200px">
                            <option value="">-- Select Dashboard Page --</option>
                            <?php
                            foreach ($all_wp_pages as $page) { ?>
                                <option <?php echo ($dashboard_url == $page->post_name) ? 'selected="selected"' : ''; ?>
                                    value="<?php echo esc_attr($page->post_name); ?>">
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php }; ?>
                        </select>
                    </td>
                </tr>
                <?php } ?>
                
                <tr valign="top">
                    <th scope="row">
                        <label>After Login Redirect to Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="after_login_redirect" class="js-example-basic-single" style="min-width: 200px">
                            <option value="">-- Select Redirect Page --</option>
                            <?php
                            foreach ($all_wp_pages as $page) { ?>
                                <option <?php echo ($after_login_redirect == $page->post_name) ? 'selected="selected"' : ''; ?>
                                    value="<?php echo esc_attr($page->post_name); ?>">
                                    <?php echo esc_html($page->post_title); ?>
                                </option>
                            <?php }; ?>
                        </select>
                        <br>
                        <small>If no value is selected, it will redirect to the Dashboard page.</small>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">
                        <label>Register with Password / Disable Google Auth</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="checkbox" name="reg_with_gmail_pass" 
                               <?php echo ($reg_with_gmail_pass == 'on') ? 'checked' : ''; ?>>
                        <small>This will hide the password on the registration page and send an authentication email.</small><br>
                        <small style="color:red">Ensure your emails are working before activating.</small>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="submit">
            <input type="submit" name="save_settings" class="button-primary" 
                   value="<?php esc_attr_e('Save Changes'); ?>" />
        </p>
    </form>
</div>