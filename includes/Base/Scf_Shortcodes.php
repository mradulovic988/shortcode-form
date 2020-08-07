<?php
/**
 * All shortcodes
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Base
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;

use Inc\Base\Scf_Functions;

if ( !class_exists( 'Scf_Shortcodes' ) ) {

	/**
	 * ScfShortcodes class
	 *
	 * Class where we set all of the shortcodes
	 *
	 * @package    Scf_Shortcodes
	 * @author     Marko Radulovic <mradulovic988@gmail.com>
	 */
	class Scf_Shortcodes extends Scf_Functions {

		public function __construct()
		{
			add_shortcode( 'form_inquiry', [ $this, 'ScfForm' ] );
			$this->sendToDatabase();
		}

		/**
		 * Checking if it's the user logged in and
		 * if so, pulling the user data and automatically
		 * fill First Name, Last Name and Email fields
		 *
		 * @package    loggedInUser
		 * @author     Marko Radulovic <mradulovic988@gmail.com>
		 * @param string $logged User object
		 * @param string $userParam User parametar from the user object
		 * @return string
		 */
		public function loggedInUser( $userParam )
		{
			if ( is_user_logged_in() ) {
				$logged = wp_get_current_user();

				if ( $logged->exists() ) {
					return $logged->$userParam;
				}
			}
		}

		/**
		 * Shortcode form for the frontend
		 *
		 * @package    ScfForm
		 * @author     Marko Radulovic <mradulovic988@gmail.com>
		 * @param string $form Holding all of the data for the form
		 * @return string
		 */
		public function ScfForm()
		{
			$form = '<h4>' . __( 'Submit your feedback', 'shortcode-form' ) . '</h4>';
			$form .= '<form id="ScfForm" action="" method="post" enctype="multipart/form-data">';

			$form .= '<label for="ScfFirstName">' . __( 'First Name', 'shortcode-form' ) . '</label>';
			$form .= '<input type="text" name="ScfFirstName" id="ScfFirstName" class="ScfFirstName" value="' . $this->loggedInUser( 'user_firstname' ) . '" placeholder="' . __( 'First Name', 'shortcode-form' ) . '">';

			$form .= '<label for="ScflastName">' . __( 'Last Name', 'shortcode-form' ) . '</label>';
			$form .= '<input type="text" name="ScfLastName" id="ScfLastName" class="ScfLastName" value="' . $this->loggedInUser( 'user_lastname' ) . '" placeholder="' . __( 'Last Name', 'shortcode-form' ) . '">';

			$form .= '<label for="ScfEmail">' . __( 'Email', 'shortcode-form' ) . '</label>';
			$form .= '<input type="email" name="ScfEmail" id="ScfEmail" class="ScfEmail" value="' . $this->loggedInUser( 'user_email' ) . '" placeholder="' . __( 'Email', 'shortcode-form' ) . '">';

			$form .= '<label for="ScfSubject">' . __( 'Subject', 'shortcode-form' ) . '</label>';
			$form .= '<input type="text" name="ScfSubject" id="ScfSubject" class="ScfSubject" placeholder="' . __( 'Subject', 'shortcode-form' ) . '">';

			$form .= '<label for="ScfMessage">' . __( 'Message', 'shortcode-form' ) . '</label>';
			$form .= '<textarea id="ScfMessage" name="ScfMessage" rows="4" cols="50" placeholder="' . __( 'Message', 'shortcode-form' ) . '"></textarea>';

			$form .= '<label for="ScfSubmit"></label>';
			$form .= '<button type="submit" name="ScfSubmit" id="ScfSubmit" class="ScfSubmit">' . __( 'Submit', 'shortcode-form' ) . '</button>';

			$form .= '<div id="#mail-status"></div>';

			$form .= '</form>';

			return $form;
		}

		/**
		 * Sending data from the form inquiry
		 * to the database table
		 *
		 * @package                 sendToDatabase
		 * @author                  Marko Radulovic <mradulovic988@gmail.com>
		 * @param string $table     Checking the database table
		 * @param array $data       Collecting all of the information from the form inqury
		 */
		public function sendToDatabase()
		{
			if ( isset( $_POST[ 'ScfSubmit' ] ) ) {

				global $wpdb;

				$ScfFirstName = $_POST['ScfFirstName'];
                $ScfLastName = $_POST['ScfLastName'];
                $ScfEmail = $_POST['ScfEmail'];
                $ScfSubject = $_POST['ScfSubject'];
                $ScfMessage = $_POST['ScfMessage'];

                $table = $wpdb->prefix.'shortcode_form';

                $data = [
                	'first_name' => $ScfFirstName,
	                'last_name' => $ScfLastName,
	                'email' => $ScfEmail,
	                'subject' => $ScfSubject,
	                'message' => $ScfMessage
                ];

                $format = [ '%s', '%s', '%s', '%s', '%s' ];
                $wpdb->insert( $table, $data, $format );
                $wpdb->insert_id;
			}
		}


	}
}