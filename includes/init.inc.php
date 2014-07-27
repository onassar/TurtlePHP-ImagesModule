<?php

    // namespaces
    namespace Modules\Images;

    // closure (variable scope preservation)
    $closure = function() {

        // grab parent directory
        $info = pathinfo(__DIR__);
        $parent = $info['dirname'];

        // module path
        DEFINE(__NAMESPACE__ . '\MODULE', $parent);

        // include class, controller
        require_once MODULE . '/Images.class.php';
        require_once MODULE . '/controllers/Images.class.php';

        // flow includes
        require_once 'requirements.inc.php';
        require_once 'config.inc.php';
        require_once 'routes.inc.php';
    };

    // run/clear
    $closure();
    unset($closure);
