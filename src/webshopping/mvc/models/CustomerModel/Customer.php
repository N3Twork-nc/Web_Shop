<?php 
include_once "./mvc/models/CustomerModel/CustomerObj.php";
    class Customer extends DB{

        function checkAccount($data){
            try {
                $arr = [];
                $db = new DB();
                $sql = "SELECT C.*, SC.cart_code FROM Customers AS C, ShoppingCart AS SC 
                WHERE C.email = SC.email AND C.email = ? AND C.password = ?";
                $params = array($data[0],$data[1]);
                $sth = $db->select($sql, $params);
                if ($sth->rowCount() > 0) {
                    $row = $sth->fetch();
                    $arr['cart_code'] = $row['cart_code'];
                    $arr['full_name'] = $row['full_name'];
                }
                return $arr;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
        }

        function LoadCustomers(){
                try {
                    $db = new DB();
                    $sql = "SELECT C.full_name, C.phone, C.email 
                    FROM Customers AS C";
                    $sth = $db->select($sql);
                    $arr = [];
                    $customers_from_DB = $sth->fetchAll();
                    foreach ($customers_from_DB as $row) {

                        // tạo sản phẩm
                        $obj = new CustomerObj($row);
                        
                        // thêm obj vào mảng
                        $arr[] = $obj;
                    }
                    return $arr;
                } catch (PDOException $e) {
                    return  $sql . "<br>" . $e->getMessage();
                }
        }

        function FindCustomer($email){
            try {
                $db = new DB();
                $sql = "SELECT *
                FROM Customers AS C WHERE C.email = ?";
                $params = array($email);
                $sth = $db->select($sql, $params);

                if ($sth->rowCount() > 0) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertCustomerCart($db, $data){
            try {
                
                $sql = "INSERT INTO `ShoppingCart`(`cart_code`, `email`) 
                VALUES (?,?)";
                $params = array($data['cart_code'], $data['email']);
                $db->execute($sql, $params);

                return "done";
            } catch (PDOException $e) {
                throw $e;
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function InsertCustomer($data){
            try {
                $db = new DB();
                $db->conn->beginTransaction();
                $sql = "INSERT INTO `Customers`(`email`, `password`, `full_name`, `phone`) 
                VALUES (?,?,?,?)";
                $params = array($data['email'], $data['password'], $data['full_name'], $data['phone']);
                $db->execute($sql, $params);
                $this->InsertCustomerCart($db, $data);
                $db->conn->commit();
                return "done";
            } catch (PDOException $e) {
                $db->conn->rollBack();
                return "Lỗi khi thêm thông tin khách hàng";
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }

        function DeleteCustomer($data){
            try {
                $db = new DB();
                $sql = "DELETE FROM `Customers` WHERE `email` = ?;";
                $params = array($data['email']);
                $db->execute($sql, $params);

                echo "done";
            } catch (PDOException $e) {

                echo "Lỗi khi xóa khách hàng";
                //echo  $sql . "<br>" . $e->getMessage();
            }
        }
    }
?>