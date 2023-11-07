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

        function validateNull($data){
            foreach($data as $key => $values){
                if($values == '')
                    return true;
            }
            return false;
        }

        function validateSpecialCharacter($data){

            $pattern = '/^[\p{L}a-z A-Z0-9]+$/u';

            foreach($data as $key => $values){
                if (!preg_match($pattern, $values))
                    return true;
            }
            return false;
        }

        function validateNumber($data){
            foreach($data as $key => $values){
                if (!is_numeric($values) || $values < 0) {
                    return true;
                }
            }
            return false;
        }
    }
?>