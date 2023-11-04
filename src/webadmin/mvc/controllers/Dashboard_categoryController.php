<?php
    class Dashboard_categoryController extends Controller{
        function Show(){

            $model = $this->model("Category");
            $data = $model->LoadCategories();
            $page = $this->view("dashboard_category", $data);
        }
    }
?>