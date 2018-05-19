<?php


namespace Theme\Controllers;

use Snap\Core\Request;
use Snap\Core\View;

class TestController
{
    private $view = null;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index(Request $request)
    {
        $this->view->render('index');
    }
}
