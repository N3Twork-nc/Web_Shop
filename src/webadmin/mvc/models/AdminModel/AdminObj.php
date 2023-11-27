<?php 
    class AdminObj{
        private $admin_id;
        private $username;
        private $password;
        private $role;

        public function __construct($row)
        {
            $this->admin_id = $row['admin_id'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            $this->role = $row['role'];
        }

        
        public function getAdmin_id()
        {
                return $this->admin_id;
        }

        public function getUsername()
        {
                return $this->username;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function getRole()
        {
                return $this->role;
        }

        public function setAdmin_id($admin_id)
        {
                $this->admin_id = $admin_id;

        }

        public function setUsername($username)
        {
                $this->username = $username;

        }

        
        public function setRole($role)
        {
                $this->role = $role;

        }

        public function setPassword($password)
        {
                $this->password = $password;

        }
    };
?>