<?php
    class PaymentController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("payment", $data);
        }
    }
?>