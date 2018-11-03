<?php if (have_comments()) : ?>

    <div id="comments" class="comments-area">

        <h2 class="comments-title">Comments</h2>

        <ul class="list-unstyled">
            <?php wp_list_comments(); ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading"><?php _e('Comment navigation'); ?></h1>
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;')); ?></div>
            </nav>
        <?php endif;?>

        <?php if (!comments_open() && get_comments_number()) : ?>
            <p class="no-comments"><?php _e('Comments are closed.'); ?></p>
        <?php endif; ?>

    </div>

<?php endif; ?>

<?php comment_form(); ?>

