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
                if(empty($values) || empty(trim($values))){
                    return true;
                }
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

        function validateEmail($email) {
            // Sử dụng hàm filter_var với FILTER_VALIDATE_EMAIL để kiểm tra tính hợp lệ của email
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return true; // Đúng định dạng email
            } else {
                return false; // Không đúng định dạng email
            }
        }
    }
?>