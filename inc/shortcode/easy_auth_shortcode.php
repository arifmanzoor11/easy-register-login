<?php
add_shortcode('easy_auth', 'easy_auth_shortcode');

function easy_auth_shortcode() {
    ob_start();
    ?>
    <div class="easy-auth-container">
        <div id="easy-auth-login" class="easy-auth-form">
            <?php echo do_shortcode('[login_shortcode]'); ?>
        </div>
        <div id="easy-auth-register" class="easy-auth-form" style="display:none;">
            <?php echo do_shortcode('[register_shortcode]'); ?>
        </div>
        <div id="easy-auth-forgot" class="easy-auth-form" style="display:none;">
            <?php echo do_shortcode('[forgot_pw_shortcode]'); ?>
        </div>
        <div class="easy-auth-tabs">
        Already have an account? <button class="easy-auth-btn" data-target="login">Login</button> |
            <button class="easy-auth-btn" data-target="register">Create an account</button> |
            <button class="easy-auth-btn" data-target="forgot">Forgot Password?</button>
        </div>
    </div>

    <style>
        .easy-auth-btn {
            margin: 0px; padding:0;
            cursor: pointer;
            color: #009fc2;
            background: none;
            text-transform: none;
            letter-spacing: 0;
            font-size: 15px;
            font-weight: 400;
        }
        .easy-auth-form {
            margin-top: 20px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.easy-auth-btn');
            const forms = document.querySelectorAll('.easy-auth-form');

            buttons.forEach(button => {
                button.addEventListener('click', () => {
                    const target = button.dataset.target;

                    forms.forEach(form => form.style.display = 'none');
                    document.getElementById(`easy-auth-${target}`).style.display = 'block';
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
