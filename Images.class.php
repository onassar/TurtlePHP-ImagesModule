<?php

    // modules namespace
    namespace Modules;

    /**
     * ImagesModule
     * 
     * 
     * 
     * @author   Oliver Nassar <onassar@gmail.com>
     * @abstract
     */
    abstract class Images
    {
        /**
         * getConfig
         * 
         * @access public
         * @static
         * @return array
         */
        public static function getConfig()
        {
            // configuration settings
            $config = \Plugin\Config::retrieve();
            $config = $config['TurtlePHP-ImagesModule'];
            return $config;
        }
    }
