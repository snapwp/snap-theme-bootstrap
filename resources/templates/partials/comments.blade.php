@if(have_comments())

    <div id="comments" class="comments-area">
        <h2 class="comments-title">Comments</h2>

        <ul class="list-unstyled">
            <?php wp_list_comments(); ?>
        </ul>

        @if(get_comment_pages_count() > 1 && get_option('page_comments'))
            <nav class="navigation comment-navigation" role="navigation">
                <h1 class="screen-reader-text section-heading">{{ __('Comment navigation') }}</h1>
                <div class="nav-previous">{!! get_previous_comments_link(__('&larr; Older Comments')) !!}</div>
                <div class="nav-next">{!! get_next_comments_link(__('Newer Comments &rarr;')) !!}</div>
            </nav>
        @endif

        @if(!comments_open() && get_comments_number())
            <p class="no-comments">{{ __('Comments are closed.') }}</p>
        @endif
    </div>

@endif

<?php comment_form(); ?>

