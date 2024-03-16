<?php if (isset($_POST['esylogin_reg_google_auth_submit'])) {
    $esylogin_reg_google_auth = serialize(array($_POST['easy_google_auth_client_id'],$_POST['easy_google_auth_client_secret'],$_POST['easy_google_auth_redirect_uri']));
    update_option('esylogin_reg_google_auth', $esylogin_reg_google_auth);
}
 $get_esylogin_reg_google_auth = unserialize(get_option('esylogin_reg_google_auth'));
//  print_r($get_esysubscription_setting);
  ?>
<div class="wrap">
    <style>
        .subscrtion-design{min-width: 380px;}
    </style>
        <h1><?php _e( 'Google Auth Settings', 'textdomain' ); ?></h1>
        <form action="" method="POST" style="margin-top:20px">
                <table class="form-table">
                    <tbody>
                        
                        <tr valign="top">
                            <th scope="row">
                                <label>Client ID</label>
                            </th>
                            <td class="forminp forminp-text">
                                <input class="subscrtion-design" type="text" value="<?php echo $get_esylogin_reg_google_auth[0] ?>" name="easy_google_auth_client_id" placeholder="769260071206-k02ugtnv9fm5npbou4mql26c6bmuhtn1">
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">
                                <label>Client Secret</label>
                            </th>
                            <td class="forminp forminp-text">
                                <input class="subscrtion-design" type="text" value="<?php echo $get_esylogin_reg_google_auth[1] ?>" name="easy_google_auth_client_secret" placeholder="HSpzsi_NGJPecNgyFMb-JNyPYbJG0kVj03Zbb7cO0hno8PfD1-f">
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row">
                                <label>Redirect Uri</label>
                            </th>
                            <td class="forminp forminp-text">
                                <input class="subscrtion-design" type="url" value="<?php echo $get_esylogin_reg_google_auth[2] ?>" name="easy_google_auth_redirect_uri" placeholder="https//:website.com/uri">
                            </td>
                        </tr>
                        
                    
                    </tbody>
                </table>
                <button name="esylogin_reg_google_auth_submit" class="button-primary woocommerce-save-button" type="submit" value="Save changes">Save changes</button>
        </form>
    </div>

<?php