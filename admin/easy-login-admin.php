<?php 
include __DIR__ . '/includes/esy-login-isset.php';

$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query(
    array(
        'post_type' => 'page',
        'posts_per_page' => -1
    )
);
?>
<form action="" method="POST" style="margin-top:40px">
    <h2>
        <?php _e('Easy Login and Register Settings'); ?>
    </h2>
    <p>You can select the login and register page from here.</p>

    <div class="esylogin_tab">
        <a class="esylogin_links active" onclick="esyLogin(event, 'general')">General</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'style')">Style</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'dropdown')">DropDown</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'input')">Input</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'button')">Button</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'image-select')">Image's</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'page-content')">Content</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'shortcode')">Use Shortcode</a>
        <a class="esylogin_links" onclick="esyLogin(event, 'text')">Menu Buttons</a>
    </div>

    <!-- Genral -->
    <div id="general" class="esylogin_content" style="display:block!important;">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Login Page</span></label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="login_url" class="js-example-basic-single" style="min-width: 200px">
                            <?php
                            foreach ($all_wp_pages as $value) {
                                $post = get_post($value);
                                $title = $post->post_title;
                                $id = $post->post_name;?>
                                <option <?php echo ($get_login_url == $id) ? 'selected="selected"' : ''; ?>
                                    value="<?php echo $id ?>"><?php echo $title ?></option>
                                <?php }; ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>register_url Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="register_url" class="js-example-basic-single" style="min-width: 200px">
                            <?php
                        foreach ($all_wp_pages as $value) {
                            $post = get_post($value);
                            $title = $post->post_title;
                            $id = $post->post_name; ?>
                            <option <?php echo ($get_register_url == $id) ? 'selected="selected"' : ''; ?>
                                value="<?php echo $id ?>"><?php echo $title ?></option>
                            <?php }; ?>
                        </select>
                        <?php ?>
                    </td>
                </tr>

                <?php
                global $wp;
                $request = explode( '/', $wp->request );
                if ( class_exists( 'WooCommerce' ) ) {
                
                if( ! ( end($request) == 'my-account' && is_account_page() ) ){ ?>
                <tr valign="top">
                    <th scope="row">
                        <label>Woocomerce dashboard</label>
                    </th>
                    <td class="forminp forminp-text">
                        <?php if ( get_option('woocommerce_myaccount_page_id')) { ?>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id')); ?>">
                            Dashboard</a>
                        <?php } else{ ?>
                        <a href="admin.php?page=wc-settings&tab=advanced">Select my account page</a>
                        <?php }  ?>

                    </td>
                </tr>
                <?php  } }
                else{ ?>
                <tr valign="top">
                    <th scope="row">
                        <label>Dashboard Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="dashboard_url" class="js-example-basic-single" style="min-width: 200px">
                            <?php
                        foreach ($all_wp_pages as $value) {
                            $post = get_post($value);
                            $title = $post->post_title;
                            $id = $post->post_name;
                            ?>
                            <option <?php echo ($get_dashboard_url == $id) ? 'selected="selected"' : ''; ?>
                                value="<?php echo $id ?>"><?php echo $title ?></option>
                            <?php }; ?>
                        </select>
                        <?php ?>
                    </td>
                </tr>
                <?php } ?>


                <tr valign="top">
                    <th scope="row">
                        <label>Forgot Password Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="forgot_pass_url" class="js-example-basic-single" style="min-width: 200px">
                            <?php
                        foreach ($all_wp_pages as $value) {
                            $post = get_post($value);
                            $title = $post->post_title;
                            $id = $post->post_name;?>
                            <option <?php echo ($get_forgot_pass_url == $id) ? 'selected="selected"' : ''; ?>
                                value="<?php echo $id ?>"><?php echo $title ?></option>
                            <?php }; ?>
                        </select>
                        <?php ?>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label>After Loign redirect to Page</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="after_login_redirect" style="min-width: 200px">
                            <?php foreach ($all_wp_pages as $value) {
                            $post = get_post($value);
                            $title = $post->post_title;
                            $id = $post->post_name;?>
                            <option <?php echo ($get_after_login_redirect == $id) ? 'selected="selected"' : ''; ?>
                                value="<?php echo $id ?>"><?php echo $title ?></option>
                            <?php }; ?>
                        </select>
                        <br>
                        <small>If the value is not select it will redirect to Dashbaord page.</small>
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Register with Password / Disable Google Auth</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="checkbox" name="reg_with_gmail_pass" <?php echo ($reg_with_gmail_pass == 'on') ? 'checked' : '' ; ?> >
                        <small>This will hide the password on the registration page and will subsequently send an email to the user's email address for authentication.</small><br>
                        <small style="color:red">Before activating this functionality, please ensure that your emails are working.</small>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>


    <div id="dropdown" class="esylogin_content">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>DropDown Pages</label>
                    </th>
                    <td class="forminp forminp-text">
                    <div id="row">
                        <div style=" display: flex; gap: 5px;">
                            <div id="append_menu">
                            <select name="dropdown_menu_" class="append_menu_select" style="min-width: 200px;">
                                <?php
                                foreach ($all_wp_pages as $value) {
                                    $post = get_post($value);
                                    $title = $post->post_title;
                                    $id = $post->post_name;?>
                                    <option <?php echo ($get_login_url == $id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $id ?>"><?php echo $title ?></option>
                                    <?php }; ?>
                            </select>

                            </div>
                        </div>
                    </div>
                    <div id="newinput"></div>
                    <br>
                    
                    <button id="rowAdder" type="button" class="button-primary woocommerce-save-button">
                        <span class="bi bi-plus-square-dotted">
                        </span> ADD
                    </button>
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
    <!-- Style Setting -->
    <div id="style" class="esylogin_content">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Primary Color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" <?php if ($get_easy_register_url_primary): ?>
                            value="<?php echo $get_easy_register_url_primary; ?>" <?php endif ?>
                            name="easy_register_url_primary" class="my-color-field" data-default-color="#cd2653" />
                        <?php ?>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label>BG Gradient Color 1</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" <?php if ($get_easy_bg_color_1): ?>
                            value="<?php echo $get_easy_bg_color_1; ?>" <?php endif ?> name="easy_bg_color_1"
                            class="my-color-field" data-default-color="#c54393" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>BG Gradient Color 2</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" <?php if ($get_easy_bg_color_2): ?>
                            value="<?php echo $get_easy_bg_color_2; ?>" <?php endif ?> name="easy_bg_color_2"
                            class="my-color-field" data-default-color="#4363c5" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>BG Gradient Angle</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="number" <?php if ($get_easy_login_bg_angle) { ?>
                            value="<?php echo $get_easy_login_bg_angle; ?>" <?php } ?> min="0" max="359"
                            name="easy_login_bg_angle" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Block Size</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="easy_block_size" style="min-width: 200px">>
                            <option value="easy_column-12"
                                <?php echo ($get_easy_block_size == 'easy_column-12') ? 'selected="selected"' : ''; ?>>
                                100% Width</option>
                            <option value="easy_column-11"
                                <?php echo ($get_easy_block_size == 'easy_column-11') ? 'selected="selected"' : ''; ?>>
                                91.6%
                                Width</option>
                            <option value="easy_column-10"
                                <?php echo ($get_easy_block_size == 'easy_column-10') ? 'selected="selected"' : ''; ?>>
                                83.3%
                                Width</option>
                            <option value="easy_column-9"
                                <?php echo ($get_easy_block_size == 'easy_column-9') ? 'selected="selected"' : ''; ?>>
                                75%
                                Width
                            </option>
                            <option value="easy_column-8"
                                <?php echo ($get_easy_block_size == 'easy_column-8') ? 'selected="selected"' : ''; ?>>
                                66.6%
                                Width
                            </option>
                            <option value="easy_column-7"
                                <?php echo ($get_easy_block_size == 'easy_column-7') ? 'selected="selected"' : ''; ?>>
                                58.3%
                                Width
                            </option>
                            <option value="easy_column-6"
                                <?php echo ($get_easy_block_size == 'easy_column-6') ? 'selected="selected"' : ''; ?>>
                                50%
                                Width
                            </option>
                            <option value="easy_column-5"
                                <?php echo ($get_easy_block_size == 'easy_column-5') ? 'selected="selected"' : ''; ?>>
                                41.6%
                                Width
                            </option>
                            <option value="easy_column-4"
                                <?php echo ($get_easy_block_size == 'easy_column-4') ? 'selected="selected"' : ''; ?>>
                                33.3%
                                Width
                            </option>
                            <option value="easy_column-3"
                                <?php echo ($get_easy_block_size == 'easy_column-3') ? 'selected="selected"' : ''; ?>>
                                25%
                                Width
                            </option>
                            <option value="easy_column-2"
                                <?php echo ($get_easy_block_size == 'easy_column-2') ? 'selected="selected"' : ''; ?>>
                                16.6%
                                Width
                            </option>
                            <option value="easy_column-1"
                                <?php echo ($get_easy_block_size == 'easy_column-1') ? 'selected="selected"' : ''; ?>>
                                8.3%
                                Width
                            </option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Input Setting -->
    <div id="input" class="esylogin_content">
        <br>
        <h3>Input Settings</h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Background color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" name="esylogin_input_bgcolor" value="<?php echo $esylogin_output_input[0]; ?>" name="esylogin_input_bgcolor"
                            class="my-color-field" data-default-color="#4363c5" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Border Radius</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" placeholder="0px" min="0" value="<?php echo $esylogin_output_input[1]; ?>" max="359"
                            name="esylogin_input_border_radius" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Padding</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_output_input[2]; ?>"  name="esylogin_input_pdding" placeholder="1.5rem 1.8rem" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Border Width</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_output_input[3]; ?>" name="esylogin_input_bordewidth" placeholder=" 1px" />
                        <?php ?>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">
                        <label>Border color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input name="esylogin_input_bordercolor" value="<?php echo $esylogin_output_input[4]; ?>" type="text" name="esylogin_input_bordercolor"
                            class="my-color-field" data-default-color="#eee" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Border Style</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="esylogin_input_borderstyle" style="min-width: 200px">>
                                <option value="none"
                                    <?php echo ( $esylogin_output_input[5] == 'none') ? 'selected="selected"' : ''; ?>>
                                    None</option>
                                <option value="solid"
                                    <?php echo ( $esylogin_output_input[5] == 'solid') ? 'selected="selected"' : ''; ?>>
                                    Solid</option>
                                <option value="dotted"
                                    <?php echo ( $esylogin_output_input[5] == 'dotted') ? 'selected="selected"' : ''; ?>>
                                    Dotted</option>
                                    <option value="solid"
                                    <?php echo ( $esylogin_output_input[5] == 'dashed') ? 'selected="selected"' : ''; ?>>
                                    Dashed</option>
                                    <option value="double"
                                    <?php echo ( $esylogin_output_input[5] == 'double') ? 'selected="selected"' : ''; ?>>
                                    Double</option>
                                    <option value="ridge"
                                    <?php echo ( $esylogin_output_input[5]  == 'ridge') ? 'selected="selected"' : ''; ?>>
                                    Ridge</option>
                                    <option value="groove"
                                    <?php echo ( $esylogin_output_input[5] == 'groove') ? 'selected="selected"' : ''; ?>>
                                    Groove</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Font Size</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_output_input[6]; ?>" placeholder="1.6rem" name="esylogin_input_fontsize"/>
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input name="esylogin_input_color" value="<?php echo $esylogin_output_input[7]; ?>" type="text"
                            class="my-color-field" data-default-color="#eee" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Width</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="esylogin_input_width" style="min-width: 200px">>
                                <option value="100%"
                                    <?php echo ( $esylogin_output_input[8] == '100%') ? 'selected="selected"' : ''; ?>>
                                    Width 100%</option>
                                <option value="80%"
                                    <?php echo ( $esylogin_output_input[8] == '80%') ? 'selected="selected"' : ''; ?>>
                                    Width 80%</option>
                                <option value="60%"
                                    <?php echo ( $esylogin_output_input[8] == '60%') ? 'selected="selected"' : ''; ?>>
                                    Width 60%</option>
                                <option value="40%"
                                    <?php echo ( $esylogin_output_input[8] == '40%') ? 'selected="selected"' : ''; ?>>
                                    Width 40%</option>
                                <option value="20%"
                                    <?php echo ( $esylogin_output_input[8] == '20%') ? 'selected="selected"' : ''; ?>>
                                    Width 20%</option>   
                        </select>
                    </td>
                </tr>
           
            </tbody>
        </table>
    </div>

     <!-- Input Setting -->
     <div id="button" class="esylogin_content">
        <br>
        <h3>Button Settings</h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Background color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" name="esylogin_btn_bgcolor" value="<?php echo $esylogin_output_btn[0]; ?>" 
                        name="esylogin_input_bgcolor" class="my-color-field" data-default-color="#4363c5" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Border Radius</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" placeholder="0px" min="0" value="<?php echo $esylogin_output_btn[1]; ?>" max="359"
                            name="esylogin_btn_border_radius" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Padding</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_output_btn[2]; ?>"  
                        name="esylogin_btn_pdding" placeholder="1.5rem 1.8rem" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Border Width</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_output_btn[3]; ?>"
                         name="esylogin_btn_bordewidth" placeholder=" 1px" />
                        <?php ?>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">
                        <label>Border color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input name="esylogin_btn_bordercolor" value="<?php echo $esylogin_output_btn[4]; ?>" 
                        type="text" name="esylogin_input_bordercolor" class="my-color-field" data-default-color="#eee" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Border Style</label>
                    </th>
                    <td class="forminp forminp-text">
                        <select name="esylogin_btn_borderstyle" style="min-width: 200px">>
                                <option value="none"
                                    <?php echo ( $esylogin_output_btn[5] == 'none') ? 'selected="selected"' : ''; ?>>
                                    None</option>
                                <option value="solid"
                                    <?php echo ( $esylogin_output_btn[5] == 'solid') ? 'selected="selected"' : ''; ?>>
                                    Solid</option>
                                <option value="dotted"
                                    <?php echo ( $esylogin_output_btn[5] == 'dotted') ? 'selected="selected"' : ''; ?>>
                                    Dotted</option>
                                    <option value="solid"
                                    <?php echo ( $esylogin_output_btn[5] == 'dashed') ? 'selected="selected"' : ''; ?>>
                                    Dashed</option>
                                    <option value="double"
                                    <?php echo ( $esylogin_output_btn[5] == 'double') ? 'selected="selected"' : ''; ?>>
                                    Double</option>
                                    <option value="ridge"
                                    <?php echo ( $esylogin_output_btn[5]  == 'ridge') ? 'selected="selected"' : ''; ?>>
                                    Ridge</option>
                                    <option value="groove"
                                    <?php echo ( $esylogin_output_btn[5] == 'groove') ? 'selected="selected"' : ''; ?>>
                                    Groove</option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Font Size</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_output_btn[6]; ?>" 
                        placeholder="1.6rem" name="esylogin_btn_fontsize"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input name="esylogin_btn_color" value="<?php echo $esylogin_output_btn[7]; ?>" 
                        type="text" class="my-color-field" data-default-color="#eee" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Width</label>
                    </th>
                    <td class="forminp forminp-text">
                    <input type="text" value="<?php echo $esylogin_output_btn[8]; ?>" 
                        placeholder="100%" name="esylogin_btn_width"/>
                    </td>
                </tr>
                
                <tr valign="top">
                    <th scope="row">
                        <label>Margin</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_output_btn[9]; ?>"  
                        name="esylogin_btn_margin" placeholder="1.5rem 1.8rem" />
                        <?php ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Background Hover color</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" name="esylogin_btn_bghvrcolor" value="<?php echo $esylogin_output_btn[10]; ?>" 
                        name="esylogin_btn_bghvrcolor" class="my-color-field" data-default-color="#4363c5" />
                        <?php ?>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- Image select  -->
    <div id="image-select" class="esylogin_content">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Side Image</label>
                    </th>
                    <td class="forminp forminp-text">
                        
                    <?php echo EasyMedia("easy_login_sideimg"); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Dashboard Image</label>
                    </th>
                    <td class="forminp forminp-text">
                        <?php echo EasyMedia("easy_login_dashboard_img"); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Text Form  -->
    <div id="page-content" class="esylogin_content">
        <table class="form-table">
            <tbody>

                <div style="width:80%">
                    <h4>Registration Form</h4>
                    <?php 
                    $content = stripslashes(get_option('esyregister_content'));
                    
                    $custom_editor_id = "esyregister_content";
                    $custom_editor_name = "esyregister_content";
                    $args = array(
                            'media_buttons' => true, // This setting removes the media button.
                            'textarea_name' => $custom_editor_name, // Set custom name.
                            'textarea_rows' => get_option('esyregister_content', 10), //Determine the number of rows.
                            'quicktags' => true, // Remove view as HTML button.
                        );
                    wp_editor( $content, $custom_editor_id, $args ); ?>
                </div>

                <div style="width:80%">
                    <h4>LogIn Form</h4>
                    <?php 
                    $content = stripslashes(get_option('esylogin_content'));
                    $custom_editor_id = "esylogin_content";
                    $custom_editor_name = "esylogin_content";
                    $args = array(
                            'media_buttons' => true, // This setting removes the media button.
                            'textarea_name' => $custom_editor_name, // Set custom name.
                            'textarea_rows' => get_option('esylogin_content', 10), //Determine the number of rows.
                            'quicktags' => true, // Remove view as HTML button.
                        );
                    wp_editor( $content, $custom_editor_id, $args ); ?>
                </div>

                <div style="width:80%">
                    <h4>Forgot Password Form</h4>
                    <?php 
                    $content = stripslashes(get_option('esyforgot_content'));
                    $custom_editor_id = "esyforgot_content";
                    $custom_editor_name = "esyforgot_content";
                    $args = array(
                            'media_buttons' => true, // This setting removes the media button.
                            'textarea_name' => $custom_editor_name, // Set custom name.
                            'textarea_rows' => get_option('esyforgot_content', 10), //Determine the number of rows.
                            'quicktags' => true, // Remove view as HTML button.
                        );
                    wp_editor( $content, $custom_editor_id, $args ); ?>
                </div>
                <?php  if ( !class_exists( 'WooCommerce' ) )  { ?>
                    <div style="width:80%">
                    <h4>Dashboard Page</h4>
                    <?php 
                    $content = stripslashes(get_option('esydashboard_content'));
                    $custom_editor_id = "esydashboard_content";
                    $custom_editor_name = "esydashboard_content";
                    $args = array(
                            'media_buttons' => true, // This setting removes the media button.
                            'textarea_name' => $custom_editor_name, // Set custom name.
                            'textarea_rows' => get_option('esydashboard_content', 10), //Determine the number of rows.
                            'quicktags' => true, // Remove view as HTML button.
                        );
                    wp_editor( $content, $custom_editor_id, $args ); ?>
                </div>
               <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Shortcode  -->
    <div id="shortcode" class="esylogin_content">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Use Shortcode</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="checkbox" id="myCheck" <?php if($get_easy_use_login_shortcode){ ?> checked
                            <?php } ?> value="true" name="easy_use_login_shortcode" onclick="showDiv()" />
                        <?php ?>
                        <br>
                        <br>
                        <div id="welcomeDiv"
                            style="display:<?php if($get_easy_use_login_shortcode){ ?> block <?php } else{ ?> none <?php } ?>;"
                            class="answer_list"> <code>[easy_login_btn]</code></div>
                    </td>

                    <script>
                    function showDiv() {
                        var checkBox = document.getElementById("myCheck");
                        var text = document.getElementById("welcomeDiv");
                        if (checkBox.checked == true) {
                            text.style.display = "block";
                        } else {
                            text.style.display = "none";
                        }
                    }
                    </script>
                </tr>
                

            </tbody>
        </table>
    </div>

    <!-- Text  -->
    <div id="text" class="esylogin_content">
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Log In Button</label>
                    </th>
                    <td class="forminp forminp-text">
                    <input type="text" value="<?php echo $esylogin_menu_btn[0] ?>" placeholder="Log In" name="easy_login_btn_text"/>
                    <input <?php echo ($esylogin_menu_btn[1]) ? 'checked' : '' ; ?> type="checkbox"  name="easy_login_btn_text_enable"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Register Button</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_menu_btn[2] ?>" placeholder="Register" name="easy_reg_btn_text"/>
                        <input type="checkbox" <?php echo ($esylogin_menu_btn[3]) ? 'checked' : '' ; ?> name="easy_reg_btn_text_enable"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Dashboard Button</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" placeholder="Dashboard" value="<?php echo $esylogin_menu_btn[4] ?>" name="easy_dashboard_btn_text"/>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <p class="submit">
        <button name="easy_login_submit" class="button-primary woocommerce-save-button" 
        type="submit" value="Save changes">Save changes</button>

</form>
