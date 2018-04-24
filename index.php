<?php

use Snap\Core\Snap;



Snap::module( 'header' );
Snap::module( 'navigation' );

Snap::route()->view( 'index' );

Snap::module( 'footer' );
