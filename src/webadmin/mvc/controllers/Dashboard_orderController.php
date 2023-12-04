<?php
    class Dashboard_orderController extends Controller{
        function Show(){

            $model = $this->model("Order");
            $data = $model->LoadOrder();
            //var_dump($data);
            $page = $this->view("dashboard_order", $data);
        }
    }
?>