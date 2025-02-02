<?php
/**
 * ScfAdmin class for listing all of the
 * admin pages
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Pages
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Pages;

if ( !class_exists( 'Scf_Admin' ) ) {

    /**
     * Scf_Admin class
     *
     * Class where we add all of the admins page
     *
     * @package    Scf_Admin
     * @author     Marko Radulovic <mradulovic988@gmail.com>
     */
    class Scf_Admin
    {
        public function __construct()
        {
            add_action( 'admin_menu', [ $this, 'addAdminPages' ] );
        }

        /**
         * Creating menu pages on Admin side
         *
         * @package     addAdminPages
         * @author      Marko Radulovic <mradulovic988@gmail.com>
         */
        public function addAdminPages()
        {
            add_menu_page(
                __( 'Shortcode Form', 'shortcode-form' ),
	            __( 'Shortcode Form', 'shortcode-form' ),
                'manage_options',
                'scf_shortcode_form',
                [
                    $this, 'UserListPage'
                ],
                'dashicons-feedback',
                50
            );

            add_submenu_page(
                'scf_shortcode_form',
                __( 'Form Subscriptions', 'shortcode-form' ),
	            __( 'Form Subscriptions', 'shortcode-form' ),
                'manage_options',
                'scf_shortcode_form',
                [
                    $this, 'UserListPage'
                ]
            );

            add_submenu_page(
                'scf_shortcode_form',
                __( 'Shortcode Examples', 'shortcode-form' ),
	            __( 'Shortcode Examples', 'shortcode-form' ),
                'manage_options',
                'scf_examples',
                [
                    $this, 'ShortcodeExamplePage'
                ]
            );
        }

        /**
         * Require user list page
         *
         * @package     UserListPage
         * @author      Marko Radulovic <mradulovic988@gmail.com>
         */
        public function UserListPage()
        {
            require_once PLUGIN_PATH . 'includes/Templates/UsersListPage.php';
        }

        /**
         * Require user example page
         *
         * @package     ShortcodeExamplePage
         * @author      Marko Radulovic <mradulovic988@gmail.com>
         */
        public function ShortcodeExamplePage()
        {
            require_once PLUGIN_PATH . 'includes/Templates/ShortcodeExamplePage.php';
        }

    }
}