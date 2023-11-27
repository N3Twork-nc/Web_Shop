<?php
    class CategoryController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("category", $data);
        }
    }
?>