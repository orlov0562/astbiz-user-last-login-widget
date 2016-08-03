<?php
/*
Plugin Name: AstBiz User Last Login Widget
Plugin URI: http://www.astbiz.com
Description: AstBiz User Last Login Widget
Version: 2016.08.03.14.00
Author: Vitaliy Orlov
Author URI: http://www.orlov.cv.ua
*/

// --------------------------------------------------------------

require dirname(__FILE__).'/AstBiz_User_Last_Login_Widget.class.php';

// --------------------------------------------------------------

add_action('widgets_init', function() {
    register_widget('AstBiz_User_Last_Login_Widget');
});

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style(
        'astbiz-user-last-login-frontend-css',
        plugins_url('media/frontend.css', __FILE__)
    );
});

add_action('init', function() {
   if (is_user_logged_in()) {
       update_usermeta(get_current_user_id(), 'astbiz_user_last_login', time());
   }
});
