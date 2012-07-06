<?php

    // configuration init
    $sizes = array();

    /**
     * Features
     * 
     */

    // acceptable sizes/dimensions; * wildcards are allowed
    $sizes = array(
        'resize' => array('48', '72', '96', '128', '256'),
        'square' => array('48', '72', '96', '128', '256')
    );

    // acceptable mimes; errors out otherwise
    $mimes = array(
        'image/jpeg',
        'image/png'
    );

    // config storage
    \Plugin\Config::add(
        'TurtlePHP-ImagesModule',
        array(
            'sizes' => $sizes,
            'mimes' => $mimes
        )
    );
