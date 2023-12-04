<?php 
include_once "./mvc/models/OrderModel/OrderObj.php";
    class Order extends DB{

        function CheckOrderDelivered($data){
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
                    return "done";
                } catch (PDOException $e) {
                    return "Lỗi khi kiểm tra";
                    //return  $sql . "<br>" . $e->getMessage();
                }
        }

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

        function FindOrderDeliveredOrCancelled(){
            try {
                $db = new DB();

                $sql = "SELECT O.order_code FROM Orders AS O 
                WHERE O.state = 'delivered' OR O.state = 'cancelled'";
                $sth = $db->select($sql);
                $orders_code = [];
                $order_from_DB = $sth->fetchAll();
                foreach ($order_from_DB as $row) {
                    // thêm obj vào mảng
                    $orders_code[] = $row['order_code'];
                }
                return $orders_code;
            } catch (PDOException $e) {
                return "Lỗi khi kiểm tra";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }

        function CheckOrderHistory($data){

        }

        function MoveOrder($data){

        }

        function OrderInfo(){
            try {
                $db = new DB();
                $db->conn->beginTransaction();
                $sql = "SELECT TMP.*, P.payment_code, P.payment_date, P.type 
                FROM (
                    SELECT O.*, C.phone, C.email 
                    FROM Orders AS O, Customers AS C 
                    WHERE (O.state = 'delivered' OR O.state = 'cancelled') AND O.username = C.username
                    ) AS TMP 
                    LEFT JOIN Payment AS P 
                    ON P.order_code = TMP.order_code";
                $sth = $db->select($sql);
                $orders_code = [];
                $order_from_DB = $sth->fetchAll();
                foreach ($order_from_DB as $row) {
                    // thêm obj vào mảng
                    $this->MoveOrder($row);
                }

                $db->conn->commit();
                return $orders_code;
            } catch (PDOException $e) {
                return "Lỗi khi kiểm tra";
                //return  $sql . "<br>" . $e->getMessage();
            }
        }
    }
?>
