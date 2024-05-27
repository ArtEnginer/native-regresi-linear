<?php

class HomeController
{
    public function __construct()
    {

        $this->active = 'home';
    }

    public function index()
    {
        $data = [
            'title' => 'Home',
            'active' => $this->active,
            'content' => 'Views/home/index.php'
        ];

        include_once('Views/Layout/index.php');
    }
}
