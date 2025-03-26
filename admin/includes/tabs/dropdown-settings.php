<table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>DropDown Pages</label>
                    </th>
                    <td class="forminp forminp-text">
                    <div id="row">
                        <div style=" display: flex; gap: 5px;">
                            <div id="append_menu">
                            <select name="dropdown_menu_" class="append_menu_select" style="min-width: 200px;">
                                <?php
                                foreach ($all_wp_pages as $value) {
                                    $post = get_post($value);
                                    $title = $post->post_title;
                                    $id = $post->post_name;?>
                                    <option <?php echo ($get_login_url == $id) ? 'selected="selected"' : ''; ?>
                                        value="<?php echo $id ?>"><?php echo $title ?></option>
                                    <?php }; ?>
                            </select>

                            </div>
                        </div>
                    </div>
                    <div id="newinput"></div>
                    <br>
                    
                    <button id="rowAdder" type="button" class="button-primary woocommerce-save-button">
                        <span class="bi bi-plus-square-dotted">
                        </span> ADD
                    </button>
                    </td>
                </tr>
                
            </tbody>
        </table>