<?php

use Snap\Core\Snap;



Snap::view()->module( 'header' );
Snap::view()->module( 'navigation' );

Snap::route()->view( 'index' );

Snap::view()->module( 'footer' );
