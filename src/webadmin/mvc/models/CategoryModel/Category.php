<?php 
include_once "./mvc/models/CategoryModel/CategoryObj.php";
    class Category extends DB{

        function LoadCategories(){
                try {
                    $db = new DB();
                    $sql = "SELECT * FROM Categories";
                    $sth = $db->select($sql);
                    $arr = [];
                    $categories_from_DB = $sth->fetchAll();
                    foreach ($categories_from_DB as $row) {

                        // tạo sản phẩm
                        $obj = new CategoryObj($row);
                        
                        // thêm obj vào mảng
                        $arr[] = $obj;
                    }
                    return $arr;
                } catch (PDOException $e) {
                    return  $sql . "<br>" . $e->getMessage();
                }
        }
    }
?>