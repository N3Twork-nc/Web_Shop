<?php
    class Dashboard_orderHistoryController extends Controller{
        function Show(){

            $model = $this->model("Order");
            $data = $model->LoadOrderHistory();
            //echo $data[0]->getOrder_code();
            //var_dump($data[0]->getCustomer()->getUsername());
            $page = $this->view("dashboard_orderHistory", $data);
        }
    }
?>