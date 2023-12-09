<?php
    class DeliveryController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("delivery", $data);
        }
    }
?>