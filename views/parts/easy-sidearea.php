<?php $get_easy_block_size = get_option('easy_block_size'); 
$get_easy_login_sideimg = get_option('easy_login_sideimg');

$img = wp_get_attachment_image( $get_easy_login_sideimg, 'full', false, array( 'id' => 'myprefix-preview-image' ) );
if ($get_easy_block_size == "easy_column-12") { }
else{ ?>
<div class="easy_column right-section">
    <?php if ($img): ?>
        <?php echo $img ?>
    <?php else: ?>
    <img src="<?php echo $dir ?>../../side-img.jpg" alt="">
    <?php endif ?>
</div>
<?php }