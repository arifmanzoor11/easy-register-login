<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Handle form submission
if (isset($_POST['save_settings'])) {
    // Verify nonce
    if (!isset($_POST['esylogin_nonce']) || !wp_verify_nonce($_POST['esylogin_nonce'], 'esylogin_settings_save')) {
        wp_die('Security check failed');
    }

    // Sanitize and save options
    $options = [
        'esylogin_input_bgcolor' => sanitize_text_field($_POST['esylogin_input_bgcolor'] ?? ''),
        'esylogin_input_border_radius' => sanitize_text_field($_POST['esylogin_input_border_radius'] ?? ''),
        'esylogin_input_padding' => sanitize_text_field($_POST['esylogin_input_padding'] ?? ''),
        'esylogin_input_border_width' => sanitize_text_field($_POST['esylogin_input_border_width'] ?? ''),
        'esylogin_input_bordercolor' => sanitize_text_field($_POST['esylogin_input_bordercolor'] ?? ''),
        'esylogin_input_borderstyle' => sanitize_text_field($_POST['esylogin_input_borderstyle'] ?? ''),
        'esylogin_input_fontsize' => sanitize_text_field($_POST['esylogin_input_fontsize'] ?? ''),
        'esylogin_input_color' => sanitize_text_field($_POST['esylogin_input_color'] ?? ''),
        'esylogin_input_width' => sanitize_text_field($_POST['esylogin_input_width'] ?? ''),
    ];

    // Store options
    foreach ($options as $key => $value) {
        update_option($key, $value);
    }

    // Success message
    add_settings_error('esylogin_settings', 'settings_updated', 'Settings saved successfully.', 'updated');
}

// Retrieve settings
$esylogin_output_input = [
    get_option('esylogin_input_bgcolor', ''),
    get_option('esylogin_input_border_radius', ''),
    get_option('esylogin_input_padding', ''),
    get_option('esylogin_input_border_width', ''),
    get_option('esylogin_input_bordercolor', ''),
    get_option('esylogin_input_borderstyle', ''),
    get_option('esylogin_input_fontsize', ''),
    get_option('esylogin_input_color', ''),
    get_option('esylogin_input_width', ''),
];

?>

<div class="wrap">
    <?php settings_errors('esylogin_settings'); ?>

    <form method="post">
        <?php wp_nonce_field('esylogin_settings_save', 'esylogin_nonce'); ?>
        <h3>Input Settings</h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label>Background color</label></th>
                    <td><input type="text" name="esylogin_input_bgcolor" value="<?php echo esc_attr($esylogin_output_input[0]); ?>" class="easy-loginreg-colorpick" data-default-color="#4363c5" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Border Radius</label></th>
                    <td><input type="text" name="esylogin_input_border_radius" value="<?php echo esc_attr($esylogin_output_input[1]); ?>" placeholder="0px" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Padding</label></th>
                    <td><input type="text" name="esylogin_input_padding" value="<?php echo esc_attr($esylogin_output_input[2]); ?>" placeholder="1.5rem 1.8rem" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Border Width</label></th>
                    <td><input type="text" name="esylogin_input_border_width" value="<?php echo esc_attr($esylogin_output_input[3]); ?>" placeholder="1px" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Border color</label></th>
                    <td><input type="text" name="esylogin_input_bordercolor" value="<?php echo esc_attr($esylogin_output_input[4]); ?>" class="easy-loginreg-colorpick" data-default-color="#eee" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Border Style</label></th>
                    <td>
                        <select name="esylogin_input_borderstyle" style="min-width: 200px">
                            <?php 
                            $styles = ['none', 'solid', 'dotted', 'dashed', 'double', 'ridge', 'groove'];
                            foreach ($styles as $style) {
                                echo '<option value="'. esc_attr($style) .'" '. selected($esylogin_output_input[5], $style, false) .'>'. ucfirst($style) .'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Font Size</label></th>
                    <td><input type="text" name="esylogin_input_fontsize" value="<?php echo esc_attr($esylogin_output_input[6]); ?>" placeholder="1.6rem" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Color</label></th>
                    <td><input type="text" name="esylogin_input_color" value="<?php echo esc_attr($esylogin_output_input[7]); ?>" class="easy-loginreg-colorpick" data-default-color="#eee" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label>Width</label></th>
                    <td>
                        <select name="esylogin_input_width" style="min-width: 200px">
                            <?php 
                            $widths = ['100%', '80%', '60%', '40%', '20%'];
                            foreach ($widths as $width) {
                                echo '<option value="'. esc_attr($width) .'" '. selected($esylogin_output_input[8], $width, false) .'>Width '. $width .'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <p><input type="submit" name="save_settings" class="button-primary" value="Save Settings"></p>
    </form>
</div>
