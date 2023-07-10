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
if (!defined('APH_BURADiO_VERSION')) {
  define('APH_BURADiO_VERSION', '1.1');
}


// adding style and js files
if (!function_exists('aph_buradio_plugin_scripts')) {
  function aph_buradio_plugin_scripts() {
    wp_enqueue_style('aph-buradio-stylesheet', plugins_url('/assets/style.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/style.css'), false);
    wp_enqueue_script('aph-buradio-javascript', plugins_url('/assets/script.js', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/script.js'), true);
  }
  add_action('wp_enqueue_scripts', 'aph_buradio_plugin_scripts');
}
// adding style and js files (admin panel)
if (!function_exists('aph_buradio_plugin_scripts_admin')) {
  function aph_buradio_plugin_scripts_admin() {
      wp_enqueue_style('aph-buradio-stylesheet-admin', plugins_url('/assets/style-admin.css', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/style-admin.css'), false);
      wp_enqueue_script('aph-buradio-javascript-admin', plugins_url('/assets/script-admin.js', __FILE__), '', filemtime(plugin_dir_path(__FILE__).'/assets/script-admin.js'), true);
    }
  add_action('admin_init', 'aph_buradio_plugin_scripts_admin');
}


// adding top-level menu option to the admin dashboard & another page to edit post
function aph_buradio_plugin_admin_dashboard() {
  if (!is_admin()) {
    return;
  } else {
    require plugin_dir_path(__FILE__) . 'player-admin-dashboard.php';
  }
}
function aph_buradio_plugin_admin_post_edit() {
  if (!is_admin()) {
    return;
  } else {
    require plugin_dir_path(__FILE__) . 'player-admin-post-edit.php';
  }
}
function aph_buradio_plugin_menu_register() {
  add_menu_page('BU RADiO MP3 Playlist', 'BU RADiO Playlist', 'manage_options', 'buradio-mp3-player-plugin-dashboard', 'aph_buradio_plugin_admin_dashboard', 'dashicons-playlist-audio', 30);
  add_submenu_page('buradio-mp3-player-plugin-dashboard', 'Edit - Playlist', 'Edit Playlist ', 'manage_options', 'buradio-mp3-player-plugin-post-edit', 'aph_buradio_plugin_admin_post_edit');

}
add_action('admin_menu', 'aph_buradio_plugin_menu_register');


// adding shortcode to output player ui
function aph_mp3_buradio_player_ui() {
  require plugin_dir_path(__FILE__) . 'player-ui.php';
}
function aph_mp3_buradio_shortcode_register() {
  add_shortcode('aph_mp3_buradio_shortcode', 'aph_mp3_buradio_player_ui');
}
add_action('init', 'aph_mp3_buradio_shortcode_register');


// creating database
function aph_mp3_buradio_database_create() {
  global $wpdb;

  $table_name = $wpdb->prefix . "aph_mp3_buradio_playlist";
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
register_activation_hook( __FILE__, 'aph_mp3_buradio_database_create' );


// deleting database 
function aph_mp3_buradio_database_delete() {
  global $wpdb;

  $table_name = $wpdb->prefix . "aph_mp3_buradio_playlist";

  $sql = "DROP TABLE $table_name";

  $wpdb->query($sql);
}
register_uninstall_hook( __FILE__, 'aph_mp3_buradio_database_delete' );