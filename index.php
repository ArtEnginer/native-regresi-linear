<?php
// Fungsi untuk mendapatkan base URL
function base_url()
{
    $base_url = "http://localhost/native_aprioriti/";
    return $base_url;
}
// Autoload untuk memuat kelas secara otomatis
spl_autoload_register(function ($class_name) {
    include 'controllers/' . $class_name . '.php';
});

// Routing untuk menentukan kontroller dan aksi yang dipanggil 
// default controller adalah home action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Instansiasi kontroller yang sesuai
$controllerName = $controller . 'Controller';
$controllerInstance = new $controllerName();

// Panggil aksi yang sesuai
$controllerInstance->$action();
