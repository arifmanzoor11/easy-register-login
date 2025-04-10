<?php 
add_action('wp_ajax_nopriv_register_user', 'register_user');
function register_user() {
$error= ''; $success = '';
$reg_with_gmail_pass = get_option('reg_with_gmail_pass', true);

global $wpdb, $PasswordHash, $current_user, $user_ID;
if(isset($_POST['task']) && $_POST['task'] == 'register' ) {
    if ($reg_with_gmail_pass == 'on') {
        $password1 = $wpdb->escape(trim($_POST['password1']));
        $password2 = $wpdb->escape(trim($_POST['password2']));
    }
    
    $first_name = $wpdb->escape(trim($_POST['first_name']));
    $last_name = $wpdb->escape(trim($_POST['last_name']));
    $email = $wpdb->escape(trim($_POST['email']));
    $username = $wpdb->escape(trim($_POST['username']));
    $phone = $wpdb->escape(trim($_POST['phone'])); // Capture phone number
    
    if ($email == "" || $username == "" || $first_name == "" || $last_name == "" || $phone == "") {
        echo json_encode(array('Code' => '150', 'Value' => 'Please don\'t leave the required fields.'));
        exit;
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array('Code' => '150', 'Value' => 'Invalid email address.'));
        exit;
    } else if(email_exists($email) ) {
        echo json_encode(array('Code' => '150', 'Value' => 'Email already exist.'));
        exit;
    } 
    else if($password1 <> $password2 ){
        echo json_encode(array('Code' => '150', 'Value' => 'Password do not match.'));
        exit;
    } 
    
    else {
        if ($reg_with_gmail_pass == 'on') { 
           $user_details = array (
                'first_name' => apply_filters('pre_user_first_name', $first_name), 
                'last_name' => apply_filters('pre_user_last_name', $last_name),  
                'user_pass' => apply_filters('pre_user_user_pass', $password1), 
                'user_login' => apply_filters('pre_user_user_login', $username), 
                'user_email' => apply_filters('pre_user_user_email', $email), 
                'role' => 'subscriber' );
        } else {
            $user_details = array (
                'first_name' => apply_filters('pre_user_first_name', $first_name), 
                'last_name' => apply_filters('pre_user_last_name', $last_name),  
                'user_login' => apply_filters('pre_user_user_login', $username), 
                'user_email' => apply_filters('pre_user_user_email', $email), 
                'role' => 'subscriber' );
        }
        
        $user_id = wp_insert_user($user_details);
        if( is_wp_error($user_id) ) {
            echo json_encode(array('Code' => '150', 'Value' => 'Error on user creation.'));
            exit;
        } else {
            notify_new_user($user_id);
            do_action('user_register', $user_id);
            $user = get_userdata( $user_id );
            update_user_meta($user_id, 'phone_number', $phone); 
            echo json_encode(array('Code' => '200', 'Value' => 'You have successfully registered, and an email has been sent to '.  $user->user_email .''));
            
            exit;
        }
    }
}
wp_die();
}