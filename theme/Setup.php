<?php

namespace Theme;

use Snap\Core\Application;

/**
 * Setup theme.
 *
 * This means registering scripts, sidebars and menus.
 */
class Setup extends Application
{
    /**
     * Actions to add on init.
     *
     * @since 1.0.0
     * @var array
     */
    protected $actions = [
        'widgets_init' => 'register_theme_widgets',
        'wp_enqueue_scripts' => 'enqueue_theme_assets',
    ];

    /**
     * Declare theme support.
     *
     * Keys are the feature to enable, and values are any additional arguments to pass to add_theme_support().
     *
     * @since  1.0.0
     * @var array
     */
    protected $supports = [
        'woocommerce'
    ];    

    /**
     * Declare theme menus.
     *
     * @since  1.0.0
     * @var array
     */
    protected $menus = [
        'primary' => 'The primary navigation for the site',
    ];

    /**
     * Enqueue the theme CSS files.
     *
     * @since 1.0.0
     */
    public function enqueue_theme_assets()
    {
        wp_enqueue_style('bootstrap', snap_get_asset_url('/css/style.css'));
        wp_enqueue_script('bootstrap', snap_get_asset_url('/scripts/theme.js'), ['jquery'], false, true);
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
}
