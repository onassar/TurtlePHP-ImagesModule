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

        // resizing
        '^/modules/images/resize/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'resize',
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
