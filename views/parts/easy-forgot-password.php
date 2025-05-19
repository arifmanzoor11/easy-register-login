<?php
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

$get_easy_block_size = get_option('easy_block_size');
get_header();
?>

<div class="easy_login">
    <div class="easy_container_fluid">
        <div class="easy_row">
            <div class="<?php echo esc_attr($get_easy_block_size); ?>">

                <div class="box_container">
                    <?php
                    $user_login = isset($_POST['user_login']) ? sanitize_email($_POST['user_login']) : '';
                    $form_output = '
                    <form method="post" action="' . esc_url(get_permalink()) . '">
                        <p>Your Email Address</p>
                        <input class="esylogin-input" type="email" name="user_login" id="user_login" value="' . esc_attr($user_login) . '" placeholder="johndoe@email.com" required />
                        <input type="hidden" name="action" value="reset" />
                        <br>
                        <input type="submit" value="Get New Password" class="esylogin-btn" id="submit" />
                        <a class="register-btn" href="' . esc_url(easy_get_register_uri()) . '">Register</a> | 
                        <a class="log-in-btn" href="' . esc_url(easy_get_login_uri()) . '">Log In</a>
                    </form>';

                    echo '<div id="page-content">';

                    if (isset($_GET['ref']) && $_GET['ref'] === 'magicfail') {
                        echo '<label for="user_login"><h3>Link Expired</h3><p>Request a new link below...</p></label>' . $form_output;

                    } elseif (isset($_POST['action']) && $_POST['action'] === 'reset') {
                        $user_magic_email = trim($user_login);
                        $setting = get_option('magic_link_send_reset_link', 'off'); // Get DB setting

                        if (empty($user_magic_email)) {
                            $error_message = 'Please enter an email address to reset your password.';
                        } elseif (!is_email($user_magic_email)) {
                            $error_message = 'Invalid email address.';
                        } elseif (!email_exists($user_magic_email)) {
                            $error_message = 'That email address is not in our system.';
                        } else {
                            $user = get_user_by('email', $user_magic_email);
                            $user_id = $user->ID;

                            if ($setting === 'on') {
                                // Custom Password Reset Link
                                $reset_key = get_password_reset_key($user);
                                $reset_url = network_site_url("wp-login.php?action=rp&key=$reset_key&login=" . rawurlencode($user->user_login), 'login');

                                $subject = 'Reset Your Password';
                                $body = "<p>Hello,</p>
                                    <p>You requested to reset your password. Click the link below to reset it:</p>
                                    <p><a href='$reset_url'>$reset_url</a></p>
                                    <p>If you did not request this, you can ignore this email.</p>";
                            } else {
                                // Magic Link
                                $magic_link_id = wp_generate_password(20);
                                update_user_meta($user_id, 'magic_link_id', $magic_link_id);

                                $magic_link_url = home_url("/?magic={$magic_link_id}&id={$user_id}");

                                $subject = 'Magic Link Request';
                                $body = "<p>Hello,</p>
                                    <p>You requested a magic link to log into your account.</p>
                                    <p><strong>Click the link below to log in instantly:</strong><br>
                                    <a href='$magic_link_url'>$magic_link_url</a></p>
                                    <p><strong>What does this link do?</strong><br>
                                    This one-time link logs you in automatically and expires shortly after use.</p>
                                    <p>If you did not request this, you can ignore this email.</p>";
                            }

                            $headers = ['Content-Type: text/html; charset=UTF-8'];
                            wp_mail($user_magic_email, $subject, $body, $headers);

                            $success_message = '<h3>Check your inbox!</h3><p>You should receive an email from us soon...</p>';
                        }

                        if (isset($error_message)) {
                            echo '<label for="user_login"><p>' . esc_html($error_message) . '</p></label>' . $form_output;
                        } elseif (isset($success_message)) {
                            echo '<label for="user_login">' . $success_message . '</label>';
                        }

                    } else {
                        ?>
                        <label for="user_login">
                            <p><?php echo wp_kses_post(wpautop(stripslashes(get_option('esyforgot_content')))); ?></p>
                        </label>
                        <?php echo $form_output;
                    }

                    echo '</div>'; // end #page-content
                    ?>
                </div>
            </div>
            <?php add_sideSection(); ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
