<?php

return [
    /*
     * If true sets the `xmlrpc_enabled` filter to return false.
     * XMLRPC is only really used these days if Jetpack is installed, and can otherwise be a potential security hole.
     */
	'disable_xmlrpc' => true,


    /**
     * Disable comments site wide.
     */
    'disable_comments' => true,


    /**
     * Disable the customizer in the admin.
     */
    'disable_customizer' => true,


    'enable_whoops' => false,


    /**
     * Whether to use the asset version strings added by wp_enqueue_script/style functions.
     */
    'remove_asset_versions' => true,


    /**
     * If true, then snap will put defer="true" on enqueued javascript.
     */
    'defer_scripts' => true,


    /**
     * An array of the script handles to not add defer to.
     *
     * Very useful for jQuery if a plugin adds inline js which relies on jQuery existing globally.
     */
    'defer_scripts_skip' => [
        //'jquery',
    ],


    /**
     * If not false, then load this version of jquery via the Google CDN.
     */
    'use_jquery_cdn'  => '3.2.1',
    
    /**
     * Set to true to use the snap admin theme.
     *
     * As well as graphical changes, the admin theme also reorders the page menu link to be above posts, and cleans
     * the admin bar.
     */
    'snap_admin_theme' => true,
];