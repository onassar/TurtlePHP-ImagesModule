<?php

    // add module routes to application
    \Turtle\Application::addRoutes(array(

        /**
         * Images
         * 
         */

        // resizing
        '^/modules/images/resize/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\ImagesModule\Images',
            'action' => 'resize',
            'view' => APP . '/vendors/TurtlePHP-ImagesModule/views/serve.inc.php'
        ),

        // squaring
        '^/modules/images/square/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\ImagesModule\Images',
            'action' => 'square',
            'view' => APP . '/vendors/TurtlePHP-ImagesModule/views/serve.inc.php'
        )
    ));
