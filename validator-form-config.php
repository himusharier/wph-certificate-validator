<?php
/**
 * Plugin Name:       FH Certificate Validator
 * Plugin URI:        https://himusharier.com/
 * Description:       FH Certificate Validator Wordpress Plugin
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sharier Himu
 * Author URI:        https://himusharier.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://himusharier.com/
 * Text Domain:       fh-wp-certificate-validator
 */


// if directly called then abort.
if (!defined('WPINC')) {
  die;
}


// define plugin version
if (!defined('FH_CERTIFICATE_VALIDATOR_VERSION')) {
  define('FH_CERTIFICATE_VALIDATOR_VERSION', '1.0');
}


// adding style and js files
if (!function_exists('fhcv_plugin_scripts')) {
  function fhcv_plugin_scripts() {
    wp_enqueue_style('fhcv-stylesheet', plugins_url('/assets/style.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/style.css'), false);
    wp_enqueue_script('fhcv-javascript', plugins_url('/assets/script.js', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/script.js'), true);
  }
  add_action('wp_enqueue_scripts', 'fhcv_plugin_scripts');
}
// adding style and js files (admin panel)
if (!function_exists('fhcv_plugin_scripts_admin')) {
  function fhcv_plugin_scripts_admin() {
      wp_enqueue_style('fhcv-stylesheet-admin', plugins_url('/assets/style-admin.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/style-admin.css'), false);
      wp_enqueue_script('fhcv-javascript-admin', plugins_url('/assets/script-admin.js', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/script-admin.js'), true);
    }
  add_action('admin_init', 'fhcv_plugin_scripts_admin');
}


// adding top-level menu option to the admin dashboard & another page to edit post
function fhcv_plugin_admin_dashboard() {
  if (!is_admin()) {
    return;
  } else {
    require plugin_dir_path(__FILE__) . 'validator-form-admin-dashboard.php';
  }
}
function fhcv_plugin_admin_post_edit() {
  if (!is_admin()) {
    return;
  } else {
    require plugin_dir_path(__FILE__) . 'validator-form-admin-post-edit.php';
  }
}
function fhcv_plugin_admin_add_new() {
  if (!is_admin()) {
    return;
  } else {
    require plugin_dir_path(__FILE__) . 'validator-form-admin-add-new.php';
  }
}
function fhcv_plugin_menu_register() {
  add_menu_page('FH Certificate', 'FH Certificate', 'manage_options', 'validator-form-plugin-dashboard', 'fhcv_plugin_admin_dashboard', 'dashicons-awards', 30);
  
  add_submenu_page('validator-form-plugin-dashboard', 'Certificate List', 'Certificate List', 'manage_options', 'validator-form-plugin-dashboard', 'fhcv_plugin_admin_dashboard');
  
  add_submenu_page('validator-form-plugin-dashboard', 'Add New Certificate', 'Add New Certificate', 'manage_options', 'fhcv-plugin-admin-add-new', 'fhcv_plugin_admin_add_new');
  
  add_submenu_page('validator-form-plugin-dashboard', 'Edit Certificate', 'Edit Certificate', 'manage_options', 'fhcv-plugin-admin-post-edit', 'fhcv_plugin_admin_post_edit');

  //remove_menu_page('fhcv-plugin-admin-post-edit');
}
add_action('admin_menu', 'fhcv_plugin_menu_register');


// adding shortcode to output validator-form ui
function fhcv_form_ui() {
  require plugin_dir_path(__FILE__) . 'validator-form-ui.php';
}
function fhcv_form_shortcode_register() {
  add_shortcode('fhcv_form_shortcode', 'fhcv_form_ui');
}
add_action('init', 'fhcv_form_shortcode_register');


// creating database
function fhcv_form_database_create() {
  global $wpdb;

  $table_name = $wpdb->prefix . "fhcv_form_database";
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
  dbDelta( $sql );
}
register_activation_hook( __FILE__, 'fhcv_form_database_create' );


// deleting database 
function fhcv_form_database_delete() {
  global $wpdb;

  $table_name = $wpdb->prefix . "fhcv_form_database";

  $sql = "DROP TABLE $table_name";

  $wpdb->query($sql);
}
register_uninstall_hook( __FILE__, 'fhcv_form_database_delete' );