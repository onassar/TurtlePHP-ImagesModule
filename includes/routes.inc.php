<?php

    // grab parent directory
    $info = pathinfo(__DIR__);
    $parent = $info['dirname'];

    // add module routes to application
    \Turtle\Application::addRoutes(array(

        /**
         * Images
         * 
         */

        // fit
        '^/modules/images/fit/([0-9]+)/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'fit',
            'view' => ($parent) . '/views/serve.inc.php'
        ),

        // maximum dimensions
        '^/modules/images/max/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'max',
            'view' => ($parent) . '/views/serve.inc.php'
        ),

        // minimum dimensions
        '^/modules/images/min/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'min',
            'view' => ($parent) . '/views/serve.inc.php'
        ),

        // squaring
        '^/modules/images/square/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'square',
            'view' => ($parent) . '/views/serve.inc.php'
        )
    ));
