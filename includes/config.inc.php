<?php

    // configuration init
    $sizes = array();

    /**
     * Features
     * 
     */

    // acceptable sizes/dimensions; wildcards (*) are allowed
    $sizes = array(
        'fit' => array('100x200', '200x100', '*'),
        'max' => array('48', '72', '96', '128', '*'),
        'min' => array('48', '72', '96', '128', '*'),
        'square' => array('48', '72', '96', '128', '*')
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
