<?php
/**
 * ScfAdmin class
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
     * ScfAdmin class
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
                'Shortcode Form',
                'Shortcode Form',
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
                'Users List',
                'Users List',
                'manage_options',
                'scf_shortcode_form',
                [
                    $this, 'UserListPage'
                ]
            );

            add_submenu_page(
                'scf_shortcode_form',
                'Shortcode Examples',
                'Shortcode Examples',
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