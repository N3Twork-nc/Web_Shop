<?php
    class Dashboard_detailsController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("dashboard_details", $data);
        }
    }
?>