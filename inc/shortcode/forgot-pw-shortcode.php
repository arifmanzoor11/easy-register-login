<?php

add_shortcode('forgot_pw_shortcode', 'forgot_pw_shortcode');

function forgot_pw_shortcode()
{
    if (is_user_logged_in()) {
        if (!headers_sent()) {
            wp_redirect(esc_url(home_url()));
            exit;
        }
    }

    $user_login = isset($_POST['user_login']) ? sanitize_email($_POST['user_login']) : '';
    
    ob_start(); // Start output buffering to prevent premature output

    ?>

    <div id="page-content">
        <?php
        $form_output = '<form method="post" action="' . esc_url(get_permalink()) . '">' .
            '<p>Your Email Address</p>' .
            '<input class="esylogin-input" type="email" name="user_login" id="user_login" value="' . esc_attr($user_login) . '" placeholder="johndoe@email.com" required />' .
            '<input type="hidden" name="action" value="reset" /><br>' .
            '<input type="submit" value="Get New Password" class="esylogin-btn" id="submit" />' .
            '</form>';

        if (isset($_GET['ref']) && $_GET['ref'] === "magicfail") {
            echo '<label for="user_login"><h3>Link Expired</h3><p>Request a new link below...</p></label>' . $form_output;
        } elseif (isset($_POST['action']) && $_POST['action'] === 'reset') {
            $user_magic_email = trim($user_login);

            if (empty($user_magic_email)) {
                $error_message = 'Please enter an email address to reset your password.';
            } elseif (!is_email($user_magic_email)) {
                $error_message = 'Invalid email address.';
            } elseif (!email_exists($user_magic_email)) {
                $error_message = 'That email address is not in our system.';
            } else {
                $success_message = '<h3>Check your inbox!</h3><p>You should receive an email from us soon...</p>';

                $magic_link_id = wp_generate_password(20, false);
                $user = get_user_by('email', $user_magic_email);
                $user_id = $user->ID;

                update_user_meta($user_id, 'magic_link_id', $magic_link_id);
                $magic_link_url = esc_url(home_url('/?magic=' . $magic_link_id . '&id=' . $user_id));

                $to = $user_magic_email;
                $subject = 'Magic Link Request';
                $body = 'Here is your magic link to login: <a href="' . $magic_link_url . '">' . $magic_link_url . '</a>';
                $headers = array('Content-Type: text/html; charset=UTF-8');

                wp_mail($to, $subject, $body, $headers);
            }

            if (isset($error_message)) {
                echo '<label for="user_login"> ' . esc_html($error_message) . '</label>' . $form_output;
            } elseif (isset($success_message)) {
                echo '<label for="user_login">' . $success_message . '</label>';
            }
        } else {
            ?>
            <label for="user_login">
                <p><?php echo stripslashes(wpautop(get_option('esyforgot_content'))); ?></p>
            </label>
            <?php
            echo $form_output;
        }
        ?>
    </div>

    <?php

    return ob_get_clean(); // End output buffering and return content
}
