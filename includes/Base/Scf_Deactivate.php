<?php
/**
 * Deactivation class
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Base
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;

if ( !class_exists( 'Scf_Deactivate' ) ) {

	/**
	 * Scf_Deactivate activation class
	 *
	 * Deactivation of the plugin
	 *
	 * @package    Scf_Deactivate
	 * @author     Marko Radulovic <mradulovic988@gmail.com>
	 */
	class Scf_Deactivate
	{
		public static function deactivate()
		{
			flush_rewrite_rules();
		}

	}
}