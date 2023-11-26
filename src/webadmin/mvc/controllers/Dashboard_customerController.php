<?php
    class Dashboard_customerController extends Controller{
        function Show(){
            $model = $this->model("Customer");
            $data = $model->LoadCustomers();
            //var_dump($data);
            $page = $this->view("dashboard_customer", $data);
        }
    }
?>