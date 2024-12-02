<?php
    class DB{
        public $conn;
        private $username =  'customer';
        private $password = 'day_la_customer_ptithcm';
        private $sslCa = '/var/www/html/DigiCertGlobalRootCA.crt.pem';

        public function __construct() {
            //ini_set('display_errors', 'Off');
            $connectionString = "mysql:host=" . getenv('MYSQL_HOSTNAME') . ";dbname=" . getenv('MYSQL_DATABASE');
            try {
                // Tạo kết nối PDO với cấu hình SSL
                $conn = new \PDO(
                    $connectionString,
                    $this->username,
                    $this->password,
                    [
                        PDO::MYSQL_ATTR_SSL_CA => $this->sslCa, // Cấu hình SSL
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Kích hoạt chế độ lỗi
                    ]
                );
        
                $this->conn = $conn;
            } catch (\PDOException $e) {
                // Xử lý lỗi nếu kết nối thất bại
                die("Connection failed: " . $e->getMessage());
            }
        }
        public function select($sql, $params = null)
        {
            $connect = $this->conn;
            if($params != null){

                $res = $connect->prepare($sql);
                $res->execute($params);
            }
            else {
                $res = $connect->query($sql);
            }
            $res->setFetchMode(PDO::FETCH_ASSOC);
            $connect = null;
            return $res;
        }

        public function execute($sql, $params){
            $connect = $this->conn;
            $res = $connect->prepare($sql);
            $res->execute($params);
            $connect = null;
        }

        public function getUsername()
        {
                return $this->username;
        }

        public function setUsername($username)
        {
                $this->username = $username;
        }
    }
?>