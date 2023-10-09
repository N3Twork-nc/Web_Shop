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
    route('/?page=login', 'Login');
    route('/?page=dashboard_home', 'Dashboard_home');
    route('/?page=dashboard_product', 'Dasboard_product');
    route('/?page=dashboard_order', 'Dashboard_order');
    route('/?page=dashboard_details', 'Dashboard_details');
    route('/?page=dashboard_customer', 'Dashboard_customer');
    route('/?page=dashboard_category', 'Dashboard_category');
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

    function Dashboard_home(){
        require_once 'view/admin/dashboard_home.php';
    }
    function Dasboard_product(){
        require_once 'view/admin/dashboard_product.php';
    }
    function Dashboard_order(){
        require_once 'view/admin/dashboard_order.php';
    }
    function Dashboard_details(){
        require_once 'view/admin/dashboard_details.php';
    }
    function Dashboard_customer(){
        require_once 'view/admin/dashboard_customer.php';
    }
    function Dashboard_category(){
        require_once 'view/admin/dashboard_category.php';
    }
    function Login(){
        require_once 'view/admin/login.php';
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