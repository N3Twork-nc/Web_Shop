<?php
    class Dashboard_detailsController extends Controller{
        function Show(){
            $data = [];
            $page = $this->viewAdmin("dashboard_details", $data);
        }
    }
?>