<?php

namespace Theme\Posts;

use Snap\Core\Post_Type;

/**
 * [Post_Type desciption]
 */
class Test extends Post_Type
{
	public $options = [
		'rewrite' => ['slug' => 'dunk']
	];

	public $taxonomies = [
		'test'
	];
}