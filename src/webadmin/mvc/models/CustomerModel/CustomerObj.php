<?php
    class CustomerObj{
        private $username;
        private $password;
        private $full_name;
        private $address;
        private $phone;
        private $email;

        public function __construct($row)
        {
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->full_name = $row['full_name'];
            $this->address = $row['address'];
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

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;
        }

        public function getFull_name()
        {
                return $this->full_name;
        }

        public function setFull_name($full_name)
        {
                $this->full_name = $full_name;
        }

        public function getAddress()
        {
                return $this->address;
        }

        public function setAddress($address)
        {
                $this->address = $address;
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