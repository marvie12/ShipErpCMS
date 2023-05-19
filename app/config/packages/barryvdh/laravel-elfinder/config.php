<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */

    'dir' => 'images',

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' => array(
        array(
            'driver' => 'LocalFileSystem',
            'path' => getenv('BASE_PATH').'/images',
            'URL' => getenv('BASE_URL').'/images',
            'alias' => '/images',
            'mimeDetect' => 'internal',
            'imgLib' => 'gd',
            'tmbPath' => 'thumbnails',
            'tmbCrop' => false,
            'defaults' => array('read' => false, 'write' => true),
            'attributes' => array(
                array( // hide readmes
                    'pattern' => '/README/',
                    'read' => false,
                    'write' => false,
                    'hidden' => true,
                    'locked' => false,
                ),
            ),
        ),
    ),

    /*
    |--------------------------------------------------------------------------
    | CSRF
    |--------------------------------------------------------------------------
    |
    | CSRF in a state by default false.
    | If you want to use CSRF it can be replaced with true (boolean).
    |
    */

    'csrf' => null,

);
