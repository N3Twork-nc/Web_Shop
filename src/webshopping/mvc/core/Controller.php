<?php
    class Controller{
        function model($model){
            
            if(file_exists("./mvc/models/". $model . "Model" ."/" . $model . ".php")){
                require_once "./mvc/models/". $model . "Model" ."/" . $model . ".php";
                return new $model;
            }
        }

        function view($view, $data){
            if(file_exists("./mvc/views/shopping/" . $view . ".php")){
                require_once "./mvc/views/shopping/" . $view. ".php";
            }
        }
    }
?>