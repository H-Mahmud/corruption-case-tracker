<?php defined('ABSPATH') || exit();

class CCT_Admin
{
    private static $_instance;

    private function __construct()
    {
        add_action('admin_menu', array($this, 'add_menu_pages'));
    }

    function add_menu_pages()
    {
        add_submenu_page(
            'edit.php?post_type=case',
            'Tools',
            'Tools',
            'manage_options',
            'tools',
            array($this, 'tools_admin_menu_page_cb'),
            99
        );
    }

    function tools_admin_menu_page_cb()
    {
        if (!current_user_can('manage_options'))
            return;
        include_once(CCT_PLUGIN_DIR_PATH . 'templates/tools.php');
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new CCT_Admin();
        }

        return self::$_instance;
    }
}

CCT_Admin::getInstance();
