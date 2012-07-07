<?php

    // closure (variable scope preservation)
    $closure = function() {

        // grab parent directory
        $info = pathinfo(__DIR__);
        $parent = $info['dirname'];

        // perform requirement checks
        require_once 'requirements.inc.php';

        // include class, controller
        require_once ($parent) . '/Images.class.php';
        require_once ($parent) . '/controllers/Images.class.php';

        // config
        require_once 'config.inc.php';

        // custom module routing
        require_once 'routes.inc.php';
    };

    // run/clear
    $closure();
    unset($closure);
