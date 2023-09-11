<?php
// plugin details for wordpress:
/**
 * Plugin Name:         WPH Certificate Validator
 * Plugin URI:          https://himusharier.com/
 * Description:         Certificate Validator Wordpress Plugin
 * Version:             1.0
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Sharier Himu
 * Author URI:          www.facebook.com/himusharier/
 * License:             GPL v2 or later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:          https://himusharier.com/
 * Text Domain:         wph-certificate-validator
 */
/***********************************************/

// check if plugin running through wordpress:
if (!defined('ABSPATH')) {header("Location: /"); die();}
// if directly called then abort:
if (!defined('WPINC')) {die();}
// define plugin version:
if (!defined('WPH_CERTIFICATE_VALIDATOR_VERSION')) {define('WPH_CERTIFICATE_VALIDATOR_VERSION', '1.0');}
/************************************************************************************************************/

// adding style and js files for public:
if (!function_exists('wphcv_plugin_scripts_public')) {
    function wphcv_plugin_scripts_public() {
    wp_enqueue_style('wphcv-stylesheet', plugins_url('/assets/style.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/style.css'), false);
    wp_enqueue_script('wphcv-javascript', plugins_url('/assets/script.js', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/script.js'), true);
    }
    add_action('wp_enqueue_scripts', 'wphcv_plugin_scripts_public');
}
/******************************************************************/

// adding style and js files for admin panel:
if (!function_exists('wphcv_plugin_scripts_admin')) {
    function wphcv_plugin_scripts_admin() {
        wp_enqueue_style('wphcv-stylesheet-admin', plugins_url('/assets/style-admin.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/style-admin.css'), false);
        wp_enqueue_script('wphcv-javascript-admin', plugins_url('/assets/script-admin.js', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/script-admin.js'), true);
    }
    add_action('admin_init', 'wphcv_plugin_scripts_admin');
}
/*********************************************************/

// adding top-level menu options to the admin dashboard:
function wphcv_plugin_admin_dashboard() {
    if (!is_admin()) {return;}
    else {require plugin_dir_path(__FILE__) . 'validator-form-admin-dashboard.php';}
}
function wphcv_plugin_admin_add() {
    if (!is_admin()) {return;}
    else {require plugin_dir_path(__FILE__) . 'validator-form-admin-add.php';}
}
function wphcv_plugin_admin_edit() {
    if (!is_admin()) {return;}
    else {require plugin_dir_path(__FILE__) . 'validator-form-admin-edit.php';}
}
function wphcv_plugin_menu_register() {
    add_menu_page('Certificate Validator', 'Certificate Validator', 'manage_options', 'certificate-validator-dashboard', 'wphcv_plugin_admin_dashboard', 'dashicons-awards', 30);
    add_submenu_page('certificate-validator-dashboard', 'Dashboard - Certificate Validator', 'Dashboard', 'manage_options', 'certificate-validator-dashboard', 'wphcv_plugin_admin_dashboard');
    add_submenu_page('certificate-validator-dashboard', 'Add New Certificate', 'Add New Certificate', 'manage_options', 'certificate-validator-new-certificate', 'wphcv_plugin_admin_add');
    add_submenu_page('certificate-validator-dashboard', 'Edit Certificate', 'Edit Certificate', 'manage_options', 'certificate-validator-edit-certificate', 'wphcv_plugin_admin_edit');
}
add_action('admin_menu', 'wphcv_plugin_menu_register');
/*****************************************************/

// adding shortcode to output validator-form ui:
function wphcv_validator_form_ui() {
    require plugin_dir_path(__FILE__) . 'validator-form-ui.php';
}
function wphcv_validator_form_shortcode_register() {
    add_shortcode('wphcv_validator_form_shortcode', 'wphcv_validator_form_ui');
}
add_action('init', 'wphcv_validator_form_shortcode_register');
/************************************************************/

// creating database:
function wphcv_form_database_create() {
    global $wpdb;
    $table_name = $wpdb->prefix . "wphcv_form_database";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    schedule_date varchar(20) NOT NULL,
    programe_name varchar(100) NOT NULL,
    programe_host varchar(50) NOT NULL,
    file_url text NOT NULL,
    PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}
register_activation_hook( __FILE__, 'wphcv_form_database_create' );
/*****************************************************************/

// deleting database 
function wphcv_form_database_delete() {
    global $wpdb;
    $table_name = $wpdb->prefix . "wphcv_form_database";
    $sql = "DROP TABLE $table_name";
    $wpdb->query($sql);
}
register_uninstall_hook( __FILE__, 'wphcv_form_database_delete' );
/****************************************************************/