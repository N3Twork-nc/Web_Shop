<?php
    class CartController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("cart", $data);
        }
    }
?>