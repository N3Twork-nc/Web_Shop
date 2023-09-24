<?php
    $routes = [];

    // add routes
    route('/', 'Home');
    route('/?page=', 'Home');
    route('/?page=category', 'Category');
    route('/?page=delivery', 'Delivery');
    route('/?page=payment', 'Payment');
    route('/?page=product', 'Product');
    route('/?page=cart', 'Cart');
    route('/404', 'PageNotFound');

    // func call file
    function Home(){
        require_once 'view/shopping/home.php';
    }
    function Category(){
        require_once 'view/shopping/category.php';
    }
    function Delivery(){
        require_once 'view/shopping/delivery.php';
    }
    function Payment(){
        require_once 'view/shopping/payment.php';
    }
    function Product(){
        require_once 'view/shopping/product.php';
    }
    function Cart(){
        require_once 'view/shopping/cart.php';
    }
    function PageNotFound(){
        require_once 'view/shopping/404.html';
    }

    // define route func
    function route(string $path, callable $callback){
        global $routes;
        $routes[$path] = $callback;
    }

    run();

    // define run func
    function run(){
        global $routes;
        $uri = $_SERVER['REQUEST_URI'];
        $found = false;
        foreach($routes as $path => $callback){
            if($path !== $uri) continue;

            $found = true;
            $callback();
        }

        if (!$found) {
            $notFoundCallback = $routes['/404'];
            $notFoundCallback();
          }
    }


?>