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
                echo "Lỗi khi thêm size sản phẩm";
                //echo $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertProductSizes($db, $product_code, $size, $quantity){
            try{
                $sql = "INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES (?,?, ?);";
                $params = array($product_code, $size, $quantity);
                $db->execute($sql, $params);
            }
            catch (PDOException $e) {
                $db->conn->rollBack();
                echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertProductImages($db, $product_code, $image){
            try{
                $sql = "INSERT INTO `ProductImages`(`product_code`, `image`) VALUES (?,?);";
                $params = array($product_code, $image);
                $db->execute($sql, $params);
            }
            catch (PDOException $e) {
                $db->conn->rollBack();
                echo "Lỗi khi thêm ảnh sản phẩm";
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertProduct($data){
            try {
                $db = new DB();
                $db->conn->beginTransaction();
                $sql = "INSERT INTO `Products`(`product_code`, `name`, `description`, `price`, `category_id`, `color`) 
                VALUES (?,?,?,?,?,?);";
                $params = array($data['product_code'], $data['product_name'], $data['product_description'], $data['product_price'], $data['category_id'], $data['product_color']);
                $res = $db->execute($sql, $params);
                
                foreach ($data['size_quantities'] as $size => $quantity) {
                        // Thực hiện INSERT vào ProductSizes
                    $res = $this->InsertProductSizes($db, $data['product_code'], $size, $quantity);
                }

                foreach ($data['product_images'] as $image) {
                        // Thực hiện INSERT vào ProductSizes
                    $res = $this->InsertProductImages($db, $data['product_code'], $image);
                }

                $db->conn->commit();
                echo "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                echo "Lỗi khi thêm sản phẩm";
                //echo  $sql . "<br>" . $e->getMessage();
            }
    }
    }
?>