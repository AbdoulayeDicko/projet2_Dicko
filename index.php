<?php
require_once 'utils/DBConfig.php';
require_once 'Controllers/userController.php';
require_once 'Controllers/productController.php';

// Simple routing
$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/login' :
        (new userController())->login();
        break;
    case '/products' :
        (new productController())->listProducts();
        break;
    // ajouter plus de cas ici
    default:
        http_response_code(404);
        //require 'views/404.php';
        break;
}
?>
