<?php 
add_action('wp_ajax_nopriv_register_user', 'register_user');

function register_user() {
$error= ''; $success = '';
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
    
    if( $email == "" || $username == "" || $first_name == "" || $last_name == "") {
        $error= 'Please don\'t leave the required fields.';
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error= 'Invalid email address.';
    } else if(email_exists($email) ) {
        $error= 'Email already exist.';
    } 
    else if($password1 <> $password2 ){
        $error= 'Password do not match.';		
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
            $error= 'Error on user creation.';
        } else {
            do_action('user_register', $user_id);
            notify_new_user($user_id);
            $success = 'You\'re successfully register';
        }
    }
}

    
}