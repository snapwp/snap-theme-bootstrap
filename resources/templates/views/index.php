<div class="container">
	<div class="row">
		<main class="col-lg-8" role="main" itemscope itemprop="mainContentOfPage">
			<?php
			$this->loop();
			$this->pagination();
			?>
		</main>

		<aside class="col-lg-4" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
			<?php $this->partial( 'sidebars' ); ?>
		</aside>
	</div>
</div>
