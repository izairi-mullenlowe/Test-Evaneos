<?php

// /?p=default.index

define('ROOT', dirname(__DIR__));
define("APPPATH", ROOT . '/App');

require APPPATH . '/App.php';

App\App::load();
// router en fonction les paramètres de l'url
if(isset($_GET['p'])){
    $page = $_GET['p'];
}else{
    $page = 'default.index';
}

$page = explode('.', $page);
$controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
$action = $page[1];

$controller = new $controller();
$controller->$action();
?>

