<?php 
include_once "./mvc/models/ProductModel/ProductObj.php";
    class Product extends DB{

        function LoadProductSizes($product_code){
            try {
                    $db = new DB();
                    $sql = "CALL GetSizesProduct(?)";
                    $params = array($product_code);
                    $sth = $db->select($sql, $params);
                    $sizes = [];
                    while($row = $sth->fetch()) {
                        $sizes[$row['size']] = $row['quantity'];
                    }

                return $sizes;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
        }

        function LoadProductImages($product_code){
            try {
                    $db = new DB();
                    $sql = "CALL GetImagesProduct(?)";
                    $params = array($product_code);
                    $sth = $db->select($sql, $params);
                    $images = [];
                    while($row2 = $sth->fetch()) {
                        $images[] = $row2['image'];
                    }
                return $images;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
        }

        function LoadProducts($data = null){
                try {
                    $db = new DB();

                    if(empty($data)){
                        $sql = "CALL GetProducts()";
                        $sth = $db->select($sql);
                    }
                    else{
                        if(!empty($data['child_category'])){
                            $sql = "SELECT P.*, C.name AS 'category_name' FROM Products AS P, Categories AS C 
                            WHERE P.category_id = C.category_id AND C.name = ? ";
                            $params = array($data['child_category']);
                        }
                        else if(!empty($data['parent_category'])){
                            $sql = "SELECT P.*, TMP2.name AS 'category_name' FROM Products AS P, 
                            (SELECT C2.* FROM Categories AS C2, 
                            (SELECT C.category_id as parent_id 
                            FROM `Categories` AS C WHERE C.name = ?
                            ) AS TMP 
                            WHERE TMP.parent_id = C2.parent_category_id
                            ) AS TMP2 
                            WHERE P.category_id = TMP2.category_id;";
                            $params = array($data['parent_category']);
                        }
                        else if(!empty($data['product_code'])){
                            $sql = "SELECT P.*, C.name AS 'category_name' FROM Products AS P, Categories AS C 
                            WHERE P.category_id = C.category_id AND p.product_code = ?";
                            $params = array($data['product_code']);
                        }
                        else{
                            $sql = "SELECT P.*, C.name AS 'category_name' FROM Products AS P, Categories AS C 
                            WHERE P.category_id = C.category_id AND 1 = ?";
                            $params = array(1);
                        }

                        $sth = $db->select($sql, $params);
                    }

                    $arr = [];
                    $product_from_DB = $sth->fetchAll();
                   
                    $sth = null;

                    foreach ($product_from_DB as $row) {

                        // tạo sản phẩm
                        $obj = new ProductObj($row);

                        // lấy hình
                        $images = $this->LoadProductImages($obj->getProduct_code());
                        $obj->setImages($images);

                        // lấy size và số lượng
                        $sizes = $this->LoadProductSizes($obj->getProduct_code());
                        $obj->setSizes($sizes);

                        // set số lượng
                        $obj->setQuantity($obj->calculateQuantity());
                        
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