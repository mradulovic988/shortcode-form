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
			add_shortcode( 'form_user_list', [ $this, 'showFormDataPag' ] );
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
			$data = '<h4>' . __( 'Submit your feedback', 'shortcode-form' ) . '</h4>';
			$data .= '<form id="ScfForm" method="post" name="ScfForm" enctype="multipart/form-data" target="iframe">';

			$data .= '<div class="ScfWrapper">';
			$data .= '<label for="ScfFirstName">' . __( 'First Name', 'shortcode-form' ) . '</label><span id="firstName-info" class="info"></span>';
			$data .= '<input type="text" name="ScfFirstName" id="ScfFirstName" class="ScfFirstName" value="' . $this->loggedInUser( 'user_firstname' ) . '" placeholder="' . __( 'First Name', 'shortcode-form' ) . '" required>';
			$data .= '</div>';

			$data .= '<div class="ScfWrapper">';
			$data .= '<label for="ScflastName">' . __( 'Last Name', 'shortcode-form' ) . '</label><span id="lastName-info" class="info"></span>';
			$data .= '<input type="text" name="ScfLastName" id="ScfLastName" class="ScfLastName" value="' . $this->loggedInUser( 'user_lastname' ) . '" placeholder="' . __( 'Last Name', 'shortcode-form' ) . '" required>';
			$data .= '</div>';

			$data .= '<div class="ScfWrapper">';
			$data .= '<label for="ScfEmail">' . __( 'Email', 'shortcode-form' ) . '</label><span id="email-info" class="info"></span>';
			$data .= '<input type="email" name="ScfEmail" id="ScfEmail" class="ScfEmail" value="' . $this->loggedInUser( 'user_email' ) . '" placeholder="' . __( 'Email', 'shortcode-form' ) . '" required>';
			$data .= '</div>';

			$data .= '<div class="ScfWrapper">';
			$data .= '<label for="ScfSubject">' . __( 'Subject', 'shortcode-form' ) . '</label><span id="subject-info" class="info"></span>';
			$data .= '<input type="text" name="ScfSubject" id="ScfSubject" class="ScfSubject" placeholder="' . __( 'Subject', 'shortcode-form' ) . '" required>';
			$data .= '</div>';

			$data .= '<div class="ScfWrapper">';
			$data .= '<label for="ScfMessage">' . __( 'Message', 'shortcode-form' ) . '</label><span id="message-info" class="info"></span>';
			$data .= '<textarea id="ScfMessage" name="ScfMessage" class="ScfMessage" rows="4" cols="50" placeholder="' . __( 'Message', 'shortcode-form' ) . '" required></textarea>';
			$data .= '</div>';

			$data .= '<label for="ScfSubmit"></label>';
			$data .= '<div class="buttonGif">';
			$data .= '<button type="submit" name="ScfSubmit" id="ScfSubmit" class="ScfSubmit">' . __( 'Submit', 'shortcode-form' ) . '</button>';
			$data .= '<img class="ajax-loader" src="'.plugins_url( '../Public/images/loading.gif', __FILE__ ).'"/>';
			$data .= '</div>';

			$data .= '<div id="showMessage"></div>';

			$data .= '</form>';
			$data .= '<iframe name="iframe" id="iframe" style="display:none"></iframe>';

			return $data;
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
		 *
		 * @return mixed
		 */
		public function showFormDataPag()
		{
			if ( current_user_can( 'administrator' ) ) {

				global $wpdb;

				$query        = "SELECT * FROM {$wpdb->prefix}shortcode_form";
				$total_query  = "SELECT COUNT(1) FROM (${query}) AS combined_table";
				$total        = $wpdb->get_var( $total_query );
				$itemsPerPage = 10;
				$page         = isset( $_GET['cpage'] ) ? abs( ( int ) $_GET['cpage'] ) : 1;
				$offset       = ( $page * $itemsPerPage ) - $itemsPerPage;
				$results      = $wpdb->get_results( $query . " ORDER BY id DESC LIMIT ${offset}, ${itemsPerPage}" );

				$customPagHtml = "";

				$customPagHtml .= '<div class="scf_show_form_wrapper"><div>';

				foreach ( $results as $result ) {

					$customPagHtml .= '<ul class="accordion">';
					$customPagHtml .= '<li>';
					$customPagHtml .= '<a class="toggle" href="javascript:void(0);">';
					$customPagHtml .= '<table class="scf_show_form_table">';
					$customPagHtml .= '<tr>';
					$customPagHtml .= '<th>' . __( 'First Name', 'shortcode-form' ) . '</th>';
					$customPagHtml .= '<th>' . __( 'Last Name', 'shortcode-form' ) . '</th>';
					$customPagHtml .= '<th>' . __( 'Email', 'shortcode-form' ) . '</th>';
					$customPagHtml .= '<th>' . __( 'Subject', 'shortcode-form' ) . '</th>';
					$customPagHtml .= '</tr>';
					$customPagHtml .= '<tr>';
					$customPagHtml .= '<td>' . $result->first_name . '</td>';
					$customPagHtml .= '<td>' . $result->last_name . '</td>';
					$customPagHtml .= '<td>' . $result->email . '</td>';
					$customPagHtml .= '<td>' . $result->subject . '</td>';
					$customPagHtml .= '</tr>';
					$customPagHtml .= '</table></a>';

					$customPagHtml .= '<ul class="inner">';
					$customPagHtml .= '<li>- ' . __( 'First Name: ', 'shortcode-form' ) . $result->first_name . '</li>';
					$customPagHtml .= '<li>- ' . __( 'Last Name: ', 'shortcode-form' ) . $result->last_name . '</li>';
					$customPagHtml .= '<li>- ' . __( 'Email: ', 'shortcode-form' ) . $result->email . '</li>';
					$customPagHtml .= '<li>- ' . __( 'Subject: ', 'shortcode-form' ) . $result->subject . '</li>';
					$customPagHtml .= '<li>- ' . __( 'Message: ', 'shortcode-form' ) . $result->message . '</li>';
					$customPagHtml .= '</ul>';
					$customPagHtml .= '</li>';
					$customPagHtml .= '</ul>';
				}

				$customPagHtml .= '</div>';

				$totalPage = ceil( $total / $itemsPerPage );

				if ( $totalPage > 1 ) {
					$customPagHtml .= '<div class="scf_show_form_inner_wrapper"> <div class="scf_pagination_show_form"><span>Page ' . $page . ' of ' . $totalPage . '</span> </div><div class="scf_pagination_page_show_form"> ' . paginate_links( [
							'base'      => add_query_arg( 'cpage', '%#%' ),
							'format'    => '',
							'prev_text' => __( '&laquo; Previous' ),
							'next_text' => __( 'Next &raquo;' ),
							'total'     => $totalPage,
							'current'   => $page
						] ) . '</div></div></div>';
				}

				return $customPagHtml;

			}
		}

	}
}