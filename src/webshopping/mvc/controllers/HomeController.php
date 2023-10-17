<?php
    class HomeController extends Controller{
        function Show($data){
            $page = $this->view("home", $data);
        }
    }
?>