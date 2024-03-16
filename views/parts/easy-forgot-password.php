<?php
if(is_user_logged_in()){ 
	wp_redirect( esc_url( home_url() ) );
    exit;
}
$get_easy_block_size = get_option('easy_block_size');

get_header(); ?>
<div class="easy_login">
    <div class="easy_container_fluid">
        <div class="easy_row">
            <div class="<?php echo $get_easy_block_size; ?>">

                <div class="box_container">
                    <?php
            $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : '';
            $form_output = '<form method="post" action="'.get_permalink().'">'.
            '<p>Your Email Address</p>'.
            '<input class="esylogin-input" type="text" name="user_login" id="user_login" value="'.$user_login.'" placeholder="johndoe@email.com" />'.
            '<input type="hidden" name="action" value="reset" /><br>'.
            '<input type="submit" value="Get New Password" class="esylogin-btn" id="submit" />'.
            '<a class="register-btn" href="'. easy_get_register_uri() .'">Register</a> | <a class="log-in-btn" href="'. easy_get_login_uri() .'">Log In</a> '.
        '</form>';

    //PAGE CONTENT START
    echo '<div id="page-content">';

    //CHECK IF MAGIC LINK EXPIRED...
    if (isset($_GET['ref']) && "magicfail" == $_GET['ref']) { 

        //EXPIRED MESSAGE OUTPUT
        echo '<label for="user_login"><h3>Link Expired</h3><p>Request a new link below...</p></label>'.$form_output;

    //CHECK IF FORM SUBMITTED (action == reset)
    } else if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] ) {

        //VAR SETUP...
        $user_magic_email = trim($user_login);
		 
		//EMAIL EMPTY ERROR
		if( empty( $user_magic_email ) ) {
			 
            $error_message = 'Please enter an email address to reset your password...';
		 
        //INVALID EMAIL ERROR
        } else if( !is_email( $user_magic_email )) {
			 
            $error_message = 'Invalid e-mail address.';
		 
        //NO USER FOUND
        } else if( !email_exists( $user_magic_email ) ) {
			 
            $error_message = 'That email address is not in our system.';
		 
        //NO ERRORS...
        } else {

            $success_message = '<h3>Check your inbox!</h3><p>You should receive an email from us soon...</p>';
 
	    //CREATE MAGIC_LINK_ID
	    $magic_link_id = wp_generate_password(20);
			
	    //GET USER ID 
	    $user = get_user_by( 'email', $user_magic_email );
	    $user_id = $user->ID;
			
	    //ATTACH MAGIC_LINK_ID TO USER_META
	    update_user_meta($user_id, 'magic_link_id', $magic_link_id);
			
	    //CREATE A MAGIC_LINK_URL
	    $magic_link_url = home_url() . '/?magic=' . $magic_link_id . '&id=' . $user_id;
			
	    $to = 'sendto@example.com';
	    $subject = 'Magic Link Request';
	    $body = 'Here is your magic link to login:'.$magic_link_url;
	    $headers = array('Content-Type: text/html; charset=UTF-8');
			
	    wp_mail( $to, $subject, $body, $headers );

        } 

        //ERROR MESSAGE OUTPUT 
        if( isset( $error_message ) ) { 

            echo '<label for="user_login"> '. $error_message .'</label>'.$form_output; 

        //SUCCESS MESSAGE OUTPUT 
        } else if( isset( $success_message ) ) { 

            echo '<label for="user_login">'. $success_message .'</label>'; 

        }

    //DEFAULT OUTPUT... 
    } else { ?>
    <label for="user_login">
        <p><?php echo stripslashes(wpautop(get_option(('esyforgot_content')))); ?></p>
    </label>
        <?php echo $form_output; ?>
    <?php }

    echo '</div>'; ?>
                </div>
            </div>
            <?php add_sideSection() ?>
        </div>
    </div>
</div>
<?php


get_footer();