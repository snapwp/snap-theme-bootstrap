<?php

namespace Theme;

use Snap\Core\Hookable;

/**
 * Adds Bootstrap 4 markup where possible.
 */
class Framework extends Hookable
{
    /**
     * Filters to add on init.
     *
     * @var array
     */
    public $filters = [
        'snap_related_pages_widget_defaults' => 'override_related_pages_defaults'
    ];

    /**
     * Override the defaults of the related pages widget.
     *
     * @param  array $defaults The default arguments.
     * @return array
     */
    public function override_related_pages_defaults($defaults)
    {
        $defaults['container_start'] = '<ul class="nav flex-column nav-pills" role="navigation">';
        $defaults['li_class'] = 'nav-item';
        $defaults['link_class'] = 'nav-link';
        return $defaults;
    }
}
