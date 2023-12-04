<?php 
include_once "./mvc/models/AdminModel/AdminObj.php";
    class Admin extends DB{
        function checkAccount($data){
                try {
                    $arr = [];
                    $db = new DB();
                    $sql = "select * from AdminAccounts where username=? and password=?";
                    $params = array($data[0],$data[1]);
                    $sth = $db->select($sql, $params);
                    if ($sth->rowCount() > 0) {
                        $row = $sth->fetch();
                        array_push($arr, $row['role']);
                    }
                    return $arr;
                } catch (PDOException $e) {
                    return  $sql . "<br>" . $e->getMessage();
                }
        }

        function LoadAdmins(){
            try {
                $arr = [];
                $db = new DB();
                $sql = "select * from AdminAccounts";
                $sth = $db->select($sql);
                $admin_from_DB = $sth->fetchAll();
                foreach ($admin_from_DB as $row) {
                    // thêm obj vào mảng
                    
                    $obj = new AdminObj($row);

                    $arr[] = $obj;
                }
                return $arr;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
    }
    }
?>