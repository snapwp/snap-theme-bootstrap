<?php

namespace Theme;

use Snap\Core\Hookable;

/**
 * Adds Bootstrap 4 markup where possible.
 */
class Bootstrap extends Hookable
{
    /**
     * Filters to add on init.
     *
     * @var array
     */
    public $filters = [
        'snap_related_pages_widget_defaults' => 'override_related_pages_defaults',
        'snap_pagination_defaults' => 'override_snap_pagination_overrides',

        // Ensure content HTML uses Bootstrap markup.
        'embed_oembed_html' => 'make_oembeds_responsive',
        'the_content' => [
            'inject_content_classes',
            'add_bootrap_markup_to_images',
        ],
        'img_caption_shortcode' => 'wrap_captions',
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

    /**
     * Wraps oembeds in a <figure>, and applies the responsive embed classes.
     *
     * @see https://getbootstrap.com/docs/4.0/utilities/embed/
     *
     * @param  string $html Oembed HTML.
     * @return string  Altered oembed HTML.
     */
    public function make_oembeds_responsive($html)
    {
        return '<figure class="embed-responsive embed-responsive-16by9">' . $html . '</figure>';
    }

    public function inject_content_classes($html)
    {
        if (strpos($html, '<blockquote') !== false) {
            $html = preg_replace('/(<blockquote([^>]*))>/', "$1 class=\"blockquote\"", $html);
        }       

        if (strpos($html, '<table') !== false) {
            $html = preg_replace('/(<table([^>]*))>/', "$1 class=\"table\"", $html);
        }

        return $html;
    }

    /**
     * Wrap post content images in a figure, annd add bootstrap classes to them to sort out alignment issues.
     *
     * @param  string $content The page content.
     * @return string Modified page content.
     */
    public function add_bootrap_markup_to_images($content)
    {
        preg_match_all('#<img[^>]*class="[^"]*"[^>]*>#', $content, $matches);

        if (isset($matches[0]) && ! empty($matches[0])) {
            foreach ($matches[0] as $k => $v) {
                $img_class = str_replace('class="', 'class="img-fluid ', $matches[0][$k]);

                if (strpos($v, 'aligncenter') !== false) {
                    $content = str_replace($matches[0][$k], '<figure class="figure text-center d-block">' . $img_class . '</figure>', $content);
                } elseif (strpos($v, 'alignleft') !== false) {
                    $content = str_replace($matches[0][$k], '<figure class="figure float-sm-none float-md-left text-center mr-md-3 d-block">' . $img_class . '</figure>', $content);
                } elseif (strpos($v, 'alignright') !== false) {
                    $content = str_replace($matches[0][$k], '<figure class="figure float-sm-none float-md-right text-center ml-md-3 d-block">' . $img_class . '</figure>', $content);
                } elseif (strpos($v, 'alignnone') !== false) {
                    $content = str_replace($matches[0][$k], '<figure class="figure text-center text-md-left d-block">' . $img_class . '</figure>', $content);
                }
            }
        }

        // wrapping things in figures can cause stray <p> tagsm, so we need to remove
        $content = str_replace([ '<p><figure', '</figure></p>' ], [ '<figure', '</figure>' ], $content);

        return $content;
    }

    /**
     * Wrap all images with captions in .figure and respect the alignment
     *
     * @param  string $empty   Empty string
     * @param  array  $attr    Attributes attributed to the image
     * @param  string $content Image content
     * @return string Bootstrap figure markup
     */
    public function wrap_captions($empty, $attr, $content)
    {
        // ensure all images are responsive and have the correct classes to be in a figure
        $content = str_replace('class="', 'class="img-fluid figure-img ', $content);

        switch ($attr['align']) {
            case 'alignleft':
                return '<figure class="figure float-sm-none float-md-left text-center mr-md-3 d-block">' . $content . '<figcaption class="figure-caption text-center text-md-left">' . $attr['caption'] . '</figcaption></figure>';
                break;
            case 'alignright':
                return '<figure class="figure float-sm-none float-md-right text-center ml-md-3 d-block">' . $content . '<figcaption class="figure-caption text-center text-md-right">' . $attr['caption'] . '</figcaption></figure>';
                break;
            case 'aligncenter':
                return '<figure class="figure text-center d-block">' . $content . '<figcaption class="figure-caption">' . $attr['caption'] . '</figcaption></figure>';
                break;
            case 'alignnone':
                return '<figure class="figure text-center text-md-left d-block">' . $content . '<figcaption class="figure-caption">' . $attr['caption'] . '</figcaption></figure>';
                break;
        }
    }
}
