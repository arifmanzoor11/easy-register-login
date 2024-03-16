<?php get_header() ?>
<?php $get_login_url = get_option('login_url'); ?>
<?php if (!is_user_logged_in()) {
    $redirect_to = home_url($get_login_url); ?>
<?php } else { ?>
<div class="easy-text-center margin-users">
    <?php $image_id = get_option('easy_login_dashboard_img'); ?>

    <?php if( intval( $image_id ) > 0 ) {
                        // Change with the image size you want to use
                        $image = wp_get_attachment_image( $image_id, 'full', false, array( 'id' => 'dashboard-img' ) );
                    } else {
                        // Some default image
                        $image = '<img id="myprefix-preview-image" style="display:none;" src="<?php echo plugin_dir_url(__FILE__); ?>/../../../img/dashboard-img.webp"
    /><br>';
    }
    echo $image; ?>
    <style>
    #dashboard-img {
        width: 500px;
    }
    </style>
    <?php $current_user = wp_get_current_user(); ?>
    <h5 class="">
        <?php echo getTimeNow(); ?>:
        <?php echo $current_user->user_login ?>
    </h5>
    <h5>Your Email Address:
        <?php echo $current_user->user_email ?>
    </h5>
    <?php echo stripslashes(get_option('esydashboard_content')); ?>
    <a class="logout-btn" href="<?php echo wp_logout_url(home_url($get_login_url)); ?>">Logout</a> <br>
    <!-- <?php //print_r($current_user); ?> -->
</div>
<?php } ?>
<?php get_footer() ?>