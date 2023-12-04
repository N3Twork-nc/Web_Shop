<?php
    class CustomerObj{
        private $username;
        private $full_name;
        private $phone;
        private $email;

        public function __construct($row)
        {
            $this->username = $row['username'];
            $this->full_name = $row['full_name'];
            $this->phone = $row['phone'];
            $this->email = $row['email'];
        }

        public function getUsername()
        {
                return $this->username;
        }

        public function setUsername($username)
        {
                $this->username = $username;
        }

        public function getFull_name()
        {
                return $this->full_name;
        }

        public function setFull_name($full_name)
        {
                $this->full_name = $full_name;
        }

        public function getPhone()
        {
                return $this->phone;
        }

        public function setPhone($phone)
        {
                $this->phone = $phone;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;
        }
    }
?>