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
			add_shortcode( 'form_user_list', [ $this, 'showFormData' ] );
			$this->sendToDatabase();
		}

		/**
		 * Checking if it's the user logged in and
		 * if so, pulling the user data and automatically
		 * fill First Name, Last Name and Email fields
		 *
		 * @package         loggedInUser
		 * @author          Marko Radulovic <mradulovic988@gmail.com>
		 * @param string    $logged User object
		 * @param string    $userParam User parametar from the user object
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
			return '<h4>' . __( 'Submit your feedback', 'shortcode-form' ) . '</h4>
				<form id="ScfForm" method="post" name="ScfForm" enctype="multipart/form-data" target="iframe">
				
					<div class="ScfWrapper">
						<label for="ScfFirstName">' . __( 'First Name', 'shortcode-form' ) . '</label><span id="firstName-info" class="info"></span>
						<input type="text" name="ScfFirstName" id="ScfFirstName" class="ScfFirstName" value="' . $this->loggedInUser( 'user_firstname' ) . '" placeholder="' . __( 'First Name', 'shortcode-form' ) . '" required>
					</div>
					
					<div class="ScfWrapper">
						<label for="ScflastName">' . __( 'Last Name', 'shortcode-form' ) . '</label><span id="lastName-info" class="info"></span>
						<input type="text" name="ScfLastName" id="ScfLastName" class="ScfLastName" value="' . $this->loggedInUser( 'user_lastname' ) . '" placeholder="' . __( 'Last Name', 'shortcode-form' ) . '" required>
					</div>
					
					<div class="ScfWrapper">
						<label for="ScfEmail">' . __( 'Email', 'shortcode-form' ) . '</label><span id="email-info" class="info"></span>
						<input type="email" name="ScfEmail" id="ScfEmail" class="ScfEmail" value="' . $this->loggedInUser( 'user_email' ) . '" placeholder="' . __( 'Email', 'shortcode-form' ) . '" required>
					</div>
		
					<div class="ScfWrapper">
						<label for="ScfSubject">' . __( 'Subject', 'shortcode-form' ) . '</label><span id="subject-info" class="info"></span>
						<input type="text" name="ScfSubject" id="ScfSubject" class="ScfSubject" placeholder="' . __( 'Subject', 'shortcode-form' ) . '" required>
					</div>
		
					<div class="ScfWrapper">
						<label for="ScfMessage">' . __( 'Message', 'shortcode-form' ) . '</label><span id="message-info" class="info"></span>
						<textarea id="ScfMessage" name="ScfMessage" class="ScfMessage" rows="4" cols="50" placeholder="' . __( 'Message', 'shortcode-form' ) . '" required></textarea>
					</div>
		
					<label for="ScfSubmit"></label>
						<div class="buttonGif">
						<button type="submit" name="ScfSubmit" id="ScfSubmit" class="ScfSubmit">' . __( 'Submit', 'shortcode-form' ) . '</button>
						<img class="ajax-loader" src="'.plugins_url( '../Public/images/loading.gif', __FILE__ ).'"/>
					</div>
					
					<div id="showMessage"></div>
	
				</form>
				<iframe name="iframe" id="iframe" style="display:none" ></iframe>';
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

		/**
		 * Showing form information on the front end
		 * only for admin users
		 */
		public function showFormData()
		{
			/**
			 * Show only if it's the user administrator
			 */
			if ( current_user_can( 'administrator' ) ) {

				global $wpdb;
				$showForm = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'shortcode_form');

				$data = '<div class="scf_formdata">';
				$data .= '<table>';
				$data .= '<tr>';
				$data .= '<th>' . __( "First Name", "shortcode-form" ) . '</th>';
				$data .= '<th>' . __( "Last Name", "shortcode-form" ) . '</th>';
				$data .= '<th>' . __( "Email", "shortcode-form" ) . '</th>';
				$data .= '<th>' . __( "Subject", "shortcode-form" ) . '</th>';
				$data .= '</tr>';


				foreach ( $showForm as $form ) {

					$data .= '<tr class="alternate">';
					$data .= '<td class="column-columnname scf">' . $form->first_name . '</td>';
					$data .= '<td class="column-columnname scf">' . $form->last_name . '</td>';
					$data .= '<td class="column-columnname scf">' . $form->email . '</td>';
					$data .= '<td class="column-columnname scf">' . $form->subject . '</td>';
					$data .= '</tr>';
				}

				$data .= '</table>';
				$data .= '</div>';

				return $data;
			}
		}
	}
}