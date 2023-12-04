<?php
    class Dashboard_customerController extends Controller{
        function Show(){
            $model = $this->model("Customer");
            $data = $model->LoadCustomers();
            //var_dump($data[0]);
            $page = $this->view("dashboard_customer", $data);
        }
    }
?>