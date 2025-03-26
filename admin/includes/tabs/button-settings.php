<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_esylogin_settings'])) {
    $btn_settings = [
        'esylogin_btn_bgcolor', 'esylogin_btn_border_radius', 'esylogin_btn_padding',
        'esylogin_btn_border_width', 'esylogin_btn_bordercolor', 'esylogin_btn_borderstyle',
        'esylogin_btn_fontsize', 'esylogin_btn_color', 'esylogin_btn_width',
        'esylogin_btn_margin', 'esylogin_btn_bghvrcolor', 'esylogin_btn_fontweight'
    ];
    
    foreach ($btn_settings as $setting) {
        if (isset($_POST[$setting])) {
            update_option($setting, sanitize_text_field($_POST[$setting]));
        }
    }
}

$esylogin_output_btn = [
    get_option('esylogin_btn_bgcolor', '#4363c5'),
    get_option('esylogin_btn_border_radius', '0px'),
    get_option('esylogin_btn_padding', ''),
    get_option('esylogin_btn_border_width', '1px'),
    get_option('esylogin_btn_bordercolor', '#eee'),
    get_option('esylogin_btn_borderstyle', 'solid'),
    get_option('esylogin_btn_fontsize', '1.6rem'),
    get_option('esylogin_btn_color', '#fff'),
    get_option('esylogin_btn_width', '100%'),
    get_option('esylogin_btn_margin', ''),
    get_option('esylogin_btn_bghvrcolor', '#4363c5'),
    get_option('esylogin_btn_fontweight', '400') // Default font weight
];
?>

<form method="post">
    <h3>Button Settings</h3>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row"><label>Background color</label></th>
                <td><input type="text" name="esylogin_btn_bgcolor" value="<?php echo esc_attr($esylogin_output_btn[0]); ?>" class="easy-loginreg-colorpick" data-default-color="#4363c5" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Font Weight</label></th>
                <td>
                    <select name="esylogin_btn_fontweight">
                        <?php
                        $font_weights = ['100', '200', '300', '400', '500', '600', '700', '800', '900'];
                        foreach ($font_weights as $weight) {
                            echo '<option value="' . esc_attr($weight) . '" ' . selected($esylogin_output_btn[11], $weight, false) . '>' . $weight . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><label>Border Radius</label></th>
                <td><input type="text" name="esylogin_btn_border_radius" value="<?php echo esc_attr($esylogin_output_btn[1]); ?>" placeholder="0px" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Padding</label></th>
                <td><input type="text" name="esylogin_btn_padding" value="<?php echo esc_attr($esylogin_output_btn[2]); ?>" placeholder="1.5rem 1.8rem" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Border Width</label></th>
                <td><input type="text" name="esylogin_btn_border_width" value="<?php echo esc_attr($esylogin_output_btn[3]); ?>" placeholder="1px" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Border color</label></th>
                <td><input type="text" name="esylogin_btn_bordercolor" value="<?php echo esc_attr($esylogin_output_btn[4]); ?>" class="easy-loginreg-colorpick" data-default-color="#eee" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Border Style</label></th>
                <td>
                    <select name="esylogin_btn_borderstyle">
                        <?php
                        $border_styles = ['none', 'solid', 'dotted', 'dashed', 'double', 'ridge', 'groove'];
                        foreach ($border_styles as $style) {
                            echo '<option value="' . esc_attr($style) . '" ' . selected($esylogin_output_btn[5], $style, false) . '>' . ucfirst($style) . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Font Size</label></th>
                <td><input type="text" name="esylogin_btn_fontsize" value="<?php echo esc_attr($esylogin_output_btn[6]); ?>" placeholder="1.6rem" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Color</label></th>
                <td><input type="text" name="esylogin_btn_color" value="<?php echo esc_attr($esylogin_output_btn[7]); ?>" class="easy-loginreg-colorpick" data-default-color="#000" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Width</label></th>
                <td><input type="text" name="esylogin_btn_width" value="<?php echo esc_attr($esylogin_output_btn[8]); ?>" placeholder="100%" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Margin</label></th>
                <td><input type="text" name="esylogin_btn_margin" value="<?php echo esc_attr($esylogin_output_btn[9]); ?>" placeholder="1.5rem 1.8rem" /></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label>Background Hover color</label></th>
                <td><input type="text" name="esylogin_btn_bghvrcolor" value="<?php echo esc_attr($esylogin_output_btn[10]); ?>" class="easy-loginreg-colorpick" data-default-color="#4363c5" /></td>
            </tr>
        </tbody>
    </table>
    <p><input type="submit" name="save_esylogin_settings" value="Save Settings" class="button button-primary" /></p>
</form>