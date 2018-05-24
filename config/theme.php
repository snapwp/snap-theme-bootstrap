<?php

return [
    /*
     * If true sets the `xmlrpc_enabled` filter to return false.
     * XMLRPC is only really used these days if Jetpack is installed, and can otherwise be a potential security hole.
     */
	'disable_xmlrpc' => true,

    'disable_comments'      => false,

    'enable_whoops' => false,

    'remove_asset_versions' => true,

    'defer_scripts' => true,

    'defer_scripts_skip' => [],

    'use_jquery_cdn'  => '3.2.1',

    'snap_modules' => [

    ]

];