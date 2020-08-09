<?php
/**
 * Settings link
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Base
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;


if ( !class_exists( 'Scf_SettingLinks' ) ) {

	/**
	 * Setting links on the plugin page
	 *
	 * Setting links
	 *
	 * @package    Scf_SettingLinks
	 * @author     Marko Radulovic <mradulovic988@gmail.com>
	 */
	class Scf_SettingLinks {

		protected $plugin;

		public function __construct()
		{
			$this->plugin = PLUGIN;
			add_filter( "plugin_action_links_$this->plugin", [ $this, 'settingsLink' ] );
		}

		public function settingsLink($links)
		{
			$settingLink = '<a href="admin.php?page=scf_shortcode_form">' . __( 'Settings', 'shortcode-form' ) . '</a>';
			array_push( $links, $settingLink );
			return $links;
		}
	}
}