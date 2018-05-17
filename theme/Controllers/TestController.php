<?php


namespace Theme\Controllers;

class TestController
{
    private $view = null;

    public function __construct(\Snap\Core\View $view)
    {
        $this->view = $view;
    }

    public function index()
    {
        $this->view->render('index');
    }
}
