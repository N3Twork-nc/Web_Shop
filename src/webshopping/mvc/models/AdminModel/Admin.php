<?php 
include_once "./mvc/models/AdminModel/AdminObj.php";
    class Admin extends DB{
        private $table = "AdminAccounts";
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
    }
?>