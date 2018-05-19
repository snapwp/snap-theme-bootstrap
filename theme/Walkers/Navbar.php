<?php

namespace Theme\Walkers;

use Walker_Nav_Menu;

/**
 * A simple Bootstrap 4 navbar walker.
 *
 * Adapted from https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 */
class Navbar extends Walker_Nav_Menu
{
    /**
     * Whether the current level is a dropdown or not.
     * 
     * @since 1.0.0
     * @var type bool
     */
    private $dropdown = false;

    /**
     * Whether the items_wrap contains schema microdata or not.
     * 
     * @since 1.0.0
     * @var type bool
     */
    private $has_schema = false;

    /**
     * Ensure the items_Wrap argument contains microdata.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if (! has_filter('wp_nav_menu_args', [$this, 'add_scehma_to_navbar_ul'])) {
            add_filter( 'wp_nav_menu_args',  [$this, 'add_scehma_to_navbar_ul']);
        }
    }

    /**
     * Filter to ensure the items_Wrap argument contains microdata.
     *
     * @since 1.0.0
     *
     * @param  array $args The nav instance arguments.
     * @return array $args The altered nav instance arguments.
     */
    public function add_scehma_to_navbar_ul($args)
    {
        $wrap = $args['items_wrap'];

        if (strpos($wrap, 'SiteNavigationElement') === false) {
            $args['items_wrap'] = preg_replace('/(>).*>?\%3\$s/', " itemscope itemtype=\"http://www.schema.org/SiteNavigationElement\"$0", $wrap);
        }

        return $args;
    }

    /**
     * Starts the list before the elements are added.
     *
     * @since 1.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $t = "\t";
        $n = "\n";

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = $n ='';
        }

        $this->dropdown = true;
        $output .= $n . str_repeat($t, $depth) . '<div class="dropdown-menu" role="menu">' . $n;
    }

    /**
     * Ends the list of after the elements are added.
     *
     * @since 1.0.0
     *
     * @see Walker::end_lvl()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_lvl(&$output, $depth = 0, $args = [])
    {
        $t = "\t";
        $n = "\n";

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = $n ='';
        }

        $this->dropdown = false;
        $output .= $n . str_repeat($t, $depth) . '</div>' . $n;
    }

    /**
     * Starts the element output.
     *
     * @since 1.0.0
     *
     * @see Walker::start_el()
     *
     * @param string   $output Passed by reference. Used to append additional content.
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item. Used for padding.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
        $t = "\t";
        $n = "\n";

        if (strpos($args->items_wrap, 'itemscope') !== false && $this->has_schema === false) {
            $this->has_schema = true;
            $args->link_before = '<span itemprop="name">' . $args->link_before;
            $args->link_after .= '</span>';
        }

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = $n = '';
        }

        $indent = str_repeat($t, $depth);

        if (0 === strcasecmp($item->attr_title, 'divider') && $this->dropdown) {
            $output .= $indent . '<div class="dropdown-divider"></div>' . $n;
            return;
        } elseif (0 === strcasecmp($item->title, 'divider') && $this->dropdown) {
            $output .= $indent . '<div class="dropdown-divider"></div>' . $n;
            return;
        }

        $classes = empty($item->classes) ? [] : (array) $item->classes;

        $classes = array_diff(
            $classes,
            [
                'menu-item',
                'current_page_parent',
                'current_page_ancestor',
                'menu-item-has-children',
                'current_page_item',
                'menu-item-type-post_type',
                'menu-item-object-page',
            ]
        );

        $classes[] = 'nav-item';

        if (in_array('current-menu-item', $classes) || in_Array('current-menu-ancestor', $classes)) {
            $classes[] ='active';
        }

        if ($args->walker->has_children) {
            $classes[] = 'dropdown';
        }

        if (0 < $depth) {
            $classes[] = 'dropdown-menu';
        }

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @since 1.0.0
         *
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param WP_Post  $item  Menu item data object.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        /**
         * Filters the CSS class(es) applied to a menu item's list item element.
         *
         * @since 1.0.0
         *
         * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        /**
         * Filters the ID applied to a menu item's list item element.
         *
         * @since 1.0.0
         *
         * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
         * @param WP_Post  $item    The current menu item.
         * @param stdClass $args    An object of wp_nav_menu() arguments.
         * @param int      $depth   Depth of menu item. Used for padding.
         */
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        if ( !$this->dropdown) {
            $output .= $indent . '<li' . $id . $class_names . '>' . $n . $indent . $t;
        }

