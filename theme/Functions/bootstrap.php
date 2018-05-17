<?php




add_filter('embed_oembed_html', 'snap_bootstrap_oembed_filter', 10, 4);
/**
 * Wraps oembeds in a <figure> and applies the responsive embed classes
 *
 * @see https://getbootstrap.com/docs/4.0/utilities/embed/
 * @return  string  Altered oembed code
 */
function snap_bootstrap_oembed_filter($html, $url, $attr, $post_ID)
{
    return '<figure class="embed-responsive embed-responsive-16by9">' . $html . '</figure>';
}


add_filter('the_content', 'snap_bootstrap_the_content_img_classes');
/**
 * Wrap post content images in a figure, annd add bootstrap classes to them to sort out alignment issues.
 *
 * @since  1.2.2
 * @param  string $content The page content
 * @return string          Modified page content
 */
function snap_bootstrap_the_content_img_classes($content)
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


add_filter('img_caption_shortcode', 'snap_bootstrap_wrap_captions', 10, 3);
/**
 * Wrap all images with captions in .figure and respect the alignment
 *
 * @param  string $empty   Empty string
 * @param  array  $attr    Attributes attributed to the image
 * @param  string $content Image content
 * @return string          Bootstrap figure markup
 */
function snap_bootstrap_wrap_captions($empty, $attr, $content)
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
