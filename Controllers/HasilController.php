<?php

class HasilController
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user'])) {
            header('Location: ' . base_url() . 'auth/login');
            exit();
        }

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
