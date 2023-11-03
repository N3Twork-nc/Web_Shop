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

        function LoadProducts(){
                try {
                    $db = new DB();
                    $sql = "CALL GetProducts()";
                    $sth = $db->select($sql);
                    $arr = [];
                    $product_from_DB = $sth->fetchAll();
                    $sth = null;
                    foreach ($product_from_DB as $row) {

                        // tạo sản phẩm
                        $obj = new ProductObj($row);

                        // lấy size và số lượng
                        $sizes = $this->LoadProductSizes($obj->getProduct_code());
                        $obj->setSizes($sizes);

                        // lấy hình
                        $images = $this->LoadProductImages($obj->getProduct_code());
                        $obj->setImages($images);

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

        function findColorID($db, $product_code, $color){
            try{
                $sql = "SELECT PC.product_colors_id FROM ProductColors AS PC WHERE PC.product_code = ? AND PC.color = ?";
                $params = array($product_code, $color);
                $sth = $db->select($sql, $params);
                while($row = $sth->fetch()){
                    return $row['product_colors_id'];
                }
            }
            catch (PDOException $e) {
                $db->conn->rollBack();
                echo $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertProductColors($db, $product_code, $color){
            try{
                $sql = "INSERT INTO `ProductColors`(`product_code`, `color`) VALUES (?,?);";
                $params = array($product_code, $color);
                $db->execute($sql, $params);
            }
            catch (PDOException $e) {
                $db->conn->rollBack();
                echo $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertProductSizes($db, $color_id, $size, $quantity){
            try{
                $sql = "INSERT INTO `ProductSizes`(`product_colors_id`, `size`, `quantity`) VALUES (?,?, ?);";
                $params = array($color_id, $size, $quantity);
                $db->execute($sql, $params);
            }
            catch (PDOException $e) {
                $db->conn->rollBack();
                echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertProductImages($db, $color_id, $image){
            try{
                $sql = "INSERT INTO `ProductImages`((`product_colors_id`, `image`) VALUES (?,?);";
                $params = array($color_id, $image);
                $db->execute($sql, $params);
            }
            catch (PDOException $e) {
                $db->conn->rollBack();
                echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertProduct($data){
            try {
                $db = new DB();
                $db->conn->beginTransaction();
                $sql = "INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `discount_code`,`category_id`) 
                VALUES (?,?,?,?,?,?);";
                $params = array($data['product_code'], $data['name'], $data['description'], $data['price'], $data['discount_code'], $data['category_id']);
                $res = $db->execute($sql, $params);
                
                foreach ($data['details_data'] as $color => $details){
                    $res = $this->InsertProductColors($db, $data['product_code'], $color);

                    // tìm id của color vừa thêm
                    $color_id = $this->findColorID($db, $data['product_code'], $color);

                    foreach ($details['sizes'] as $size => $quantity) {
                        // Thực hiện INSERT vào ProductSizes
                        $res = $this->InsertProductSizes($db, $color_id, $size, $quantity);
                    }

                    foreach ($details['images'] as $image) {
                        // Thực hiện INSERT vào ProductSizes
                        $res = $this->InsertProductImages($db, $color_id, $image);
                    }

                }
                $db->conn->commit();
                echo "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                echo  $sql . "<br>" . $e->getMessage();
            }
    }
    }
?>