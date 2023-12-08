<?php
    class CustomerObj{
        private $email;
        private $full_name;
        private $phone;

        public function __construct($row)
        {
            $this->email = $row['email'];
            $this->full_name = $row['full_name'];
            $this->phone = $row['phone'];
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