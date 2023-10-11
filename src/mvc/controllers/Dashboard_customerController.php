<?php
    class Dashboard_customerController extends Controller{
        function Show(){
            $data = [];
            $page = $this->viewAdmin("dashboard_customer", $data);
        }
    }
?>