<?php
    class Dashboard_homeController extends Controller{
        function Show(){
            $data = [];
            $page = $this->viewAdmin("dashboard_home", $data);
        }
    }
?>