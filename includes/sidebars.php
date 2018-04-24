<?php

add_action( 'widgets_init', 'theme_slug_widgets_init' );
/**
 * Register theme dynamic sidebars
 * 
 */
function theme_slug_widgets_init() {
    register_sidebar( [
        'name' => __( 'Main Sidebar', 'snap' ),
        'id' => 'sidebar-main',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'snap' ),
        'before_widget' => '<div class="mb-4">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
    ] );
}

register_nav_menu( 'primary', 'The primary navigation for the site' );