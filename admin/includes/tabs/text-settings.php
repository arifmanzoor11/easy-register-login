<table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Log In Button</label>
                    </th>
                    <td class="forminp forminp-text">
                    <input type="text" value="<?php echo $esylogin_menu_btn[0] ?>" placeholder="Log In" name="easy_login_btn_text"/>
                    <input <?php echo ($esylogin_menu_btn[1]) ? 'checked' : '' ; ?> type="checkbox"  name="easy_login_btn_text_enable"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Register Button</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" value="<?php echo $esylogin_menu_btn[2] ?>" placeholder="Register" name="easy_reg_btn_text"/>
                        <input type="checkbox" <?php echo ($esylogin_menu_btn[3]) ? 'checked' : '' ; ?> name="easy_reg_btn_text_enable"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label>Dashboard Button</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="text" placeholder="Dashboard" value="<?php echo $esylogin_menu_btn[4] ?>" name="easy_dashboard_btn_text"/>
                    </td>
                </tr>
            </tbody>
        </table>