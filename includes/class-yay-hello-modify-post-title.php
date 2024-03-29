<?php

defined('ABSPATH') || exit;

class PostTitleModifier
{
    private static $instance = null;

    private function __construct()
    {
        add_filter('the_title', array($this, 'change_title'), 10, 2);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function change_title($title, $id)
    {
        if (is_admin() && get_post_type($id) === "post") {
            $title = 'Hello World - ' . $title;
        }
        return $title;
    }
}
