<?php 
include_once "./mvc/models/OrderModel/OrderObj.php";
    class Order extends DB{

        //check đơn hàng chưa giao xong
        function CheckOrderNotDeliveredYet($data){
                try {
                    $db = new DB();
                    if(isset($data['username'])){
                        $sql = "SELECT * FROM Orders AS O 
                            WHERE O.username = ? AND O.state != 'delivered'";
                        $params = array($data['username']);
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

                    $orders_items[] = $obj;
                }

                return $orders_items;
            } catch (PDOException $e) {
                return "Lỗi khi load chi tiết đơn hàng";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

        // load đơn hàng
        function LoadOrder(){
            try {
                $db = new DB();
                $sql = "SELECT TMP.*, P.payment_code, P.payment_date, P.type 
                FROM (
                    SELECT O.*, C.phone 
                    FROM Orders AS O, Customers AS C 
                    WHERE O.username = C.username
                    ) AS TMP 
                    LEFT JOIN Payment AS P 
                    ON P.order_code = TMP.order_code";
                $sth = $db->select($sql);
                $orders = [];
                $order_from_DB = $sth->fetchAll();
                foreach ($order_from_DB as $row) {
                    // thêm obj vào mảng
                    
                    $obj = new OrderObj($row);

                    $orders_item = $this->LoadOrdersItem($row['order_code']);

                    $dataCustomer = [];
                    $dataCustomer['username'] = $row['username'];
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
            
                    $orders_items[] = $obj;
                }
        
                return $orders_items;
                } catch (PDOException $e) {
                    return "Lỗi khi load chi tiết lịch sử đơn hàng";
                        //return  $sql . "<br>" . $e->getMessage();
                }
            }
        
                // load lịch sử đơn hàng
            function LoadOrderHistory(){
                try {
                    $db = new DB();
                    $sql = "SELECT * FROM `OrdersHistory`";
                    $sth = $db->select($sql);
                    $orders = [];
                    $order_from_DB = $sth->fetchAll();
                    foreach ($order_from_DB as $row) {
                        // thêm obj vào mảng
                        $row['type'] = $row['payment_type']; 
                        $obj = new OrderObj($row);
        
                        $orders_item = $this->LoadOrderHistoryItem($row['order_code']);
        
                        $dataCustomer = [];
                        $dataCustomer['username'] = $row['username'];
                        $dataCustomer['phone'] = $row['phone'];
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
                    $sql = "INSERT INTO `OrdersHistory`(`order_code`, `order_date`, `state`, `username`, `address`, `phone`, `total_price`) 
                    VALUES (?,?,?,?,?,?,?);";
                    $params = array($order->getOrder_code(), $order->getOrder_date(), $order->getState(), $order->getCustomer()->getUsername(), $order->getAddress(), $order->getCustomer()->getPhone(), $order->getTotal_price());
                }
                else {
                    $sql = "INSERT INTO `OrdersHistory`(`order_code`, `order_date`, `payment_code`, `payment_date`, `payment_type`, `state`, `username`, `address`, `phone`, `total_price`)
                    VALUES (?,?,?,?,?,?,?,?,?,?);";
                    $params = array($order->getOrder_code(), $order->getOrder_date(), $order->getPayment_code(), $order->getPayment_date(), $order->getType(), $order->getState(), $order->getCustomer()->getUsername(), $order->getAddress(), $order->getCustomer()->getPhone(), $order->getTotal_price());
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
                    WHERE O.username = C.username AND O.order_code = ?
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
                    $dataCustomer['username'] = $row['username'];
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
                VALUES (?,?,'bank_transfer');";
                $params = array($data['payment_code'], $data['order_code']);

                $db->execute($sql, $params);
            } catch (PDOException $e) {
                throw $e; 
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

        // hủy đơn hàng
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

    }
?>
