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
        'easy_register_url_primary' => sanitize_hex_color($_POST['easy_register_url_primary'] ?? ''),
        'easy_bg_color_1' => sanitize_hex_color($_POST['easy_bg_color_1'] ?? ''),
        'easy_bg_color_2' => sanitize_hex_color($_POST['easy_bg_color_2'] ?? ''),
        'easy_login_bg_angle' => absint($_POST['easy_login_bg_angle'] ?? 0),
        'easy_block_size' => sanitize_text_field($_POST['easy_block_size'] ?? ''),
    ];

    // Save each option to the WordPress options table
    foreach ($options as $key => $value) {
        update_option($key, $value);
    }

    // Add success message
    add_settings_error(
        'custom_login_settings', 
        'settings_updated', 
        'Settings saved successfully.', 
        'updated'
    );
}

// Retrieve current settings
$easy_register_url_primary = get_option('easy_register_url_primary', '#cd2653');
$easy_bg_color_1 = get_option('easy_bg_color_1', '#c54393');
$easy_bg_color_2 = get_option('easy_bg_color_2', '#4363c5');
$easy_login_bg_angle = get_option('easy_login_bg_angle', 0);
$easy_block_size = get_option('easy_block_size', 'easy_column-12');
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <?php settings_errors('custom_login_settings'); ?>

    <form method="post" action="">
        <?php wp_nonce_field('custom_login_settings_save', 'custom_login_nonce'); ?>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label>Primary Color</label></th>
                    <td>
                        <input type="text" name="easy_register_url_primary" value="<?php echo esc_attr($easy_register_url_primary); ?>" class="easy-loginreg-colorpick" data-default-color="#cd2653" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>BG Gradient Color 1</label></th>
                    <td>
                        <input type="text" name="easy_bg_color_1" value="<?php echo esc_attr($easy_bg_color_1); ?>" class="easy-loginreg-colorpick" data-default-color="#c54393" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>BG Gradient Color 2</label></th>
                    <td>
                        <input type="text" name="easy_bg_color_2" value="<?php echo esc_attr($easy_bg_color_2); ?>" class="easy-loginreg-colorpick" data-default-color="#4363c5" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>BG Gradient Angle</label></th>
                    <td>
                        <input type="number" name="easy_login_bg_angle" value="<?php echo esc_attr($easy_login_bg_angle); ?>" min="0" max="359" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Block Size</label></th>
                    <td>
                        <select name="easy_block_size">
                            <?php
                            $sizes = [
                                'easy_column-12' => '100% Width',
                                'easy_column-11' => '91.6% Width',
                                'easy_column-10' => '83.3% Width',
                                'easy_column-9' => '75% Width',
                                'easy_column-8' => '66.6% Width',
                                'easy_column-7' => '58.3% Width',
                                'easy_column-6' => '50% Width',
                                'easy_column-5' => '41.6% Width',
                                'easy_column-4' => '33.3% Width',
                                'easy_column-3' => '25% Width',
                                'easy_column-2' => '16.6% Width',
                                'easy_column-1' => '8.3% Width'
                            ];
                            foreach ($sizes as $key => $label) {
                                $selected = ($easy_block_size == $key) ? 'selected="selected"' : '';
                                echo "<option value='" . esc_attr($key) . "' $selected>" . esc_html($label) . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p class="submit">
            <input type="submit" name="save_settings" class="button-primary" value="Save Settings" />
        </p>
    </form>
</div>
