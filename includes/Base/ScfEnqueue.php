<?php
/**
 * Enqueue class
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    ScfEnqueue
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;

if ( !class_exists( 'ScfEnqueue' ) ) {

    /**
     * ScfEnqueue class
     *
     * Class where we enque all scripts and styles
     *
     * @package    ScfEnqueue
     * @author     Marko Radulovic <mradulovic988@gmail.com>
     */
    class ScfEnqueue
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
        }

    }
}