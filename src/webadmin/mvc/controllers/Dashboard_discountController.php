<?php
    class Dashboard_discountController extends Controller{
        function Show(){

            //$model = $this->model("Category");
            //$data = $model->LoadCategories();
            $data = [];
            $page = $this->view("dashboard_discount", $data);
        }
    }
?>