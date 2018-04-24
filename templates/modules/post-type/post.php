<?php if ( is_single() ) : ?>

	<article>
		<?php  snap_the_post_thumbnail( 'post_featured_image', [ 'class' => 'mb-3 img-fluid' ] ); ?>
		<?php /*snap_the_post_thumbnail( [300, 300], [ 'class' => 'mb-3 img-fluid' ] );*/ ?>

		<h1><?php the_title(); ?></h1>
 
		<?php the_content(); ?>
	</article>

<?php else : ?>

	<article <?php post_class( 'card mb-4' ); ?>>
		<?php snap_the_post_thumbnail( 'post_thumbnail', [ 'class' => 'card-img-top img-fluid' ] ); ?>

		<div class="card-body">
			<h4 class="card-title"><?php the_title(); ?></h4>
			
			<?php the_excerpt(); ?>

			<div class="d-flex justify-content-between">
				<a href="<?php the_permalink(); ?>" class="btn btn-outline-primary">Read more</a>

				<div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-share-alt-square" aria-hidden="true"></i> Share
					</button>
		
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" target="_blank" href="#"><i class="fa fa-fw fa-facebook" aria-hidden="true"></i> Facebook</a>
						<a class="dropdown-item" target="_blank" href="#"><i class="fa fa-fw fa-twitter" aria-hidden="true"></i> Twitter</a>
						<a class="dropdown-item" target="_blank" href="#"><i class="fa fa-fw fa-linkedin" aria-hidden="true"></i> LinkedIn</a>
						<a class="dropdown-item" target="_blank" href="#"><i class="fa fa-fw fa-google-plus" aria-hidden="true"></i> Goole Plus</a>
					</div>
				</div>
			</div>
		</div>
	</article>

<?php endif; ?>