<?php

defined('ABSPATH') || exit;

class PostTitleModifier
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function apply()
    {
        add_filter('the_title', 'change_title', 10, 2);
        function change_title($title, $id)
        {
            if (is_admin() && get_post_type($id) === "post") {
                $title = 'Hello World - ' . $title;
            }
            return $title;
        }
    }
}
