<?php

namespace Theme;

use Snap\Core\Hookable;

/**
 * Example WP_Hookable class.
 *
 * 
 */
class Example extends Hookable {

	protected $filters = [
		'wp_footer' => 'example_hook',
	];	

	protected $actions = [
	//	'wp_enqueue_scripts' => [
	//		10 => 'example_hook_1',
	//		20 => [
	//			'example_hook_2',
	//			'example_hook_3',
	//		],
	//	]
	];

	
	protected function boot() {
		// code...
	}

	protected function after_boot() {
		// code...
	}

	/**
	 * Dummy callback example.
	 */
	function example_hook() {
		echo '<!-- Don\'t forget to delete includes/class-example.php! -->';
	}	
}