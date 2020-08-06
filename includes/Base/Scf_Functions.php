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
	 * @package    Scf_Functions
	 * @author     Marko Radulovic <mradulovic988@gmail.com>
	 */
	class Scf_Functions {

		/**
		 * Sending data to the database
		 *
		 * @package    sendToDatabase
		 * @author     Marko Radulovic <mradulovic988@gmail.com>
		 */
		public function sendToDatabase()
		{
			if ( isset( $_POST[ 'ScfSubmit' ] ) ) {

				$fistName   = $_POST[ 'ScfFirstName' ] . '<br>';
				$lastName   = $_POST[ 'ScfLastName' ] . '<br>';
				$email      = $_POST[ 'ScfEmail' ] . '<br>';
				$subject    = $_POST[ 'ScfSubject' ] . '<br>';
				$message    = $_POST[ 'ScfMessage' ] . '<br>';


			}
		}

	}
}