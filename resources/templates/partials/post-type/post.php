<?php if (is_single()) : ?>

    <article itemscope itemtype="http://schema.org/Article">
        <?php the_post_thumbnail('post_featured_image', ['class' => 'mb-3 img-fluid']); ?>

        <h1 itemprop="name headline"><?php the_title(); ?></h1>

        <div itemprop="articleBody">
            <?php the_content(); ?>
        </div>
    </article>

<?php else : ?>

    <article <?php post_class('card mb-4'); ?>>
        <?php the_post_thumbnail('post_featured_image', ['class' => 'card-img-top img-fluid']); ?>

        <div class="card-body">
            <h4 class="card-title"><?php the_title(); ?></h4>
			
            <?php the_excerpt(); ?>

            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">Read more</a>
        </div>
    </article>

<?php endif; ?>