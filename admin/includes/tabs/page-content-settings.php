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