<?php

use Snap\Core\Snap;

// We always want these partials, so put them here.
Snap::view()->partial( 'header' );
Snap::view()->partial( 'navigation' );

// The simplest way to render a view is with the view() method.

// Post-templates are a little bit more tricky as the view name needs to be dynamic.
Snap::route()->is_page_template()->view( get_page_template_slug() );

// If you prefer, you can also dispatch a controller action.
Snap::route()->dispatch( 'TestController@index' );

Snap::view()->partial( 'footer' );
