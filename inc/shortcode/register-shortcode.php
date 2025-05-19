<?php
add_shortcode('register_shortcode', 'register_shortcode');

function register_shortcode()
{
    if (!defined('ABSPATH'))
        exit;

    $get_login_url = get_option('login_url');
    $reg_with_gmail_pass = get_option('reg_with_gmail_pass', true);

    if (!is_user_logged_in()) {
        $redirect_to = home_url($get_login_url);
        $esyregister_content = stripslashes(wpautop(get_option('esyregister_content')));

        if ($esyregister_content) {
            echo $esyregister_content;
        }
        ?>

        <form method="POST" id="reg-form">
        <h3 class="register-form-heading">Create an account</h3>
            <div class="easy_row">
                <div class="easy_column-6">
                    <p><label for="first_name">First Name</label></p>
                    <p><input class="esylogin-input" type="text" name="first_name" id="first_name" /></p>
                </div>
                <div class="easy_column-6">
                    <p><label for="last_name">Last Name</label></p>
                    <p><input class="esylogin-input" type="text" name="last_name" id="last_name" /></p>
                </div>
            </div>

            <p><label for="email">Email</label></p>
            <p><input class="esylogin-input" type="email" name="email" id="email" required /></p>

            <p><label for="phone">Phone Number</label></p>
            <p><input class="esylogin-input" type="tel" name="phone" id="phone" pattern="[0-9]+" required /></p>

            <p><label for="username">Username</label></p>
            <p><input class="esylogin-input" type="text" name="username" id="username" required /></p>

            <?php if ($reg_with_gmail_pass == 'on') { ?>
                <div class="easy_row">
                    <div class="easy_column-6">
                        <p><label for="password1">Password</label></p>
                        <p><input class="esylogin-input" type="password" name="password1" id="password1" required /></p>
                    </div>
                    <div class="easy_column-6">
                        <p><label for="password2">Confirm Password</label></p>
                        <p><input class="esylogin-input" type="password" name="password2" id="password2" required /></p>
                    </div>
                </div>
            <?php } ?>

            <button type="submit" name="btnregister" class="esyregister-btn">
            <img style="display:none; width:20px"  class="loading-img" alt="" src="<?php echo plugin_assets_url() . 'img/loading.gif' ?>">    
            Create an Account Now</button>
            <input type="hidden" name="task" value="register" />
        </form>
        <?php
    }
}
?>