<?php snap_render_partial( 'content/title' ); ?>

<div class="container">
	<div class="row">
		<main class="col-lg-8">
			<?php 
			snap_loop();
			snap_pagination();
			?>
		</main>

		<aside class="col-lg-4">
			<?php snap_render_partial( 'sidebars' ); ?>
		</aside>
	</div>
</div>
