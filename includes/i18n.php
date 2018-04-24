<?php

/**
 * Define theme support and features
 */


add_filter( 'locale', 'snap_redefine_locale' );
/**
 * The preferred way to set the locale of the site
 *
 * @see  https://codex.wordpress.org/Plugin_API/Filter_Reference/locale
 * @param  string $locale The current WP locale
 * @return string         The new locale
 */
function snap_redefine_locale( $locale ) {
    return $locale;
}