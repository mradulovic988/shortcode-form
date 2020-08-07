<?php
/**
 * Enqueue class
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Base
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;

if ( !class_exists( 'Scf_Enqueue' ) ) {

    /**
     * Scf_Enqueue class
     *
     * Class where we enque all scripts and styles
     *
     * @package    Scf_Enqueue
     * @author     Marko Radulovic <mradulovic988@gmail.com>
     */
    class Scf_Enqueue
    {
        public function __construct()
        {
            add_action( 'admin_enqueue_scripts', [ $this, 'enqueueAdmin' ] );
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueuePublic' ] );
        }

        /**
         * Enqueue Admin scripts and styles
         *
         * @package     enqueueAdmin
         * @author      Marko Radulovic <mradulovic988@gmail.com>
         */
        public function enqueueAdmin()
        {
            wp_enqueue_style( 'style', plugins_url( '../Admin/css/styleAdmin.css', __FILE__ ) );
            wp_enqueue_script( 'script', plugins_url( '../Admin/js/scriptAdmin.js', __FILE__ ) );
        }

        /**
         * Enqueue Public scripts and styles
         *
         * @package     enqueuePublic
         * @author      Marko Radulovic <mradulovic988@gmail.com>
         */
        public function enqueuePublic()
        {
            wp_enqueue_style( 'style', plugins_url( '../Public/css/stylePublic.css', __FILE__ ) );
            wp_enqueue_script( 'script', plugins_url( '../Public/js/scriptPublic.js', __FILE__ ) );
	        wp_register_script( 'jqueryPublic', plugins_url( '../Public/js/jqueryPublic.js', __FILE__ ), [ 'jquery' ] );
	        wp_enqueue_script( 'jqueryPublic', plugins_url( '../Public/js/jqueryPublic.js', __FILE__ ), [ 'jquery' ] );
        }

    }
}