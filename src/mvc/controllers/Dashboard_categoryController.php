<?php
    class Dashboard_categoryController extends Controller{
        function Show(){
            $data = [];
            $page = $this->viewAdmin("dashboard_category", $data);
        }
    }
?>