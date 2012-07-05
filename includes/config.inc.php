<?php

    // configuration init
    $sizes = array();

    /**
     * Features
     * 
     */
    $sizes = array(
        'resize' => array('48', '72', '96', '128', '256'),
        'square' => array('48', '72', '96', '128', '256')
    );

    // config storage
    \Plugin\Config::add(
        'TurtlePHP-ImagesModule',
        array(
            'sizes' => $sizes
        )
    );
