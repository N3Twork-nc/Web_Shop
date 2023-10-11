<?php
    class ProductController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("product", $data);
        }
    }
?>