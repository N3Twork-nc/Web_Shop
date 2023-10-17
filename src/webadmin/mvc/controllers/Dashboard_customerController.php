<?php
    class Dashboard_customerController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("dashboard_customer", $data);
        }
    }
?>