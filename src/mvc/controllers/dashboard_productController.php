<?php
    class Dashboard_productController extends Controller{
        function Show(){
            $data = [];
            $page = $this->viewAdmin("dashboard_product", $data);
        }
    }
?>