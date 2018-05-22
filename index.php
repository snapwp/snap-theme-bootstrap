<?php

use Snap\Core\Snap;

// We always want these partials, so put them here.
Snap::view()->partial( 'header' );
Snap::view()->partial( 'navigation' );


// Post-templates are a little bit more tricky as the view name needs to be dynamic.
Snap::route()->is_page_template()->view( get_page_template_slug() );

Snap::route()->is_404()->view( '404' );

// If you prefer, you can also dispatch a controller action.
Snap::route()->dispatch( 'TestController@index' );

Snap::view()->partial( 'footer' );
