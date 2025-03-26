<?php 
//include __DIR__ . '/includes/esy-login-isset.php';

$my_wp_query = new WP_Query();
$all_wp_pages = $my_wp_query->query([
    'post_type' => 'page',
    'posts_per_page' => -1
]);

// Get the active tab from the URL, default to 'general'
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';

// Define available tabs
$tabs = [
    'general' => 'General',
    'dropdown' => 'DropDown',
    'style' => 'Style',
    'input' => 'Input',
    'button' => 'Button',
    'image-select' => "Image's",
    'page-content' => 'Content',
    'shortcode' => 'Use Shortcode',
    'text' => 'Menu Buttons'
];
?>

<h2><?php _e('Easy Login and Register Settings'); ?></h2>
<p>You can select the login and register page from here.</p>

<!-- Tabs Navigation -->
<div class="esylogin_tab">
    <?php foreach ($tabs as $key => $label) : ?>
        <a class="esylogin_links <?php echo ($active_tab === $key) ? 'active' : ''; ?>" 
           href="?page=<?php echo $_GET['page']; ?>&tab=<?php echo $key; ?>">
            <?php echo $label; ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Tab Content -->
<div class="esylogin_contenttext">
    <?php $tab_file = __DIR__ . "/includes/tabs/{$active_tab}-settings.php";
    
    if (file_exists($tab_file)) {
       
include $tab_file;

    } else {
        echo "<p>Select a tab to view settings.</p>";
    }
    ?>
</div>
