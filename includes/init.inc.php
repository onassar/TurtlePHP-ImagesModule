<?php

    // closure (variable scope preservation)
    $closure = function() {

        // perform requirement checks
        require_once 'requirements.inc.php';

        // include class, controller
        require_once APP . '/vendors/TurtlePHP-ImagesModule/ImagesModule.class.php';
        require_once APP . '/vendors/TurtlePHP-ImagesModule/controllers/Images.class.php';

        // config
        require_once 'config.inc.php';

        // custom module routing
        require_once 'routes.inc.php';
    };

    // run/clear
    $closure();
    unset($closure);
