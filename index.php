<?php

use Snap\Core\Snap;

Snap::view()->partial( 'header' );
Snap::view()->partial( 'navigation' );

Snap::route()->view( 'index' );

Snap::view()->partial( 'footer' );
