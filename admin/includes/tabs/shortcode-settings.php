<table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">
                        <label>Use Shortcode</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input type="checkbox" id="myCheck" <?php if($get_easy_use_login_shortcode){ ?> checked
                            <?php } ?> value="true" name="easy_use_login_shortcode" onclick="showDiv()" />
                        <?php ?>
                        <br>
                        <br>
                        <div id="welcomeDiv"
                            style="display:<?php if($get_easy_use_login_shortcode){ ?> block <?php } else{ ?> none <?php } ?>;"
                            class="answer_list"> <code>[easy_login_btn]</code></div>
                    </td>

                    <script>
                    function showDiv() {
                        var checkBox = document.getElementById("myCheck");
                        var text = document.getElementById("welcomeDiv");
                        if (checkBox.checked == true) {
                            text.style.display = "block";
                        } else {
                            text.style.display = "none";
                        }
                    }
                    </script>
                </tr>
                

            </tbody>
        </table>