<?php

namespace Theme;

use Snap\Core\Hookable;

/**
 * Setup theme.
 *
 * This means registering scripts, sidebars and menus.
 *
 * @since  1.0.0
 */
class I18n extends Hookable
{
    /**
     * Actions to add on init.
     *
     * @since 1.0.0
     * @var array
     */
    protected $filters = [
        'locale' => 'set_locale'
    ];

    /**
     * The preferred way to set the locale of the site
     *
     * @see  https://codex.wordpress.org/Plugin_API/Filter_Reference/locale
     * @since  1.0.0
     *
     * @param  string $locale The current WP locale
     * @return string         The new locale
     */
    public function set_locale($locale)
    {
        return $locale;
    }
}
