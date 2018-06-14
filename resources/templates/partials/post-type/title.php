<div class="jumbotron jumbotron-fluid">
  <div class="container">
<h1 class="display-3">
	<?php 
	switch (1) {

		case ( is_home() ) :
			$cpt = get_post_type_object( 'post' );
			echo 'Latest ' . $cpt->labels->name;
			break;

		default: 
			the_title();

	}
	
	?>
</h1>
</div>
</div>