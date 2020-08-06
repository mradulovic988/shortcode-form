<?php
/**
 * Enqueue class
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    SfEnqueue
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;

if ( !class_exists( 'SfEnqueue' ) ) {

    /**
     * SfEnqueue class
     *
     * Class where we enque all scripts and styles
     *
     * @package    SfEnqueue
     * @author     Marko Radulovic <mradulovic988@gmail.com>
     */
    class SfEnqueue
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
            wp_enqueue_style( 'style', plugins_url( '../../admin/css/style.css', __FILE__ ) );
            wp_enqueue_script( 'script', plugins_url( '../../admin/js/script.js', __FILE__ ) );
        }

        /**
         * Enqueue Public scripts and styles
         *
         * @package     enqueuePublic
         * @author      Marko Radulovic <mradulovic988@gmail.com>
         */
        public function enqueuePublic()
        {
            wp_enqueue_style( 'style', plugins_url( '../../public/css/style.css', __FILE__ ) );
            wp_enqueue_script( 'script', plugins_url( '../../public/js/script.js', __FILE__ ) );
        }

    }
}