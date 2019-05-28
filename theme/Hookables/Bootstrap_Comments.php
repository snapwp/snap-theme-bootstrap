<?php

namespace Theme\Hookables;

use Snap\Core\Hookable;
use Snap\Services\Config;

/**
 * Adds basic bootstrap markup to comments and ensures comment functions work nicely with SnapWP.
 */
class Bootstrap_Comments extends Hookable
{
    /**
     * Do not run this on admin requests.
     *
     * @var boolean
     */
    protected $admin = false;

    /**
     * Register the hooks only if comments are enabled.
     */
    public function boot()
    {
        if (Config::get('theme.disable_comments') === false) {
            $this->addFilter('comment_form_defaults', 'add_bootstrap_markup_to_comments_form');
            $this->addFilter('wp_list_comments_args', 'wp_list_comments_args');
            $this->addFilter('comment_text', 'comment_text', 99);

            $this->addAction('comment_form_before', 'comment_form_before');
            $this->addAction('comment_form_after', 'comment_form_after');
        }
    }

    /**
     * Change the defaults of the comment_form.
     *
     * @param array $args
     * @return array
     */
    public function add_bootstrap_markup_to_comments_form($args)
    {
        $args['title_reply_before']  = '<h3 id="reply-title" class="comment-reply-title mt-3">';

        $args['comment_field'] = '<div class="form-group">'
            . '<label for="comment">Comment</label>'
            . '<textarea id="comment" name="comment" class="form-control" rows="5" maxlength="65525" required="required"></textarea>'
            . '</div>';

        $args['submit_button'] = '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary" value="%4$s" />';

        $commenter = \wp_get_current_commenter();
        $req = \get_option('require_name_email');
        $html_req = ( $req ? " required='required'" : '' );

        // Apply bootstrap form classes to fields, and remove the url field completely.
        $args['fields'] = [
            'url' => '',
            'author' => '<div class="row"><div class="form-group col-md-6">'
                . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label>'
                . '<input id="author" name="author" type="text" value="' . \esc_attr( $commenter['comment_author'] ) . '" class="form-control" maxlength="245" ' . $html_req . ' />'
                . '</div>',
            'email' => '<div class="form-group col-md-6">'
                . '<label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> '
                . '<input id="email" name="email" type="email" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" maxlength="100" aria-describedby="email-notes" ' . $html_req . ' />'
                . '</div></div>',
        ];

        // Format the cookie policy checkbox.
        if (
            \has_action( 'set_comment_cookies', 'wp_set_comment_cookies' )
            && \get_option( 'show_comments_cookies_opt_in' )
        ) {
            $consent = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';

            $fields['cookies'] = '<div class="form-group">'
                . '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $consent . '/>'
                . '<label for="wp-comment-cookies-consent"> ' . __( 'Save my name, email, and website in this browser for the next time I comment.' ) . '</label>'
                . '</div>';

            // Ensure that the passed fields include cookies consent.
            if ( isset( $args['fields'] ) && ! isset( $args['fields']['cookies'] ) ) {
                $args['fields']['cookies'] = $fields['cookies'];
            }
        }

        // Add text-muted to comment notes.
        $args["comment_notes_before"] = '<p class="comment-notes">'
            . '<small class="form-text text-muted">'
            . '<span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span>'
            . '</small>'
            . '</p>';

        return $args;
    }

    /**
     * Add the bootstrap walker by default to wp_list_comments.
     *
     * @param array $args
     * @return array
     */
    public function wp_list_comments_args($args)
    {
        $replacements = [
            'walker' => new \Theme\Walkers\Comment(),
            'style' => 'ul',
            'avatar_size' => 48,
        ];

        return \wp_parse_args($replacements, $args);
    }

    /**
     * Ensure comment text is wrapped up in a card-text tag.
     *
     * @param string $text
     * @return string
     */
    public function comment_text($text)
    {
        return str_replace('<p>', '<p class="card-text">', $text);
    }

    /**
     * Wrap the comment form in a full width row.
     */
    public function comment_form_before()
    {
        echo '<div class="row"><div class="col-12">';
    }

    /**
     * Close the comment form wrap.
     */
    public function comment_form_after()
    {
        echo '</div></div>';
    }
}
