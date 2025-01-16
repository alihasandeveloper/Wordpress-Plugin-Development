<?php
/*
 * @package asif
 */

/*
 * Plugin Name: My Plugin
 * Plugin URI: #
 * Author: Ali Hasan
 * Author URL: #
 * Description: Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
 * Version: 1.0.0
 * Text Domain : alihasan
 * */

if (!defined('ABSPATH')) {
    exit;
}

class MyPlugin
{
    function __construct()
    {

    }

    function register()
    {
        add_action('init', array($this, 'custom_post_type'));
        add_action('admin_enqueue_scripts', array($this, 'register_script_and_styles'));
        add_action('admin_menu', array($this, 'add_admin_page'));
    }

    function add_admin_page()
    {
        add_menu_page('My Plugin', 'My Plugin', 'manage_options', 'my_plugin', array($this, 'my_plugin_page'), 'dashicons-heart');
    }

    function my_plugin_page()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }

    public function activate()
    {
        // generated a custom post type
        // flush rewrite rules
        $this->custom_post_type();
        require_once plugin_dir_path(__FILE__) . 'inc/myplugin-activate.php';
        MyPluginActivate::activate();

    }

    public function deactivate()
    {
        // flush rewrite rules
        require_once plugin_dir_path(__FILE__) . 'inc/myplugin-deactivate.php';
        MyPluginDeactivate::deactivate();
    }

    public function custom_post_type()
    {
        register_post_type('book', array(
            'label' => 'Books',
            'public' => true,
            'menu_icon' => 'dashicons-book',
        ));
    }

    public function register_script_and_styles()
    {
        wp_enqueue_style('my-style', plugins_url('/assets/style.css', __FILE__));
        wp_enqueue_script('my-js', plugins_url('/assets/script.js', __FILE__));
    }
}

if (class_exists('MyPlugin')) {
    $myplugin = new MyPlugin();
    $myplugin->register();
}

//activation
//require_once plugin_dir_path(__FILE__) . 'inc/myplugin-activate.php';
register_activation_hook(__FILE__, [$myplugin, 'activate']);

//deactivation
//require_once plugin_dir_path(__FILE__) . 'inc/myplugin-deactivate.php';
register_deactivation_hook(__FILE__, [$myplugin, 'deactivate']);

//uninstall
//register_uninstall_hook(__FILE__, [$myplugin, 'uninstall']);