<?php

    class App {
        private $controller = "HomeController";
        private $action = "Show";
        private $params = [];
        function __construct() {
            $arr = $this->UrlProcess();
 
            // find Controllers
            if(isset($arr[0])){
                $arr[0] .= "Controller";
                if(file_exists("./mvc/controllers/" . $arr[0] . ".php")){
                    $this->controller = $arr[0];
                    //echo $this->controller . " " . $arr[0];
                }
                unset($arr[0]);
            }
            require_once "./mvc/controllers/" . $this->controller . ".php";

            // khởi tạo để lát gọi phương thức
            $this->controller = new $this->controller();

            // find Action (Method)
            if(isset($arr[1])){
                if(method_exists($this->controller, $arr[1])){
                    if(!method_exists('Controller', $arr[1])){
                        $this->action = $arr[1];
                    }
                }
                unset($arr[1]);
            }
            
            // find Params
            // nếu $arr != null thì lấy arr, không thì lấy mảng rỗng
            $this->params = $arr?array_values($arr):[];

           // print_r($this->params);
           // print_r($this->action);
           // print_r($this->controller);
           // die($this->controller);
<<<<<<< HEAD

=======
           
>>>>>>> 570c3e4007f8a0734407c30f944e90156950a55d
            // gọi method trong class với params
            call_user_func([$this->controller, $this->action], $this->params);
        }

        function UrlProcess(){
            // /Controller/Action/Params
            if(isset($_GET['url'])){

                // cắt khoảng trắng
                // loại bỏ kí tự không hợp lệ (các kí tự không nằm trong ascii)
                // mỗi khi gặp / sẽ cắt và bỏ vào mảng
                return explode("/", filter_var(trim($_GET['url']), FILTER_SANITIZE_URL));
            }
        }

    }
?>