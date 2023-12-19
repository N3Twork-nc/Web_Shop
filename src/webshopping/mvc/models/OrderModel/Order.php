<?php 
include_once "./mvc/models/OrderModel/OrderObj.php";
    class Order extends DB{

        //check đơn hàng chưa giao xong
        function CheckOrderNotDeliveredYet($data){
                try {
                    $db = new DB();
                    if(isset($data['email'])){
                        $sql = "SELECT * FROM Orders AS O 
                            WHERE O.email = ? AND O.state != 'delivered'";
                        $params = array($data['email']);
                        $sth = $db->select($sql, $params);
                    }
                    else if(isset($data['product_code'])){
                        $sql = "SELECT O.* FROM OrderItems AS OI, Orders AS O 
                        WHERE OI.product_code = ? AND O.order_code = OI.order_code AND O.state != 'delivered' AND O.state != 'cancelled'";
                        $params = array($data['product_code']);
                        $sth = $db->select($sql, $params);
                    }
                    else {
                        return "Tham số truyền sai";
                    }
                    $order_from_DB = $sth->fetchAll();
                    if($order_from_DB != null){
                        return "Tồn tại đơn hàng chưa giao, không thể thao tác!";
                    }
                    return "None";
                } catch (PDOException $e) {
                    return "Lỗi khi kiểm tra";
                    //return  $sql . "<br>" . $e->getMessage();
                }
        }

        function LoadProductImages($product_code){
            try {
                $db = new DB();
                $sql = "SELECT * FROM ProductImages AS PI WHERE PI.product_code = ?;";
                $params = array($product_code);
                $sth = $db->select($sql, $params);
                $imgs_items = [];
                $imgs_item_from_DB = $sth->fetchAll();
                foreach ($imgs_item_from_DB as $row) {
                    // thêm obj vào mảng
                    
                    $imgs_items[] = $row['image'];
                }

                return $imgs_items;
            } catch (PDOException $e) {
                return "Lỗi khi load hình";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

        function LoadProductInfo($product_code){
            try {
                $db = new DB();
                $sql = "SELECT * FROM Products AS P WHERE P.product_code = ?;";
                $params = array($product_code);
                $sth = $db->select($sql, $params);
                $products_items = [];
                $products_item_from_DB = $sth->fetchAll();
                foreach ($products_item_from_DB as $row) {
                    // thêm obj vào mảng
                    
                    $obj = new ProductObj($row);
                    $images = $this->LoadProductImages($obj->getProduct_code());
                    $obj->setImages($images);
                    $products_items[] = $obj;
                }

                return $products_items;
            } catch (PDOException $e) {
                return "Lỗi khi load hình";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

        // load chi tiết đơn hàng
        function LoadOrdersItem($order_code){
            try {
                $db = new DB();
                $sql = "SELECT OI.* FROM OrderItems AS OI, Orders AS O 
                WHERE OI.order_code = O.order_code AND OI.order_code = ?;";
                $params = array($order_code);
                $sth = $db->select($sql, $params);
                $orders_items = [];
                $orders_item_from_DB = $sth->fetchAll();
                foreach ($orders_item_from_DB as $row) {
                    // thêm obj vào mảng
                    
                    $obj = new OrderItemObj($row);
                    $product = $this->LoadProductInfo($row['product_code']);
                    $obj->setProduct($product);
                    $orders_items[] = $obj;
                }

                return $orders_items;
            } catch (PDOException $e) {
                return "Lỗi khi load chi tiết đơn hàng";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

        // load đơn hàng
        function LoadOrder($email){
            try {
                $db = new DB();
                $sql = "SELECT TMP.*, P.payment_code, P.payment_date, P.type 
                FROM (
                    SELECT O.*, C.phone, C.full_name
                    FROM Orders AS O, Customers AS C 
                    WHERE O.email = C.email AND O.email = ?
                    ) AS TMP 
                    LEFT JOIN Payment AS P 
                    ON P.order_code = TMP.order_code";
                $params = array($email);
                $sth = $db->select($sql, $params);
                $orders = [];
                $order_from_DB = $sth->fetchAll();
                foreach ($order_from_DB as $row) {
                    // thêm obj vào mảng
                    if($row['state'] == 'pending'){
                        $row['stateVnText'] = 'Đang xử lý';
                    }
                    else if($row['state'] == 'delivering'){
                        $row['stateVnText'] = 'Đang vận chuyển';
                    }
                    else if($row['state'] == 'cancelled'){
                        $row['stateVnText'] = 'Đang hủy';
                    }
                    else {
                        $row['stateVnText'] = 'Giao hàng thành công';
                    }

                    if($row['type'] == 'bank_transfer'){
                        $row['typeVnText'] = 'Chuyển khoản';
                    }
                    else if($row['type'] == 'cash'){
                        $row['typeVnText'] = 'Tiền mặt';
                    }
                    else{
                        $row['typeVnText'] = 'Chưa thanh toán';
                    }
                    $obj = new OrderObj($row);
                    $orders_item = $this->LoadOrdersItem($row['order_code']);

                    $dataCustomer = [];
                    $dataCustomer['email'] = $row['email'];
                    $dataCustomer['phone'] = $row['phone'];
                    $dataCustomer['full_name'] = $row['full_name'];
                    $customer = new CustomerObj($dataCustomer);

                    $obj->setOrder_items($orders_item);
                    $obj->setCustomer($customer);
                    $orders[] = $obj;
                }

                return $orders;
            } catch (PDOException $e) {
                return "Lỗi khi load đơn hàng";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

                // load chi tiết lịch sử đơn hàng
        function LoadOrderHistoryItem($order_code){
            try {
                $db = new DB();
                $sql = "SELECT OHI.* FROM OrdersHistoryItems AS OHI, OrdersHistory AS OH 
                WHERE OHI.order_code = OH.order_code AND OHI.order_code = ?;";
                $params = array($order_code);
                $sth = $db->select($sql, $params);
                $orders_items = [];
                $orders_item_from_DB = $sth->fetchAll();
                foreach ($orders_item_from_DB as $row) {
                // thêm obj vào mảng
                            
                    $obj = new OrderItemObj($row);
                    $product = $this->LoadProductInfo($row['product_code']);
                    $obj->setProduct($product);
                    $orders_items[] = $obj;
                }
        
                return $orders_items;
                } catch (PDOException $e) {
                    return "Lỗi khi load chi tiết lịch sử đơn hàng";
                        //return  $sql . "<br>" . $e->getMessage();
                }
            }
        
                // load lịch sử đơn hàng
            function LoadOrderHistory($email){
                try {
                    $db = new DB();
                    $sql = "SELECT OH.*, C.full_name FROM OrdersHistory AS OH, Customers as C WHERE OH.email = C.email AND OH.email=?";
                    $params = array($email);
                    $sth = $db->select($sql, $params);
                    $orders = [];
                    $order_from_DB = $sth->fetchAll();
                    foreach ($order_from_DB as $row) {
                        // thêm obj vào mảng
                        $row['type'] = $row['payment_type']; 
                        if($row['state'] == 'pending'){
                            $row['stateVnText'] = 'Đang xử lý';
                        }
                        else if($row['state'] == 'delivering'){
                            $row['stateVnText'] = 'Đang vận chuyển';
                        }
                        else if($row['state'] == 'cancelled'){
                            $row['stateVnText'] = 'Đang hủy';
                        }
                        else {
                            $row['stateVnText'] = 'Giao hàng thành công';
                        }

                        if($row['type'] == 'bank_transfer'){
                            $row['typeVnText'] = 'Chuyển khoản';
                        }
                        else if($row['type'] == 'cash'){
                            $row['typeVnText'] = 'Tiền mặt';
                        }
                        else{
                            $row['typeVnText'] = 'Chưa thanh toán';
                        }
                        $obj = new OrderObj($row);
                        $orders_item = $this->LoadOrderHistoryItem($row['order_code']);
        
                        $dataCustomer = [];
                        $dataCustomer['email'] = $row['email'];
                        $dataCustomer['phone'] = $row['phone'];
                        $dataCustomer['full_name'] = $row['full_name'];
                        $customer = new CustomerObj($dataCustomer);
        
                        $obj->setOrder_items($orders_item);
                        $obj->setCustomer($customer);
                        $orders[] = $obj;
                    }
        
                    return $orders;
                } catch (PDOException $e) {
                    return "Lỗi khi load lịch sử đơn hàng";
                        //return  $sql . "<br>" . $e->getMessage();
                }
            }

        // di chuyển chi tiết đơn hàng vào history
        function MoveOrderToHistoryDetails($db, $data){
            try {
                // var_dump($data);
                $sql = "INSERT INTO `OrdersHistoryItems`(`order_code`, `product_code`, `quantity`, `size`, `total_price`) 
                VALUES (?,?,?,?,?);";
                $params = array($data->getOrder_code(), $data->getProduct_code(), $data->getQuantity(), $data->getSize(), $data->getTotal_price());

                $db->execute($sql, $params);
            } catch (PDOException $e) {
                throw $e; 
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

        // di chuyển đơn hàng vào history
        function MoveOrderToHistory($db, $order){
            try {
                if(empty($order->getPayment_code())){
                    $sql = "INSERT INTO `OrdersHistory`(`order_code`, `order_date`, `state`, `email`, `address`, `phone`, `total_price`) 
                    VALUES (?,?,?,?,?,?,?);";
                    $params = array($order->getOrder_code(), $order->getOrder_date(), $order->getState(), $order->getCustomer()->getEmail(), $order->getAddress(), $order->getCustomer()->getPhone(), $order->getTotal_price());
                }
                else {
                    $sql = "INSERT INTO `OrdersHistory`(`order_code`, `order_date`, `payment_code`, `payment_date`, `payment_type`, `state`, `email`, `address`, `phone`, `total_price`)
                    VALUES (?,?,?,?,?,?,?,?,?,?);";
                    $params = array($order->getOrder_code(), $order->getOrder_date(), $order->getPayment_code(), $order->getPayment_date(), $order->getType(), $order->getState(), $order->getCustomer()->getEmail(), $order->getAddress(), $order->getCustomer()->getPhone(), $order->getTotal_price());
                }
                $db->execute($sql, $params);
                
            } catch (PDOException $e) {
                //echo "Lỗi khi đổi trạng thái thành vận chuyển";
                throw $e; 
                // echo "Lỗi khi đổi trạng thái thành vận chuyển";
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function FindOrdersItem($db, $order_code){
            try {
                $sql = "SELECT OI.* FROM OrderItems AS OI, Orders AS O 
                WHERE OI.order_code = O.order_code AND OI.order_code = ?;";
                $params = array($order_code);
                $sth = $db->select($sql, $params);
                $orders_items = [];
                $orders_item_from_DB = $sth->fetchAll();
                foreach ($orders_item_from_DB as $row) {
                    // thêm obj vào mảng
                    
                    $obj = new OrderItemObj($row);

                    $orders_items[] = $obj;
                }

                return $orders_items;
            } catch (PDOException $e) {
                throw $e;
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

        // tìm order theo order code
        function FindOrder($order_code, $db = null){
            try {
                if($db == null)
                    $db = new DB();
                $sql = "SELECT TMP.*, P.payment_code, P.payment_date, P.type 
                FROM (
                    SELECT O.*, C.phone 
                    FROM Orders AS O, Customers AS C 
                    WHERE O.email = C.email AND O.order_code = ?
                    ) AS TMP 
                    LEFT JOIN Payment AS P 
                    ON P.order_code = TMP.order_code";
                $params = array($order_code);
                $sth = $db->select($sql, $params);
                $orders = [];
                $order_from_DB = $sth->fetchAll();

                foreach ($order_from_DB as $row) {
                    // thêm obj vào mảng
                    
                    $obj = new OrderObj($row);

                    $orders_item = $this->FindOrdersItem($db, $row['order_code']);

                    $dataCustomer = [];
                    $dataCustomer['email'] = $row['email'];
                    $dataCustomer['phone'] = $row['phone'];
                    $customer = new CustomerObj($dataCustomer);

                    $obj->setOrder_items($orders_item);
                    $obj->setCustomer($customer);
                    $orders[] = $obj;
                }

                return $orders;
            } catch (PDOException $e) {
                return "Lỗi khi load đơn hàng";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

        // hủy đơn hàng
        function CancelOrder($data){
            try {
                $db = new DB();
                $db->conn->beginTransaction();

                // update trạng thái thành cancel
                $sql = "UPDATE `Orders` AS O SET O.state='cancelled' WHERE O.order_code = ?;";
                $params = array($data['order_code']);
                $db->execute($sql, $params);
                
                // load order
                $order = $this->FindOrder($data['order_code'], $db);
                
                // di chuyển order qua history
                $this->MoveOrderToHistory($db, $order[0]);

                // // load order details
                $order_details = $order[0]->getOrder_items();

                // di chuyển từng cái qua history
                foreach($order_details as $each){
                    $this->MoveOrderToHistoryDetails($db, $each);
                }

                // xóa order
                $sql = "DELETE FROM `Orders` AS O WHERE O.order_code = ?;";
                $params = array($data['order_code']);
                $db->execute($sql, $params);

                $db->conn->commit();
                echo "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                echo "Lỗi khi đổi trạng thái đơn hàng";
                //echo $e->getMessage();
            }
        }

        function UpdateDelivery($data){
            try {
                $db = new DB();
                $sql = "UPDATE `Orders` AS O SET O.state ='delivering' WHERE O.order_code = ?;";
                $params = array($data['order_code']);
                $db->execute($sql, $params);
                
                echo "done";
            } catch (PDOException $e) {

                echo "Lỗi khi đổi trạng thái thành vận chuyển";
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function CreatePayment($db, $data){
            try {
                $sql = "INSERT INTO `Payment`(`payment_code`, `order_code`, `type`) 
                VALUES (?,?,'cash');";
                $params = array($data['payment_code'], $data['order_code']);

                $db->execute($sql, $params);
            } catch (PDOException $e) {
                throw $e; 
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

       
        function PayOrder($data){
            try {
                $db = new DB();
                $db->conn->beginTransaction();

                //update trạng thái thành delivered
                $sql = "UPDATE `Orders` AS O SET O.state ='delivered' WHERE O.order_code = ?;";
                $params = array($data['order_code']);
                $db->execute($sql, $params);

                // tạo thanh toán cho đơn hàng
                $this->CreatePayment($db, $data);

                // load order
                $order = $this->FindOrder($data['order_code'], $db);

                //di chuyển order qua history
                $this->MoveOrderToHistory($db, $order[0]);

                // load order details
                $order_details = $order[0]->getOrder_items();

                // di chuyển từng cái qua history
                foreach($order_details as $each){
                    $this->MoveOrderToHistoryDetails($db, $each);
                }

                // xóa order
                $sql = "DELETE FROM `Orders` AS O WHERE O.order_code = ?;";
                $params = array($data['order_code']);
                $db->execute($sql, $params);

                $db->conn->commit();
                echo "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                //echo "Lỗi khi thanh toán";
                echo $e->getMessage();
            }
        }

         // xác nhận đơn đã giao
         function ConfirmDelivery($data){
            try {
                $db = new DB();
                $db->conn->beginTransaction();

                // update trạng thái thành delivered
                $sql = "UPDATE `Orders` AS O SET O.state= 'delivered' WHERE O.order_code = ?;";
                $params = array($data['order_code']);
                $db->execute($sql, $params);

                // // load order
                $order = $this->FindOrder($data['order_code'], $db);
                
                // // di chuyển order qua history
                $this->MoveOrderToHistory($db, $order[0]);
                
                // // load order details
                $order_details = $order[0]->getOrder_items();
                
                // di chuyển từng cái qua history
                foreach($order_details as $each){
                    $this->MoveOrderToHistoryDetails($db, $each);
                }
                
                // xóa order
                $sql = "DELETE FROM `Orders` AS O WHERE O.order_code = ?;";
                $params = array($data['order_code']);
                $db->execute($sql, $params);
                
                $db->conn->commit();
                echo "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                echo "Lỗi khi đổi trạng thái đơn hàng";
                //echo $e->getMessage();
            }
        }

        function MoveCartToOrder($data){
            try {
                $db = new DB();
                $db->conn->beginTransaction();

                // update trạng thái thành delivered
                $sql = "INSERT INTO `Orders`(`order_code`, `state`, `total_price`, `email`, `address`) VALUES (?,?,?,?,?);";
                $params = array($data['order_code'], 'pending', $data['total_price'], $data['email'], $data['address']);
                $db->execute($sql, $params);

                // // insert orderItem
                foreach($data['orderItem'] as $each){
                    $sql = "INSERT INTO `OrderItems`(`order_code`, `product_code`, `quantity`, `size`, `total_price`) VALUES (?,?,?,?,?);";
                    $params = array($data['order_code'], $each->getProduct()->getProduct_code(), $each->getQuantity(), $each->getSize(), $each->getTotal_price());
                    $db->execute($sql, $params);

                    $sql = "UPDATE ProductSizes AS PS SET PS.quantity = PS.quantity - ? WHERE PS.product_code= ? ,PS.size= ?;";
                    $params = array($each->getQuantity(), $each->getProduct()->getProduct_code(), $each->getSize());
                    $db->execute($sql, $params);
                }
                
                //di chuyển xóa sản phẩm trong giỏ hàng
                foreach($data['orderItem'] as $each){
                    $sql = "DELETE FROM CartItems AS CI WHERE CI.cart_code = ? AND CI.product_code = ? AND CI.size = ?";
                    $params = array($data['cart_code'], $each->getProduct()->getProduct_code(), $each->getSize());
                    $db->execute($sql, $params);
                }
                
                $db->conn->commit();
                echo "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                echo "Lỗi khi tạo đơn hàng";
                //echo $e->getMessage();
            }
        }

    }
?>
