<?php get_header() ?>
<?php $get_login_url = get_option('login_url');
$get_dashboard_url = get_option('dashboard_url');
$get_easy_block_size = get_option('easy_block_size');
$reg_with_gmail_pass = get_option('reg_with_gmail_pass', true);

if (!defined('ABSPATH'))
    exit; ?>
<?php if (!is_user_logged_in()) {
    $redirect_to = home_url($get_login_url); ?>
<div class="easy_login">
    <div class="easy_container_fluid">
        <div class="easy_row">
            <div class="<?php echo $get_easy_block_size; ?>">

                <div class="box_container">
                <?php $esyregister_content = stripslashes(wpautop(get_option('esyregister_content')));
                    if ($esyregister_content) {
                        echo $esyregister_content;
                    } ?>
                    <form method="POST" id="reg-form">
                        <!-- <h3>Don't have an account?<br /> Create one now.</h3> -->
                        <div class="easy_row">
                            <div class="easy_column-6">
                                <p><label>First Name</label></p>
                                <p><input class="esylogin-input" type="text" value="" name="first_name" id="first_name" /></p>
                            </div>
                            <div class="easy_column-6">
                                <p><label>Last Name</label></p>
                                <p><input class="esylogin-input" type="text" value="" name="last_name" id="last_name" /></p>
                            </div>
                        </div>
                        <p><label>Email</label></p>
                        <p><input class="esylogin-input" type="text" value="" name="email" id="email" /></p>
                        <p><label>Username</label></p>
                        <p><input class="esylogin-input" type="text" value="" name="username" id="username" /></p>
                        <?php if ($reg_with_gmail_pass == 'on') {  ?>
                        <div class="easy_row">
                            <div class="easy_column-6">
                                <p><label>Password</label></p>
                                <p><input class="esylogin-input" type="password" value="" name="password1" id="password1" /></p>
                            </div>
                            <div class="easy_column-6">
                                <p><label>Password again</label></p>
                                <p><input class="esylogin-input" type="password" value="" name="password2" id="password2" /></p>
                            </div>
                        </div>
                        <?php } ?>
                        <a href="<?php echo easy_get_forgot_pass_uri(); ?>" style="float:right"
                            class="forgot-btn">Forgot Password?</a>
            
                        <button type="submit" name="btnregister" class="esylogin-btn">Create an account now</button>
                        <input type="hidden" name="task" value="register" />

                        <p style="text-align:center">Already have an account?
                            <a class="log-in-btn" href="<?php echo easy_get_login_uri()?>"> Log In</a>
                        </p>
                    </form>
                </div>
            </div>
            <?php add_sideSection() ?>
        </div>
    </div>
</div>

<?php } ?>
<?php get_footer() ?>