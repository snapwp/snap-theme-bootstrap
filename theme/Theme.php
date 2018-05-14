<?php

namespace Theme;

use Snap\Core\Hookable;
use Snap\Core\Modules\Assets;

/**
 * Setup theme.
 *
 * This means registering scripts, sidebars and menus.
 *
 * @since  1.0.0
 */
class Theme extends Hookable
{
	/**
     * Actions to add on init.
     *
     * @since 1.0.0
     * 
     * @var array
     */
	protected $actions = [
		'after_setup_theme' => 'register_theme_menus',
		'widgets_init' => 'register_theme_widgets',
		'wp_enqueue_scripts' => [
			'enqueue_theme_css',
			'enqueue_theme_scripts',
		],
	];

	public function __construct(Assets $assets)
	{
		$this->assets = $assets;
	}

 	/**
     * Enqueue the theme CSS files.
     *
     * @since 1.0.0
     */
	public function enqueue_theme_css()
	{
		wp_enqueue_style('bootstrap', $this->assets->get_asset_url('/assets/styles/css/style.css'));
	}		

	/**
     * Enqueue the theme Javascript files.
     *
     * @since 1.0.0
     */
	public function enqueue_theme_scripts()
	{
		wp_enqueue_script('bootstrap',  $this->assets->get_asset_url('/assets/js/min/theme.js'), ['jquery'], false, true);
	}

	/**
     * Register the theme's widgets.
     *
     * @since 1.0.0
     */
	public function register_theme_widgets()
	{
		register_sidebar([
	        'name' => __('Blog Sidebar', 'snap'),
	        'id' => 'sidebar-blog',
	        'description' => __('Widgets in this area will be shown on all posts only.', 'snap'),
	        'before_widget' => '<div class="mb-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
	    ]);

	    register_sidebar([
	        'name' => __('Page Sidebar', 'snap'),
	        'id' => 'sidebar-page',
	        'description' => __('Widgets in this area will be shown on all pages.', 'snap'),
	        'before_widget' => '<div class="mb-4">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>',
	    ]);
	}

	/**
     * Register the theme's navigation menus.
     *
     * @since 1.0.0
     */
	public function register_theme_menus()
	{
		register_nav_menus([
			'primary' => 'The primary navigation for the site',
		]);
	}	
}