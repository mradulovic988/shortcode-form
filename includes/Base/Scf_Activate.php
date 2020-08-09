<?php
/**
 * Activation class
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc\Base
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

namespace Inc\Base;

if ( !class_exists( 'Scf_Activate' ) ) {

    /**
     * Scf_Activate activation class
     *
     * Activation plugin
     *
     * @package    Scf_Activate
     * @author     Marko Radulovic <mradulovic988@gmail.com>
     */
    class Scf_Activate
    {

        /**
         * Creating database on plugin activation
         *
         * @package     createDatabaseTable
         * @author      Marko Radulovic <mradulovic988@gmail.com>
         */
        public static function createDatabaseTable()
        {
            global $wpdb;

            $charset_collate = $wpdb->get_charset_collate();

            $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}shortcode_form` (
                id INT(255) NOT NULL AUTO_INCREMENT,
                first_name VARCHAR(20) NOT NULL,
                last_name VARCHAR(30) NOT NULL,
                email VARCHAR (50) NOT NULL,
                subject VARCHAR (50) NOT NULL,
                message TEXT NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            $success = empty($wpdb->last_error);

            return $success;
        }

        public static function activate()
        {
            flush_rewrite_rules();
        }

    }
}