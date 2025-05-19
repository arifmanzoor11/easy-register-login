<?php
add_shortcode('forgot_pw_shortcode', 'forgot_pw_shortcode');

function forgot_pw_shortcode()
{
    if (is_user_logged_in()) {
        if (!headers_sent()) {
            wp_redirect(home_url());
            exit;
        }
    }

    $user_login = isset($_POST['user_login']) ? sanitize_email($_POST['user_login']) : '';

    ob_start();
    ?>

    <div id="page-content">
        <?php
        $form_output = '<form method="post" action="' . esc_url(get_permalink()) . '">' .
            '<h3 class="fp-form-heading">Forgot Password</h3>' .
            '<p>Your Email Address</p>' .
            '<input class="esylogin-input" type="email" name="user_login" id="user_login" value="' . esc_attr($user_login) . '" placeholder="you@example.com" required />' .
            '<input type="submit" value="Send Link" class="esylogin-btn" />' .
            '</form>';

        if (isset($_GET['ref']) && $_GET['ref'] === "magicfail") {
            echo '<label for="user_login"><h3>Link Expired</h3><p>Request a new link below...</p></label>' . $form_output;
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($user_login)) {
            $user = get_user_by('email', $user_login);

            if (!$user) {
                echo '<label for="user_login">That email address is not in our system.</label>' . $form_output;
            } else {
                $user_id = $user->ID;
                $to = $user_login;
                $headers = array('Content-Type: text/html; charset=UTF-8');

                // 👇 This value overrides the frontend form selection
                $setting = get_option('magic_link_send_reset_link', 'off');

                if ($setting === 'on') {
                    // 🔗 Send Magic Link
                    $magic_link_id = wp_generate_password(20, false);
                    update_user_meta($user_id, 'magic_link_id', $magic_link_id);
                    $magic_link_url = home_url('/?magic=' . $magic_link_id . '&id=' . $user_id);

                    $subject = 'Your Magic Login Link';
                    $body = "<p>Click below to log in instantly (valid only once):</p>
                            <p><a href='$magic_link_url'>$magic_link_url</a></p>
                            <p>Link expires after first use.</p>";

                } else {
                    
                    $key = get_password_reset_key($user);

                    if (is_wp_error($key)) {
                        echo '<label for="user_login">Could not generate reset link. Try again later.</label>' . $form_output;
                        return ob_get_clean();
                    }

                    $reset_url = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login');

                    $subject = 'Reset Your Password';
                    $body = "<p>Hello,</p>
                            <p>You requested to reset your password. Click the link below to reset it:</p>
                            <p><a href='$reset_url'>$reset_url</a></p>
                            <p>If you did not request this, you can ignore this email.</p>";
                }

                wp_mail($to, $subject, $body, $headers);
                echo '<label for="user_login"><h3>Check your inbox!</h3><p>An email has been sent to ' . esc_html($user_login) . '</p></label>';
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
    return ob_get_clean();
}
