<?php
/**
 * All major function for the plugin
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Base
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;

if ( !class_exists( 'Scf_Functions' ) ) {

	/**
	 * ScfFunctions function for the plugin
	 *
	 * Major function for the plugin
	 *
	 * @package    Inc\Base
	 * @author     Marko Radulovic <mradulovic988@gmail.com>
	 */
	class Scf_Functions {

		public function __construct()
		{}

		/**
		 * Collect data from the database
		 * and place it into Users List page
		 *
		 * @package collectData
		 * @author Marko Radulovic <mradulovic988@gmail.com>
		 */
		public function collectData()
		{
			global $wpdb;

			$pullDatas = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}shortcode_form");

			$columnNumber = 1;

			foreach ( $pullDatas as $pulData ) {

				echo '<tr class="alternate">';
	            echo '<td class="column-columnname">' . $columnNumber++ . '.</td>';
	            echo '<td class="column-columnname">' . $pulData->first_name . '</td>';
	            echo '<td class="column-columnname">' . $pulData->last_name . '</td>';
	            echo '<th class="column-columnname">' . $pulData->email . '</th>';
	            echo '<td class="column-columnname">' . $pulData->subject . '</td>';
		        echo '</tr>';
			}
		}

	}
}