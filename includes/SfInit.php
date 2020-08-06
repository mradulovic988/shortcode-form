<?php
/**
 * Initialization class.
 *
 * @link       www.samplelink.com
 * @since      1.0.0
 *
 * @package    shortcode-form
 * @subpackage shortcode-form/public
 */

namespace Inc;

/**
 * SfInit initialization class
 *
 * Execute all class inside include folder
 *
 * @package    shortcode-form
 * @subpackage shortcode-form/public
 * @author     Marko <mradulovic988@gmail.com>
 */
if ( !class_exists( 'SfInit' ) ) {

    /**
     * SfInit final class to initialize code
     *
     * Initialize code
     *
     * @package    SfInit
     * @author     Marko Radulovic <mradulovic988@gmail.com>
     */
    final class SfInit
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
                Base\SfActivate::class,
                Base\SfEnqueue::class
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