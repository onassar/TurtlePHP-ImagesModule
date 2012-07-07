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

        // maximum dimensions
        '^/modules/images/maximum/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'maximum',
            'view' => ($parent) . '/views/serve.inc.php'
        ),

        // minimum dimensions
        '^/modules/images/minimum/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'minimum',
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
