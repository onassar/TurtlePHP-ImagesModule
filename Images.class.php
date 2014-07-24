<?php

    // modules namespace
    namespace Modules;

    /**
     * ImagesModule
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

        /**
         * setConfig
         * 
         * @access public
         * @static
         * @param  array $config
         * @return void
         */
        public static function setConfig(array $config)
        {
            $global = \Plugin\Config::retrieve();
            $global['TurtlePHP-ImagesModule'] = $config;
            \Plugin\Config::store($global);
        }
    }
