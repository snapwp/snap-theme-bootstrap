<?php

namespace Theme\Controllers;

use Snap\Core\Controller;
use Snap\Http\Request;

class Example extends Controller
{
    public function index(Request $request)
    {
        $this->view->render('index');
    }
}
