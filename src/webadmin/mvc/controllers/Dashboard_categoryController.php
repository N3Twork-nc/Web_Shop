<?php
    class Dashboard_categoryController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("dashboard_category", $data);
        }
    }
?>