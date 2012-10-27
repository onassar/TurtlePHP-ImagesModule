<?php

    /**
     * Class Requirements
     * 
     */

    // required classes
    $required = array(
        'Image' => 'PHP-ImageHelper',
        'ImageEffects\Image' => 'PHP-ImageEffects',
        '\Plugin\Config' => 'TurtlePHP-ConfigPlugin'
    );

    // perform checks
    foreach ($required as $class => $package) {

        // not found
        if (!class_exists($class)) {

            // error out
            throw new Exception(
                'Class *' . ($class) . '* couldn\'t be found. Ensure it, and ' .
                'it\'s associated library (' . ($package) . ') are properly ' .
                'included.'
            );
        }
    }
