<?php

/**
 * Enqueue your themes JS and CSS within this function as it is automatically run after the main snap assets enqueuer .
 *
 * You could of course delete this function and use your own filter, 
 * just be sure to set the priority higher than 10 so it runs after the snap enqueuer.
 *
 * As this is the Bootstrap child, the CDN versions of Bootstrap css/js have been included,
 * but we imagine  you will want to remove these and use a local version with your own build tools.
 */
function register_child_assets() {
	wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/styles/css/style.css' );
	wp_enqueue_script('bootstrap',  get_stylesheet_directory_uri() . '/assets/js/min/theme.js', ['jquery'], false, true);
}