        $atts = [];
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
        $atts['href'] = !empty($item->url) ? $item->url : '';

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @since 1.0.0
         *
         * @param array $atts {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         *     @type string $title  Title attribute.
         *     @type string $target Target attribute.
         *     @type string $rel    The rel attribute.
         *     @type string $href   The href attribute.
         * }
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        if ($args->walker->has_children) {
            $atts['data-toggle']   = 'dropdown';
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        if ($this->has_schema === true) {
            $atts['itemprop'] = 'url';
        }

        $attributes = '';

        foreach ($atts as $attr => $value) {
            if (! empty($value)) {
                $value = ( 'href' === $attr ) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /**
         * Filter the item title.
         *
         * @since 1.0.0
         * 
         * @see wp-includes/post-template.php
         */
        $title = apply_filters('the_title', $item->title, $item->ID);

        /**
         * Filters a menu item's title.
         *
         * @since 1.0.0
         *
         * @param string   $title The menu item's title.
         * @param WP_Post  $item  The current menu item.
         * @param stdClass $args  An object of wp_nav_menu() arguments.
         * @param int      $depth Depth of menu item. Used for padding.
         */
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_classes = empty($item->classes) ? [ 'nav-link' ] : array_merge([ 'nav-link' ], (array) $item->classes);

        if (in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes)) {
            $item_classes[] ='active';
        }

        if ($args->walker->has_children) {
            $item_classes[] = 'dropdown-toggle';
        }

        if (0 < $depth) {
            $item_classes[] = 'dropdown-item';
        }

        $item_classes = array_diff(
            $item_classes,
            [
                'menu-item-has-children',
                'current_page_ancestor',
                'current_page_parent',
                'current-page-parent',
                'current-menu-parent',
                'current-page-ancestor',
                'current-menu-ancestor',
                'menu-item',
                'menu-item-type-post_type',
                'menu-item-object-page',
            ]
        );

        $item_output = $args->before;
        $item_output .= '<a class="' . implode(' ', $item_classes) . '" ' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        /**
         * Filters a menu item's starting output.
         *
         * @since 1.0.0
         *
         * @param string   $item_output The menu item's starting HTML output.
         * @param WP_Post  $item        Menu item data object.
         * @param int      $depth       Depth of menu item. Used for padding.
         * @param stdClass $args        An object of wp_nav_menu() arguments.
         */
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

  /**
   * Ends the element output, if needed.
   *
   * @since 1.0.0
   *
   * @see Walker::end_el()
   *
   * @param string   $output Passed by reference. Used to append additional content.
   * @param WP_Post  $item   Page data object. Not used.
   * @param int      $depth  Depth of page. Not Used.
   * @param stdClass $args   An object of wp_nav_menu() arguments.
   */
    public function end_el(&$output, $item, $depth = 0, $args = [])
    {
        $t = "\t";
        $n = "\n";

        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = $n = '';
        }

        $output .= $this->dropdown ? '' : str_repeat($t, $depth) . '</li>' . $n;
    }

    /**
     * Menu Fallback
     *
     * @since 1.0.0
     *
     * @param array $args passed from the wp_nav_menu function.
     */
    public static function fallback($args)
    {
        if (current_user_can('edit_theme_options')) {
            $defaults = [
                'container'       => 'div',
                'container_id'    => false,
                'container_class' => false,
                'menu_class'      => 'menu',
                'menu_id'         => false,
            ];

            $args = wp_parse_args($args, $defaults);

            if (! empty($args['container'])) {
                echo sprintf('<%s id="%s" class="%s">', $args['container'], $args['container_id'], $args['container_class']);
            }

            echo sprintf(
                '<ul id="%s" class="%s"><li class="nav-item"><a href="%s" class="nav-link">%s</a></li>ul>', 
                $args['container_id'], 
                $args['container_class'],
                admin_url('nav-menus.php'),
                __('Add a menu', 'snap')
            );

            if (! empty($args['container'])) {
                echo sprintf('</%s>', $args['container']);
            }
        }
    }
}
