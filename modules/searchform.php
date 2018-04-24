<?php
// Incase this form is included multiple times, let's create a random ID attr for the label/input
if ( function_exists( 'random_int' ) ) {
	$id = 'search_' . random_int( 1000, 8000 );
} else {
	$id = uniqid( 'search_', true );
}
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group">
		<label for="<?php echo $id; ?>">
			<span class="sr-only"><?php echo _x( 'Search for:', 'label' ) ?></span>
		</label>
		
		<input type="text" id="<?php echo $id; ?>" class="form-control" placeholder="Search for..." name="s" aria-label="Search for..." required>
		
		<div class="input-group-append">
			<button class="btn btn-secondary" type="submit"><?php echo esc_attr_x( 'Search', 'submit button' ); ?></button>
		</div>
	</div>
</form>