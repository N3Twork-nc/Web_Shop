<?php
    class Dashboard_homeController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("dashboard_home", $data);
        }
    }
?>