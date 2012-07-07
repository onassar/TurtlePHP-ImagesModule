<?php

    // closure (variable scope preservation)
    $closure = function() {

        // grab parent directory
        $info = pathinfo(__DIR__);
        $parent = $info['dirname'];

        // include class, controller
        require_once ($parent) . '/Images.class.php';
        require_once ($parent) . '/controllers/Images.class.php';

        // flow includes
        require_once 'config.inc.php';
        require_once 'requirements.inc.php';
        require_once 'routes.inc.php';
    };

    // run/clear
    $closure();
    unset($closure);
