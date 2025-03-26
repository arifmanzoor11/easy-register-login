# Easy Register and Login

Version: 1.1
* Created Email Auth Registration.
*  Bugs fixed in login System.


Version: 2.1
* Facebook Auth
* Bugs fixed in login System.

## Plugin Details
- **Plugin Name:** Easy Login & Register  
- **Plugin URI:** [http://guitarchordslyrics.com/](http://guitarchordslyrics.com/)  
- **Version:** 2.1  
- **Author:** Arif M.  
- **Author URI:** [http://guitarchordslyrics.com/](http://guitarchordslyrics.com/)  
- **License:** GNU GENERAL PUBLIC LICENSE  

## Description
Easy Login & Register is a WordPress plugin that simplifies user authentication by providing a hassle-free way to integrate user registration and login features. The plugin includes:
- Secure user management
- Shortcodes for login and registration
- Google and Facebook authentication integration
- Customizable login and registration pages
- Redirects for logged-in and non-logged-in users
- Email notifications for new user registration
- WooCommerce compatibility for login redirection

## Features
- Shortcodes for login and registration forms.
- Integration with Google and Facebook authentication.
- Customizable login and registration pages.
- Admin menu for managing plugin settings.
- AJAX-based user image refresh functionality.
- Redirects for logged-in and non-logged-in users.
- Email notifications for new user registration.
- Compatibility with WooCommerce for login redirection.
- Additional files for navigation, URI handling, and AJAX registration.

## Installation
1. Upload the plugin files to the `/wp-content/plugins/easy-login-register/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Configure plugin settings under the 'Easy Login & Register' menu in the WordPress admin panel.

## Shortcodes
- `[easy_qr_code_login]` - Displays the login and registration form.

## Hooks and Actions
- `add_shortcode` - Registers the `[easy_qr_code_login]` shortcode.
- `wp_enqueue_scripts` - Enqueues frontend scripts and styles.
- `admin_enqueue_scripts` - Enqueues admin scripts and styles.
- `wp_ajax_myprefix_get_image` - Handles AJAX requests for refreshing user images.
- `admin_menu` - Adds admin menu and submenus for plugin settings.
- `wp` - Checks user login status and redirects accordingly.
- `plugin_action_links` - Adds a settings link to the plugin's action links.
- `admin_notices` - Displays an admin notice if the EasyMedia plugin is not installed.

## Functions
- `easy_qr_code_login()` - Includes the login and registration view.
- `getTimeNow()` - Returns a greeting based on the current time of day.
- `add_sideSection()` - Includes the side area view.
- `easy_scripts()` - Enqueues frontend scripts and styles.
- `easy_login_load_admin_style_login_reg()` - Enqueues admin scripts and styles.
- `myprefix_get_image()` - Handles AJAX requests for user image refresh.
- `plugin_assets_url()` - Returns the plugin's assets URL.
- `easy_reg_login_menu()` - Adds admin menu and submenus.
- `login_menu_init()` - Includes the admin menu view.
- `sub_login_menu_init()` - Includes the Google authentication settings view.
- `sub_facebook_menu_init()` - Handles Facebook authentication settings.
- `add_login_check()` - Redirects users based on login status and page.
- `the_slug_exists()` - Checks if a post slug exists.
- `easy_login_links()` - Adds a settings link to the plugin's action links.
- `notify_new_user()` - Sends an email notification to new users with login details.
- `custom_plugin_check_admin_notice()` - Displays an admin notice if the EasyMedia plugin is not installed.

## Additional Files Included
- `inc/nav-menu.php` - Handles navigation menu functionality.
- `inc/uri.php` - Manages URI-related functionality.
- `inc/assign-template.php` - Assigns templates for specific pages.
- `inc/login-fun.php` - Contains login-related functions.
- `views/google-auth/auth.php` - Handles Google authentication.
- `views/google-auth/facebook-auth.php` - Handles Facebook authentication.
- `inc/ajax-register.php` - Handles AJAX-based user registration.
- `inc/shortcode/login-shortcode.php` - Defines the login shortcode.
- `inc/shortcode/register-shortcode.php` - Defines the registration shortcode.
- `inc/shortcode/forgot-pw-shortcode.php` - Defines the forgot password shortcode.
- `admin/documentation/documentation-tab.php` - Displays plugin documentation in the admin panel.

## Support
For any issues or feature requests, please contact the plugin author at [http://guitarchordslyrics.com/](http://guitarchordslyrics.com/).

