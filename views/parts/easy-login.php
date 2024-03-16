<?php get_header() ?>
<?php if (!is_user_logged_in()) {
     $redirect_to = easy_get_after_login_redirect_uri();
    $get_easy_block_size = get_option('easy_block_size'); ?>
<div class="easy_login">
    <div class="easy_container_fluid">
        <div class="easy_row">
            <div class="<?php echo $get_easy_block_size; ?>">
                <div class="box_container">
                <?php $esylogin_content = stripslashes(wpautop(get_option('esylogin_content')));
                    if ($esylogin_content) {
                        echo $esylogin_content;
                    } ?>
                    <p>Doesn't have an account yet? 
                        <a class="register-btn" href="<?php echo easy_get_register_uri(); ?>">Register Now</a>
                    </p>
                    <?php echo custom_login_form(); ?>
                </div>
            </div>
            <?php add_sideSection() ?>
        </div>
    </div>
</div>
<?php } ?>
<?php get_footer() ?>