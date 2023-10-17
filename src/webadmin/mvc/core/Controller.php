<?php
    class Controller extends Middleware {
        function model($model){
            
            if(file_exists("./mvc/models/". $model . "Model" ."/" . $model . ".php")){
                require_once "./mvc/models/". $model . "Model" ."/" . $model . ".php";
                return new $model;
            }
        }

        function view($view, $data){

            if(file_exists("./mvc/views/admin/" . $view . ".php")){
                require_once "./mvc/views/admin/" . $view. ".php";
            }
        }
    }
?>