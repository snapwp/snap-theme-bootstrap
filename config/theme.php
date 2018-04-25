<?php

return [
    /*
     * If true sets the `xmlrpc_enabled` filter to return false.
     * XMLRPC is only really used these days if Jetpack is installed, and can otherwise be a potential security hole.
     */
	'disable_xmlrpc' => true,

    'disable_comments'      => false,

    /**
     * The default upload quality of image media.
     * Smaller numbers give smaller uploaded image sizes, but with reduced image quality. 
     * Setting to 100 will actually increase uploaded image size!
     */
    'default_image_quality' => 75,

    'remove_asset_versions' => true,

    'defer_scripts' => true,

    'defer_scripts_skip' => [],

    'use_jquery_cdn'  => '3.2.1',

    'img_placholder_dir' => 'assets/images/',

    'enable_thumbnails' => [],

    'reset_image_sizes' => false,

    'insert_image_default_size' => 'medium_large',
];