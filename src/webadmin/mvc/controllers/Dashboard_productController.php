<?php
    class Dashboard_productController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("dashboard_product", $data);
        }
    }
?>