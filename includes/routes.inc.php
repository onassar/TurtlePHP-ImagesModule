<?php

    // namespaces
    namespace Modules\Images;

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
            'action' => 'actionFit',
            'view' => MODULE . '/views/raw.inc.php'
        ),

        // maximum dimensions
        '^/modules/images/max/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'actionMax',
            'view' => MODULE . '/views/raw.inc.php'
        ),

        // minimum dimensions
        '^/modules/images/min/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'actionMin',
            'view' => MODULE . '/views/raw.inc.php'
        ),

        // squaring
        '^/modules/images/square/([0-9]+)/' => array(
            'module' => true,
            'controller' => '\Modules\Images\Images',
            'action' => 'actionSquare',
            'view' => MODULE . '/views/raw.inc.php'
        )
    ));
