<?php
    class Dashboard_orderController extends Controller{
        function Show(){

            $model = $this->model("Order");
            $data = $model->LoadOrder();
            //var_dump($data[0]->getCustomer()->getUsername());
            $page = $this->view("dashboard_order", $data);
        }
    }
?>