<?php 
add_action('wp_ajax_nopriv_register_user', 'register_user');
function register_user() {
    $error = ''; $success = '';
    $reg_with_gmail_pass = get_option('reg_with_gmail_pass', true);

    global $wpdb;

    if (isset($_POST['task']) && $_POST['task'] == 'register') {
        $password1 = $password2 = '';

        if ($reg_with_gmail_pass == 'on') {
            $password1 = trim($_POST['password1']);
            $password2 = trim($_POST['password2']);

            if (empty($password1) || empty($password2)) {
                // Generate a random password
                $password1 = $password2 = wp_generate_password(12, true);
                $generated_password = $password1;
            } elseif ($password1 !== $password2) {
                echo json_encode(array('Code' => '150', 'Value' => 'Passwords do not match.'));
                exit;
            }
        }

        $first_name = sanitize_text_field($_POST['first_name']);
        $last_name = sanitize_text_field($_POST['last_name']);
        $email = sanitize_email($_POST['email']);
        $username = sanitize_user($_POST['username']);
        $phone = sanitize_text_field($_POST['phone']);

        if ($email == "" || $username == "" || $first_name == "" || $last_name == "" || $phone == "") {
            echo json_encode(array('Code' => '150', 'Value' => 'Please don\'t leave the required fields.'));
            exit;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('Code' => '150', 'Value' => 'Invalid email address.'));
            exit;
        } elseif (email_exists($email)) {
            echo json_encode(array('Code' => '150', 'Value' => 'Email already exists.'));
            exit;
        }

        $user_details = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'user_login' => $username,
            'user_email' => $email,
            'role' => 'subscriber',
        );

        if ($reg_with_gmail_pass == 'on') {
            $user_details['user_pass'] = $password1;
        }

        $user_id = wp_insert_user($user_details);

        if (is_wp_error($user_id)) {
            echo json_encode(array('Code' => '150', 'Value' => 'Error on user creation.'));
            exit;
        } else {
            update_user_meta($user_id, 'phone_number', $phone);
            do_action('user_register', $user_id);
            notify_new_user($user_id);

            // Auto login the user

            // Add this as a feature 
            wp_clear_auth_cookie();
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);

            $response = array(
                'Code' => '200',
                'Value' => 'You have successfully registered and we are logging you in. please wait...',
                'email' => $email
            );

            if (!empty($generated_password)) {
                $response['password'] = $generated_password;
            }

            echo json_encode($response);
            exit;
        }
    }

    wp_die();
}
