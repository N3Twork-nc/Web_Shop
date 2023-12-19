<?php
    class MiddleWare extends DB{
        public function __construct() {
            if(isset($_SESSION['usr'])){
                try {
                    $db = new DB();
                    $sql = "select * from AdminAccounts where username=?";
                    $params = array($_SESSION['usr']);
                    $sth = $db->select($sql, $params);
                    if ($sth->rowCount() > 0) {
                        $row = $sth->fetch();
                        if($row['status_expire'] == 1){
                            session_unset();
                            session_regenerate_id(true);
                        }
                    }
                } catch (PDOException $e) {
                    session_unset();
                    session_regenerate_id(true);
                    return  "Lỗi";
                }
            }
        }
    }
?>