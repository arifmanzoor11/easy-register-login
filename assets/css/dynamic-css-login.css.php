<?php
// Dynamic css includer
require('../../../../../wp-blog-header.php');
$get_easy_register_url_primary = get_option('easy_register_url_primary');

$get_easy_bg_color_1 = get_option('easy_bg_color_1');
$get_easy_bg_color_2 = get_option('easy_bg_color_2');

$get_easy_login_bg_angle = get_option('easy_login_bg_angle');

$esylogin_output = unserialize(get_option('esylogin_input'));
$esylogin_output_btn = unserialize(get_option('esylogin_btn'));

// echo $_SERVER["DOCUMENT_ROOT"];
header("Content-type: text/css"); ?>

/* profile menu */
.reg-loader{position: fixed;
    bottom: 20px;
    background: black;
    padding: 15px 20px;
    color: white;
    right: 20px;
    border-radius: 5px;}
.profile {
  position: relative;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    text-align: end;
    margin-top: -6px;
}

.profile h3 {
  text-align: end;
    line-height: 1;
    margin-bottom: 4px;
    font-weight: 600;
    text-transform: capitalize;
    margin-top: 0;
    font-size: 14px;
}

.profile p {
  line-height: 1;
    font-size: 12px;
    opacity: .6;
    margin-bottom: 0;
}

.profile .img-box {
    position: relative;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    overflow: hidden;
}

.profile .img-box img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* menu (the right one) */

.dropdownmenu {
    position: absolute;
    top: calc(100% + 29px);
    right: -10px;
    /* width: 200px; */
    /* min-height: 100px; */
    /* background: #fff; */
    box-shadow: 0 10px 20px rgb(0 0 0 / 30%);
    /* opacity: 0; */
    transform: translateY(-10px);
    /* visibility: hidden; */
    transition: 300ms;
    border-radius: 20px;
}

.dropdownmenu::before {
    content: '';
    position: absolute;
    top: -10px;
    right: 14px;
    width: 18px;
    height: 20px;
    /* background: #000; */
    transform: rotate(45deg);
    z-index: -1;
}

.dropdownmenu.active {
    opacity: 1;
    transform: translateY(0);
    visibility: visible;
}

/* menu links */

.dropdownmenu ul {
    position: relative;
    display: flex;
    flex-direction: column;
    /* z-index: 10; */
    background: #fff;
    border-radius: 20px;
    padding: 21px 0;
    z-index: 99999999;
}

.dropdownmenu ul li {
    list-style: none;
}

.dropdownmenu ul li:hover {
    background: #eee;
}

.dropdownmenu ul li a {
    text-decoration: none;
    color: #000;
    display: flex;
    align-items: center;
    padding: 15px 15px;
    gap: 6px;
}

.dropdownmenu ul li a i {
    font-size: 1.2em;
}

