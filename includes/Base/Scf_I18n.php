<?php
/**
 * Define the internationalization functionality
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Base
 * @subpackage shortcode-form/Public
 */

namespace Inc\Base;

if ( !class_exists( 'Scf_I18n' ) ) {

	/**
	 * Define the internationalization functionality.
	 *
	 * Loads and defines the internationalization files for this plugin
	 * so that it is ready for translation.
	 *
	 * @since      1.0.0
	 * @package    Inc\Base
	 * @author     Marko Radulovic <mradulovic988@gmail.com>
	 */
	class Scf_I18n
	{

		public function __construct()
		{
			add_action('init', [$this, 'translationReady']);
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since    1.0.0
		 */
		public function translationReady()
		{

			load_plugin_textdomain(
				'wp-form-subscription',
				false,
				dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
			);

		}
	}
}