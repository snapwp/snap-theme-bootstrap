<?php $this->extends('layouts.main'); ?>

<div class="container">
	<div class="row">
		<main class="col-lg-8" role="main" itemscope itemprop="mainContentOfPage">
			<h1>Your content could not be found</h1>
		</main>

		<aside class="col-lg-4" role="complementary" itemscope itemtype="http://schema.org/WPSideBar">
			<?php $this->partial( 'sidebars' ); ?>
		</aside>
	</div>
</div>
