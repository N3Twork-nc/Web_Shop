<?php
    class Dashboard_orderController extends Controller{
        function Show(){
            $data = [];
            $page = $this->viewAdmin("dashboard_order", $data);
        }
    }
?>