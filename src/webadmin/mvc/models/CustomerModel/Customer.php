<?php 
include_once "./mvc/models/CustomerModel/CustomerObj.php";
    class Customer extends MiddleWare{

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

        function EditCustomer($data){
            try {
                $db = new DB();
                $sql = "UPDATE `Customers` SET `full_name` = ?, `phone` = ? WHERE `email` = ?;";
                $params = array($data['full_name'], $data['phone'], $data['email']);
                $db->execute($sql, $params);

                return "done";
            } catch (PDOException $e) {

                if ($e->getCode() == '42000') {
                    // Xử lý khi có lỗi SQLSTATE 42000
                    return "Bạn không có quyền làm thao tác này";
                } else {
                    // Xử lý cho các lỗi khác
                    //return "Lỗi: " . $e->getMessage();
                    return "Lỗi khi sửa thông tin khách hàng";
                }
            }
        }

        function DeleteCustomer($data){
            try {
                $db = new DB();
                $sql = "DELETE FROM `Customers` WHERE `email` = ?;";
                $params = array($data['email']);
                $db->execute($sql, $params);

                return "done";
            } catch (PDOException $e) {
                if ($e->getCode() == '42000') {
                    // Xử lý khi có lỗi SQLSTATE 42000
                    return "Bạn không có quyền làm thao tác này";
                } else {
                    // Xử lý cho các lỗi khác
                    //return "Lỗi: " . $e->getMessage();
                    return "Lỗi khi xóa khách hàng";
                }
            }
        }
    }
?>