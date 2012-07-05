<?php

    // closure (variable scope preservation)
    $closure = function() {

        // include controller
        require_once APP . '/vendors/TurtlePHP-ImagesModule/controllers/Images.class.php';

        // custom module routing
        require_once 'routes.inc.php';
    };

    // run/clear
    $closure();
    unset($closure);
