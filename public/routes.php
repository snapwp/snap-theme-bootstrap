<?php

use Snap\Services\Router;

// Post-templates are a little bit more tricky as the view name needs to be dynamic.
Router::when(is_page_template())->dispatchPostTemplate();

Router::when(is_404())->view('404');

// If you prefer, you can also dispatch a controller action.
Router::dispatch('Example@index');