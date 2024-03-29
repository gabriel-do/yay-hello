<?php

defined('ABSPATH') || exit;

class ShortCodeGabriel
{
    private static $instance = null;

    private function __construct()
    {
        add_shortcode('hello_gabriel', [$this, 'hello_gabriel_shortcode']);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function hello_gabriel_shortcode($atts = null, $content = null)
    {
        $pages_count = wp_count_posts('page')->publish;
        $posts_count = wp_count_posts('post')->publish;
        $users = get_users();
        $number_of_users = count($users);
        $content = '<p>Number of Posts: ' . $posts_count . '</p>';
        $content .= '<br />';
        $content .= '<p>Number of Pages: ' . $pages_count . '</p>';
        $content .= '<br />';
        $content .= '<p>Number of Users: ' . $number_of_users . '</p>';
        return $content;
    }
}
