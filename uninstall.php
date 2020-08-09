<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 * @package    shortcode-form
 */
if ( !defined( 'WP_UNINSTALL_PLUGIN' )) { die; }

global $wpdb;

$table = $wpdb->prefix . 'shortcode_form';
$query = "DROP TABLE IF EXISTS $table";
$wpdb->query($query);

flush_rewrite_rules();