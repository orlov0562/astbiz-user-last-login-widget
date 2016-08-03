<?php


class AstBiz_User_Last_Login_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'astbiz-user-last-login_widget',
            'AstBiz: User Last Login',
            ['description' => 'Show user last login time']
        );
    }

    public function widget( $args, $instance ) {
        global $wpdb;

        $title = apply_filters('widget_title', $instance['title']);
        $photo = !empty($instance['photo']) ? $instance['photo'] : '';
        $user_id = !empty($instance['user_id']) ? $instance['user_id'] : 0;
        $lang = !empty($instance['lang']) ? $instance['lang'] : 'en';

        echo $args['before_widget'];
        if (!empty( $title )) echo $args['before_title'].$title.$args['after_title'];

        echo '<div class="astbiz-last-login">';

        if (!empty($photo)) {
            echo '<div class="user-photo"><img src="'.$photo.'" /></div>';
        }

        if (!empty($user_id)) {
            echo '<div class="login-time">'.$this->getUserLoginTime($user_id, $lang).'</div>';
        }

        echo $args['after_widget'];
    }

    public function getUserLoginTime($user_id, $lang){

        $lastLoginTime = get_user_meta($user_id, 'astbiz_user_last_login', true);

        if ($lang && file_exists(dirname(__FILE__).'/lang/'.$lang.'.php')) {
            include dirname(__FILE__).'/lang/'.$lang.'.php';
        }

        if (function_exists('AstBiz_User_Last_Login_Last_Login_Text')) {
            $ret = AstBiz_User_Last_Login_Last_Login_Text($lastLoginTime);
        } else {
            $ret = '<span>Last visit '.date('d.m.Y', $lastLoginTime).'</span>';
        }

        return $ret;
    }

    // Widget Backend
    public function form( $instance ) {

        $title = isset($instance['title']) ? $instance['title'] : 'User';
        $photo = isset($instance['photo']) ? $instance[ 'photo' ] : '';
        $user_id = isset($instance['user_id']) ? $instance[ 'user_id' ] : get_current_user_id();
        $lang = isset($instance['lang']) ? $instance[ 'lang' ] : 'en';

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('photo'); ?>"><?php _e('Author photo url:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('photo'); ?>" name="<?php echo $this->get_field_name( 'photo' ); ?>" type="text" value="<?php echo esc_attr( $photo ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('user_id'); ?>"><?php _e('User:'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('user_id'); ?>" name="<?php echo $this->get_field_name( 'user_id' ); ?>">
            <?php foreach( get_users('orderby=nicename') as $user):?>
                <option value="<?=$user->ID?>"<?=($user->ID==$user_id)?' selected="selected"':''?>><?php echo esc_html( $user->user_login ); ?> [id:<?=$user->ID?>]</option>
            <?php endforeach;?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('lang'); ?>"><?php _e('Language:'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('lang'); ?>" name="<?php echo $this->get_field_name('lang'); ?>">
            <?php foreach( glob(dirname(__FILE__).'/lang/*.php') as $langFile): $lang = preg_replace('~^.+/([^/]+)\.php$~','$1',$langFile)?>
                <option value="<?=esc_attr($lang)?>"<?=(esc_attr($lang)==$lang)?' selected="selected"':''?>><?php echo esc_html( $lang ); ?></option>
            <?php endforeach;?>
            </select>
        </p>

        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = [];

        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';

        $instance['photo'] = !empty($new_instance['photo']) ? strip_tags($new_instance['photo']) : '';

        $userId = !empty($new_instance['user_id']) ? intval($new_instance['user_id']) : 0;
        $instance['user_id'] = ($userId && get_user_by('id', $userId)) ? $userId : 0;

        $instance['lang'] = !empty($new_instance['lang']) ? strip_tags($new_instance['lang']) : 'en';

        return $instance;
    }
}
