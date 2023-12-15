<?php
    class ProvinceObj{
        private $province_id;
        private $name;
        private $districts;

        public function __construct($row)
        {
            $this->province_id = $row['province_id'];
            $this->name = $row['name'];
        }
        
        public function getProvince_id()
        {
                return $this->province_id;
        }

        public function setProvince_id($province_id)
        {
                $this->province_id = $province_id;
        }

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;
        }
        public function getDistricts()
        {
                return $this->districts;
        }

        public function setDistricts($districts)
        {
                $this->districts = $districts;

        }
    }
    class DistrictObj{
        private $district_id;
        private $province_id;
        private $name;
        private $wards;

        public function __construct($row)
        {
            $this->district_id = $row['district_id'];
            $this->province_id = $row['province_id'];
            $this->name = $row['name'];
        }

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;

        }

        public function getDistrict_id()
        {
                return $this->district_id;
        }

        public function setDistrict_id($district_id)
        {
                $this->district_id = $district_id;
        }

        public function getProvince_id()
        {
                return $this->province_id;
        }

        public function setProvince_id($province_id)
        {
                $this->province_id = $province_id;
        }
        public function getWards()
        {
                return $this->wards;
        }

        public function setWards($wards)
        {
                $this->wards = $wards;
        }
    }
    class WardObj{
        private $district_id;
        private $ward_id;
        private $name;

        public function __construct($row)
        {
            $this->district_id = $row['district_id'];
            $this->ward_id = $row['ward_id'];
            $this->name = $row['name'];
        }

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;

        }

        public function getDistrict_id()
        {
                return $this->district_id;
        }

        public function setDistrict_id($district_id)
        {
                $this->district_id = $district_id;
        }

    }
?>