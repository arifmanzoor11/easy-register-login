<?php

function auth_documentation() {
    $current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'facebook';
    echo '<div class="wrap">';

    echo '<style>
        .tab { display: inline-block; padding: 10px 20px; cursor: pointer; border: 1px solid #ccc; background: #f1f1f1; }
        .tab.active { background: #fff; border-bottom: none; }
        .tab-content { display: none; padding: 10px; border: 1px solid #ccc; border-top: none; background: #fff; }
        .tab-content.active { display: block; }
    </style>';
    
    echo '<div>
        <a href="?page=auth_documentation&tab=facebook" class="tab ' . ($current_tab == 'facebook' ? 'active' : '') . '">Facebook Auth</a>
        <a href="?page=auth_documentation&tab=google" class="tab ' . ($current_tab == 'google' ? 'active' : '') . '">Google Auth</a>
    </div>';
    
    $facebook_file = plugin_dir_path(__FILE__) . 'facebook-auth.php';
    $google_file = plugin_dir_path(__FILE__) . 'google-auth.php';
    
    echo '<div id="facebook" class="tab-content ' . ($current_tab == 'facebook' ? 'active' : '') . '">';
        include_once $facebook_file;
    echo '</div>';
    
    echo '<div id="google" class="tab-content ' . ($current_tab == 'google' ? 'active' : '') . '">';
    if (file_exists($google_file)) {
        include_once $google_file;
        
    }
    
    echo '</div>';
}