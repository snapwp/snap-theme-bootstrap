<?php

namespace Theme\Walkers;

use Walker_Comment;

/**
 * Comment list Walker.
 */
class Comment extends Walker_Comment
{
    /**
     * Starts the list before the elements are added.
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
     */
    public function start_lvl(&$output, $depth = 0, $args = [])
    {
        $GLOBALS['comment_depth'] = $depth + 1;

        switch ($args['style']) {
            case 'div':
                break;
            case 'ol':
                $output .= '<ol class="list-unstyled pl-4 pl-md-5">' . "\n";
                break;
            case 'ul':
            default:
                $output .= '<ul class="list-unstyled pl-4 pl-md-5">' . "\n";
                break;
        }
    }

    /**
     * Ends the element output, if needed.
     *
     * @since 2.7.0
     *
     * @see   Walker::end_el()
     * @see   wp_list_comments()
     *
     * @param string     $output  Used to append additional content. Passed by reference.
     * @param \WP_Comment $comment The current comment object. Default current comment.
     * @param int        $depth   Optional. Depth of the current comment. Default 0.
     * @param array      $args    Optional. An array of arguments. Default empty array.
     */
    public function end_el(&$output, $comment, $depth = 0, $args = array())
    {
        if (!empty($args['end-callback'])) {
            ob_start();
            call_user_func($args['end-callback'], $comment, $args, $depth);
            $output .= ob_get_clean();
            return;
        }
        if ('div' == $args['style'])
            $output .= "</div></div>\n";
        else
            $output .= "</div></li>\n";
    }

    /**
     * Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see   wp_list_comments()
     *
     * @param \WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment($comment, $depth, $args)
    {
        $tag = ('div' === $args['style']) ? 'div' : 'li';
        ?>

        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>"  itemscope itemtype="http://schema.org/UserComments" <?php comment_class($this->has_children ? 'parent ' : '', $comment); ?>>

        <div class="comment-body">
            <div class="card mt-3" id="div-comment-<?php comment_ID(); ?>">
                <div class="card-header">
                    <?php
                    if (0 != $args['avatar_size']) {
                        echo get_avatar(
                            $comment,
                            $args['avatar_size'],
                            get_option( 'avatar_default', 'mystery' ),
                            '',
                            [
                                'class' => 'float-right ml-2 ml-md-3'
                            ]
                        );
                    }
                    ?>

                    <span itemprop="creator" itemscope itemtype="http://schema.org/Person">
                        <span itemprop="name"><?php echo get_comment_author_link($comment);?></span>
                    </span>

                    <?php
                    if ($comment->user_id === $comment->post_author) {
                        echo ' <span class="badge badge-secondary">Author</span>';
                    }
                    ?>

                    <?php if ('0' == $comment->comment_approved) : ?>
                        <span class="comment-awaiting-moderation badge badge-warning"><?php _e('Awaiting moderation.'); ?></span>
                    <?php endif; ?>

                    <div>
                        <small class="text-muted text-capitalize">
                            <time itemprop="commentTime" datetime="<?php echo get_comment_time('c'); ?>">
                                <?php echo human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ); ?> ago
                            </time>
                        </small>
                    </div>
                </div>

                <div class="card-body">
                    <div itemprop="commentText">
                        <?php comment_text(); ?>
                    </div>

                    <div>
                        <?php
                        edit_comment_link(__('Edit'), '<span class="edit-link">', '</span> ');

                        comment_reply_link(array_merge($args, array(
                            'add_below' => 'div-comment',
                            'depth' => $depth,
                            'max_depth' => $args['max_depth'],
                            'before' => '<span class="reply">',
                            'after' => '</span>'
                        )));
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }
}
