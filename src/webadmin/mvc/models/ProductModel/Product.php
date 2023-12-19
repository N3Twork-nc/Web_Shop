<?php 
include_once "./mvc/models/ProductModel/ProductObj.php";
    class Product extends MiddleWare{
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

        function InsertProductSizes($db, $product_code, $size, $quantity){
            try{
                $sql = "INSERT INTO `ProductSizes`(`product_code`, `size`, `quantity`) VALUES (?,?,?);";
                $params = array($product_code, $size, $quantity);
                $db->execute($sql, $params);
            }
            catch (PDOException $e) {
                throw $e; // Ném ngoại lệ để bắt ở nơi gọi hàm
                //throw "Lỗi khi thêm size"; // Ném ngoại lệ để bắt ở nơi gọi hàm
            }
        }

        function InsertProductImages($db, $product_code, $ordinal_number, $image){
            try{
                $sql = "INSERT INTO `ProductImages`(`product_code`, `ordinal_number`, `image`) VALUES (?,?,?);";
                $params = array($product_code, $ordinal_number, $image);
                $db->execute($sql, $params);
            }
            catch (PDOException $e) {
                throw $e; // Ném ngoại lệ để bắt ở nơi gọi hàm
                //throw "Lỗi khi thêm ảnh"; // Ném ngoại lệ để bắt ở nơi gọi hàm
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

                $ordinal_numbers = ['first', 'second', 'third', 'fourth'];
                $index = 0;
                foreach ($data['product_images'] as $image) {
                        // Thực hiện INSERT vào ProductSizes

                    $ordinal_number = $ordinal_numbers[$index];
                    $res = $this->InsertProductImages($db, $data['product_code'], $ordinal_number, $image);
                    $index += 1;
                }

                $db->conn->commit();
                return "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                if ($e->getCode() == '42000') {
                    // Xử lý khi có lỗi SQLSTATE 42000
                    return "Bạn không có quyền làm thao tác này";
                } else {
                    // Xử lý cho các lỗi khác
                    //echo "Lỗi: " . $e->getMessage();
                    return "Lỗi khi thêm sản phẩm";
                }
            }
    }

    function EditProductSizes($db, $product_code, $size, $quantity){
        try{
            $sql = "UPDATE `ProductSizes` SET `quantity` = ? WHERE `product_code` = ? AND `size` = ? ;";
            $params = array($quantity, $product_code, $size);
            $db->execute($sql, $params);
        }
        catch (PDOException $e) {
            throw $e; // Ném ngoại lệ để bắt ở nơi gọi hàm
            //throw "Lỗi khi sửa size"; // Ném ngoại lệ để bắt ở nơi gọi hàm
        }
    }

    function EditProductImages($db, $product_code, $ordinal_number, $image){
        try{
            $sql = "UPDATE `ProductImages` SET `image` = ? WHERE `product_code` = ? AND `ordinal_number` = ?;";
            $params = array($image, $product_code, $ordinal_number);
            $db->execute($sql, $params);
        }
        catch (PDOException $e) {
            throw $e; // Ném ngoại lệ để bắt ở nơi gọi hàm
            //echo  $sql . "<br>" . $e->getMessage();
            //throw "Lỗi khi sửa ảnh";
        }
    }

    function EditProduct($data){
        try {
            $db = new DB();
            $db->conn->beginTransaction();

            $sql = "UPDATE `Products` SET `name` = ?, `description` = ?, `price` = ?, `category_id` = ?, `color` = ? WHERE `product_code` = ?;";
            $params = array($data['product_name'], $data['product_description'], $data['product_price'], $data['category_id'], $data['product_color'], $data['product_code']);
            $db->execute($sql, $params);

            foreach ($data['size_quantities'] as $size => $quantity) {
                // Thực hiện INSERT vào ProductSizes
                $res = $this->EditProductSizes($db, $data['product_code'], $size, $quantity);
            }

            $ordinal_numbers = ['first', 'second', 'third', 'fourth'];
            $index = 0;
            foreach ($data['product_images'] as $image) {
                // Thực hiện INSERT vào ProductSizes

                $ordinal_number = $ordinal_numbers[$index];
                $res = $this->EditProductImages($db, $data['product_code'], $ordinal_number, $image);
                $index += 1;
            }   

            $db->conn->commit();

            return "done";
        } catch (PDOException $e) {
            $db->conn->rollBack();
            if ($e->getCode() == '42000') {
                // Xử lý khi có lỗi SQLSTATE 42000
                return "Bạn không có quyền làm thao tác này";
            } else {
                // Xử lý cho các lỗi khác
                //echo "Lỗi: " . $e->getMessage();
                return "Lỗi khi sửa sản phẩm";
            }
        }
    }

    function FindOrder($db, $product_code){
        try{
            $sql = "SELECT O.order_code FROM `OrderItems` AS OI, Orders AS O 
            WHERE OI.product_code = ? AND O.order_code = OI.order_code AND (O.state = 'delivered' OR O.state = 'cancelled') ;";
            $params = array($product_code);
            $sth = $db->select($sql, $params);

            $orders_code = [];
            while($row = $sth->fetch()) {
                $orders_code[] = $row['order_code'];
            }
            return $orders_code;
        }
        catch (PDOException $e) {
            throw $e; // Ném ngoại lệ để bắt ở nơi gọi hàm
            // throw new Exception("Lỗi khi xóa OrderItems");
        }
    }
    

    function DeleteOrder($db, $order_code){
        try{
            $sql = "DELETE FROM `Orders` AS O 
                    WHERE O.order_code = ?;";
            $params = array($order_code);
            $db->execute($sql, $params);
        }
        catch (PDOException $e) {
            throw $e; // Ném ngoại lệ để bắt ở nơi gọi hàm
            // throw new Exception("Lỗi khi xóa OrderItems");
        }
    }

    function DeleteProduct($data){
        try {
            $db = new DB();
            $db->conn->beginTransaction();

            // tìm đơn hàng còn chứa sản phẩm mà đã thanh toán
            $orders_code =  $this->FindOrder($db, $data['product_code']);

            // xóa các đơn hàng này
            foreach($orders_code as $each){
                $this->DeleteOrder($db, $each);
            }

            // xóa sản phẩm
            $sql = "DELETE FROM `Products` WHERE `product_code` = ?;";
            $params = array($data['product_code']);
            $db->execute($sql, $params);

            $db->conn->commit();
            return "done";
        } catch (PDOException $e) {

            $db->conn->rollBack();
            if ($e->getCode() == '42000') {
                // Xử lý khi có lỗi SQLSTATE 42000
                return "Bạn không có quyền làm thao tác này";
            } else {
                // Xử lý cho các lỗi khác
                //echo "Lỗi: " . $e->getMessage();
                return "Lỗi khi xóa sản phẩm";
            }
        }
    }
    }
?>