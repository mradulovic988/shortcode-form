<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.samplelink.com
 * @since             1.0.0
 * @package           shortcode-form
 *
 * @wordpress-plugin
 * Plugin Name:       Shortcode Form
 * Plugin URI:        www.samplelink.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress Admin area.
 * Version:           1.0.0
 * Author:            Marko Radulovic <mradulovic988@gmail.com>
 * Author URI:        www.samplelink.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shortcode-form
 * Domain Path:       /languages
 */

defined('ABSPATH') or die('You can not access here.');

/**
 * Including autoload.php from composer
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * @var constants PLUGIN_PATH Return plugin dir path of the plugin
 * @var constants PLUGIN Return plugin base name
 */
define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN', plugin_basename( __FILE__ ) );

/**
 * Code that runs during plugin activation
 */
if ( !function_exists( 'activate' ) ) {
    function activate()
    {
        Inc\Base\ScfActivate::activate();
        Inc\Base\ScfActivate::createDatabaseTable();
    }
}

/**
 * The code that runs during plugin deactivation
 */
if ( !function_exists( 'deactivate' ) ) {
    function deactivate(){}
}


register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\ScfInit' ) ) {
	Inc\ScfInit::registerServices();
}