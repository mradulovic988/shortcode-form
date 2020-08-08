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
	class Scf_Functions
	{

		/**
		 * Collect data from the database
		 * pagionate them and place it
		 * into Users List page
		 *
		 * @package collectData
		 * @author Marko Radulovic <mradulovic988@gmail.com>
		 */
		public function collectData()
		{
			global $wpdb;

			$query              = "SELECT * FROM {$wpdb->prefix}shortcode_form";
			$total_query        = "SELECT COUNT(1) FROM (${query}) AS combined_table";
			$total              = $wpdb->get_var( $total_query );
			$itemsPerPage     = 10;
			$page               = isset( $_GET[ 'cpage' ] ) ? abs( ( int ) $_GET[ 'cpage' ] ) : 1;
			$offset             = ( $page * $itemsPerPage ) - $itemsPerPage;
			$results            = $wpdb->get_results( $query . " ORDER BY id DESC LIMIT ${offset}, ${itemsPerPage}" );

			if ( $total == 0 ) {
				echo '<h3>' . __( 'You don\'t have any submitted information yet.', 'shortcode-form' ) . '</h3>';
			} else {

				foreach ( $results as $result ) {

					echo '<tr class="alternate">';
					echo '<td class="column-columnname scf">' . $result->first_name . '</td>';
					echo '<td class="column-columnname scf">' . $result->last_name . '</td>';
					echo '<td class="column-columnname scf">' . $result->email . '</td>';
					echo '<td class="column-columnname scf">' . $result->subject . '</td>';
					echo '</tr>';
				}

				$customPagHtml      = "";
				$totalPage          = ceil( $total / $itemsPerPage );

				if( $totalPage > 1 ) {
					$customPagHtml =  '<div class="scf_pagination"><span>Page ' . $page . ' of ' . $totalPage . '</span> </div><div class="scf_pagination_page"> ' . paginate_links( [
							'base' => add_query_arg( 'cpage', '%#%' ),
							'format' => '',
							'prev_text' => __( '&laquo; Previous' ),
							'next_text' => __( 'Next &raquo;' ),
							'total' => $totalPage,
							'current' => $page
						] ).'</div>';
				}

				return $customPagHtml;
			}
		}

	}
}