.easy_login {
background: linear-gradient(45deg, <?php echo $get_easy_bg_color_1 ? $get_easy_bg_color_1 : '#c54393' ?>, <?php if ($get_easy_bg_color_2) { echo $get_easy_bg_color_2; } else { ?> #4363c5 <?php }  ?>);
}
.easy_login input[type="submit"], .easy_login button.easy-register , .logout-btn {
background: <?php echo $get_easy_register_url_primary ? $get_easy_register_url_primary : '#000' ?>; }
.register-btn, .forgot-btn, .log-in-btn{color: <?php echo $get_easy_register_url_primary ? $get_easy_register_url_primary : '#000' ?>;}

.esylogin-input {
    background: <?php echo esc_attr(get_option('esylogin_input_bgcolor', '#eee')); ?> !important;
    border-radius: <?php echo esc_attr(get_option('esylogin_input_border_radius', '0px')); ?> !important;
    padding: <?php echo esc_attr(get_option('esylogin_input_padding', '1.5rem 1.8rem')); ?> !important;
    border-width: <?php echo esc_attr(get_option('esylogin_input_border_width', '1px')); ?> !important;
    border-color: <?php echo esc_attr(get_option('esylogin_input_bordercolor', '#eee')); ?> !important;
    border-style: <?php echo esc_attr(get_option('esylogin_input_borderstyle', 'solid')); ?> !important;
    font-size: <?php echo esc_attr(get_option('esylogin_input_fontsize', '1.6rem')); ?> !important;
    font-weight: <?php echo esc_attr(get_option('esylogin_btn_fontweight', '400')); ?> !important;
    color: <?php echo esc_attr(get_option('esylogin_input_color', '#000')); ?> !important;
    width: <?php echo esc_attr(get_option('esylogin_input_width', '100%')); ?> !important;
    display: block;
}

.esylogin-input:focus, .esylogin-input:focus-visible, .esylogin-input:hover {
    border-color: <?php echo esc_attr(get_option('esylogin_input_bgcolor', '#eee')); ?> !important;
}

input.esylogin-btn {
  background: <?php echo get_option('esylogin_btn_bgcolor', '#4363c5'); ?> !important;
  border-radius: <?php echo get_option('esylogin_btn_border_radius', '0px'); ?> !important;
  padding: <?php echo get_option('esylogin_btn_padding', ''); ?> !important;
  border-width: <?php echo get_option('esylogin_btn_border_width', '1px'); ?> !important;
  border-color: <?php echo get_option('esylogin_btn_bordercolor', '#eee'); ?> !important;
  border-style: <?php echo get_option('esylogin_btn_borderstyle', 'solid'); ?> !important;
  font-size: <?php echo get_option('esylogin_btn_fontsize', '1.6rem'); ?> !important;
  font-weight: <?php echo esc_attr(get_option('esylogin_btn_fontweight', '400')); ?> !important;
  color: <?php echo get_option('esylogin_btn_color', '#fff'); ?> !important;
  width: <?php echo get_option('esylogin_btn_width', '100%'); ?> !important;
  margin: <?php echo get_option('esylogin_btn_margin', ''); ?> !important;
  text-decoration: none !important;}

.esylogin-btn:hover {
  background: <?php echo get_option('esylogin_btn_bghvrcolor', '#4363c5'); ?> !important;
  border-color:<?php echo get_option('esylogin_btn_bghvrcolor', '#4363c5'); ?> !important;
}
.esyregister-btn{
  background: <?php echo get_option('esylogin_btn_bgcolor', '#4363c5'); ?> !important;
  border-radius: <?php echo get_option('esylogin_btn_border_radius', '0px'); ?> !important;
  padding: <?php echo get_option('esylogin_btn_padding', ''); ?> !important;
  border-width: <?php echo get_option('esylogin_btn_border_width', '1px'); ?> !important;
  border-color: <?php echo get_option('esylogin_btn_bordercolor', '#eee'); ?> !important;
  border-style: <?php echo get_option('esylogin_btn_borderstyle', 'solid'); ?> !important;
  font-size: <?php echo get_option('esylogin_btn_fontsize', '1.6rem'); ?> !important;
  color: <?php echo get_option('esylogin_btn_color', '#fff'); ?> !important;
  width: <?php echo get_option('esylogin_btn_width', '100%'); ?> !important;
  margin: <?php echo get_option('esylogin_btn_margin', ''); ?> !important;
}
.esyregister-btn:hover {
  background: <?php echo get_option('esylogin_btn_bghvrcolor', '#4363c5'); ?> !important;
  border-color:<?php echo get_option('esylogin_btn_bghvrcolor', '#4363c5'); ?> !important;
}

#snackbar.show {
  visibility: visible;
  -webkit-animation: fadein, fadeout ;
  animation: fadein, fadeout;
}

@-webkit-keyframes fadein {
  from {bottom: 0; opacity: 0;} 
  to {bottom: 30px; opacity: 1;}
}

@keyframes fadein {
  from {bottom: 0; opacity: 0;}
  to {bottom: 30px; opacity: 1;}
}

@-webkit-keyframes fadeout {
  from {bottom: 30px; opacity: 1;} 
  to {bottom: 0; opacity: 0;}
}

@keyframes fadeout {
  from {bottom: 30px; opacity: 1;}
  to {bottom: 0; opacity: 0;}
}

.password-group{  position: relative;
  width: 100%;}
  .toggle { background: none;
  border: none;
  color: #337ab7;
  /*display: none;*/
  /*font-size: .9em;*/
  font-weight: 600;
  /*padding: .5em;*/
  position: absolute;
  right: .75em;
  top: 2.25em;
  z-index: 9;
}

button#btnToggle {
    position: absolute;
    top: 0px;
}

