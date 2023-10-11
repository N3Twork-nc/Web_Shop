<?php
    class LoginController extends Controller{
        function Show(){
            $data = [];
            $page = $this->viewAdmin("login", $data);
        }
    }
?>