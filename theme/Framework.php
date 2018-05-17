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
        'snap_related_pages_widget_defaults' => 'override_related_pages_defaults',
        'snap_pagination_defaults' => 'override_snap_pagination_overrides'
    ];

    /**
     * Override the defaults of the WordPress related pages widget.
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

    /**
     * Add Bootstrap markup to snap_pagination default arguments
     *
     * @see Snap\Core\Modules\Pagination
     *
     * @param  array $args The default arguments
     * @return array       The altered arguments
     */
    public function override_snap_pagination_overrides($args)
    {
        $overrides = [
            'before_output'       => '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">',
            'link_wrapper'        => '<li class="page-item"><a class="page-link" href="%s">%s</a></li>',
            'active_link_wrapper' => '<li class="page-item active"><span class="page-link">%s</span></li>',
            'first_wrapper'       => '<li class="page-item"><a href="%s" class="page-link">' . __('First page', 'theme') . '</a></li>',
            'last_wrapper'        => '<li class="page-item"><a href="%s" class="page-link">' . __('Last page', 'theme') . '</a></li>',
            'next_wrapper'        => '<li class="page-item"><a href="%s" class="page-link">' . __('Next', 'theme') . '</a></li>',
            'previous_wrapper'    => '<li class="page-item"><a href="%s" class="page-link">' . __('Previous', 'theme') . '</a></li>',
        ];

        return wp_parse_args($overrides, $args);
    }
}
