<?php 
include_once "./mvc/models/CustomerModel/CustomerObj.php";
    class Customer extends DB{

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

        // function EditCustomerPassword($data){
        //     try {
        //         $db = new DB();
        //         $sql = "UPDATE `Customers` SET `password` = ? WHERE `username` = ?;";
        //         $params = array($data['password'], $data['username']);
        //         $db->execute($sql, $params);

        //         echo "done";
        //     } catch (PDOException $e) {

        //         echo "Lỗi khi sửa thông tin khách hàng";
        //         //echo  $sql . "<br>" . $e->getMessage();
        //     }
        // }

        function EditCustomer($data){
            try {
                $db = new DB();
                $sql = "UPDATE `Customers` SET `full_name` = ?, `phone` = ? WHERE `email` = ?;";
                $params = array($data['full_name'], $data['phone'], $data['email']);
                $db->execute($sql, $params);

                echo "done";
            } catch (PDOException $e) {

                echo "Lỗi khi sửa thông tin khách hàng";
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