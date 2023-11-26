<?php
    class Dashboard_staffController extends Controller{
        function Show(){
            $model = $this->model("Admin");
            $data = $model->LoadAdmins();
            //var_dump($data);
            $page = $this->view("dashboard_staff", $data);
        }
    }
?>