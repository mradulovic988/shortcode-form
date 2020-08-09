<?php
/**
 * @link              www.samplelink.com
 * @since             1.0.0
 * @package           shortcode-form
 *
 * @wordpress-plugin
 *
 * Plugin Name:       Shortcode Form
 * Plugin URI:        www.samplelink.com
 * Description:       Plugin for displaying form anywhere on the website with the shortcode, and collecting data from it.
 * Version:           1.0.0
 * Author:            Marko Radulovic <mradulovic988@gmail.com>
 * Author URI:        www.samplelink.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shortcode-form
 * Domain Path:       /languages
 */

defined( 'ABSPATH' ) or die( 'You can not access here.' );

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
        Inc\Base\Scf_Activate::activate();
        Inc\Base\Scf_Activate::createDatabaseTable();
    }
}

/**
 * The code that runs during plugin deactivation
 */
if ( !function_exists( 'deactivate' ) ) {
    function deactivate()
    {
    	Inc\Base\Scf_Deactivate::deactivate();
    }
}


register_activation_hook( __FILE__, 'activate' );
register_deactivation_hook( __FILE__, 'deactivate' );

/**
 * Initialize all the core classes of the plugin
 */
if ( class_exists( 'Inc\\Scf_Init' ) ) {
	Inc\Scf_Init::registerServices();
}