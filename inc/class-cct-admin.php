<?php defined('ABSPATH') || exit();

class CCT_Admin
{
    private static $_instance;

    private function __construct()
    {
        add_action('admin_menu', array($this, 'add_menu_pages'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
    }


    public function admin_enqueue($page_slug)
    {
        if ($page_slug != 'case_page_tools')
            return;

        wp_enqueue_style('cct-style', CCT_PLUGIN_DIR_URL . 'assets/cct-admin.css', [], '1.0.0', 'all');
        wp_enqueue_media();
        wp_enqueue_script('cct-script', CCT_PLUGIN_DIR_URL . 'assets/cct-admin.js', ['jquery'], '1.0.0', ['in_footer' => true]);
        wp_localize_script(
            'cct-script',
            'CCT',
            array(
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('_import-csv')
            )
        );
    }

    public function add_menu_pages()
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

    public function tools_admin_menu_page_cb()
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
