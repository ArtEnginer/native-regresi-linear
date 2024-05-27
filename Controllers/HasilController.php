<?php

class HasilController
{
    public function __construct()
    {

        $this->active = 'hasil';
    }

    public function index()
    {
        $data = [
            'title' => 'Hasil',
            'active' => $this->active,
            'content' => 'Views/Hasil/index.php'
        ];

        include_once('Views/Layout/index.php');
    }
}
