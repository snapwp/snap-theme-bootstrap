<div class="container">
	<div class="row">
		<main class="col-lg-8">
			<?php 
			$this->loop();
			$this->pagination();
			?>
		</main>

		<aside class="col-lg-4">
			<?php $this->partial( 'sidebars' ); ?>
		</aside>
	</div>
</div>
