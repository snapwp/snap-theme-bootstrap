<?php snap_render_module( 'content/title' ); ?>

<div class="container">
	<div class="row">
		<main class="col-lg-8">
			<?php 
			snap_loop();
			snap_pagination();
			?>
		</main>

		<aside class="col-lg-4">
			<?php snap_render_module( 'sidebars' ); ?>
		</aside>
	</div>
</div>
