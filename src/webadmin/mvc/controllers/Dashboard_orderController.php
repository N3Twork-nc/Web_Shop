<?php
    class Dashboard_orderController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("dashboard_order", $data);
        }
    }
?>