<?php

use Snap\Core\Snap;

Snap::view()->partial( 'header' );
Snap::view()->partial( 'navigation' );

Snap::route()->dispatch( 'TestController@index' );

Snap::view()->partial( 'footer' );
