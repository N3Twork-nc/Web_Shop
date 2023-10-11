<?php
    class Controller{
        function model($model){

        }

        function view($view, $data){

            if(file_exists("./mvc/views/shopping/" . $view . ".php")){
                require_once "./mvc/views/shopping/" . $view. ".php";
            }
        }

        function viewAdmin($view, $data){

            if(file_exists("./mvc/views/admin/" . $view . ".php")){
                require_once "./mvc/views/admin/" . $view. ".php";
            }
        }
    }
?>