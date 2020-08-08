<?php
/**
 * Initialization class.
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    Inc
 * @subpackage shortcode-form/Public
 */

namespace Inc;

/**
 * SfInit initialization class
 *
 * Execute all class inside include folder
 *
 * @package    Scf_Init
 * @subpackage shortcode-form/Public
 * @author     Marko <mradulovic988@gmail.com>
 */
if ( !class_exists( 'Scf_Init' ) ) {

    /**
     * SfInit final class to initialize code
     *
     * Initialize code
     *
     * @package    SfInit
     * @author     Marko Radulovic <mradulovic988@gmail.com>
     */
    final class Scf_Init
    {

        /**
         * Initialize the class and set its properties.
         *
         * @since    1.0.0
         */
        public function __construct()
        {
        }

        /**
         * Store all the classes inside an array
         *
         * @return array Full list of classes
         */
        public static function getServices()
        {
            return [
                Base\Scf_Activate::class,
                Base\Scf_Enqueue::class,
                Pages\Scf_Admin::class,
	            Base\Scf_Shortcodes::class,
	            Base\Scf_Functions::class,
	            Base\Scf_SettingLinks::class
            ];
        }

        /**
         * Loop through the classes, initialize them, and call the
         * register() method if it exists
         *
         * @return
         */
        public static function registerServices()
        {
            foreach (self::getServices() as $class) {
                $service = self::instantiate($class);

                if (method_exists($service, 'register')) {
                    $service->register();
                }
            }
        }

        /**
         * Initialize the class
         *
         * @param class $class class from the services array
         * @return class instance new instance of the class
         */
        private static function instantiate($class)
        {
            $service = new $class();
            return $service;
        }
    }
}