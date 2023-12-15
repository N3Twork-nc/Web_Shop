<?php 
include_once "./mvc/models/ProvinceModel/ProvinceObj.php";
    class Province extends DB{

        function LoadWard($district_id){
            try {
                $db = new DB();
                $sql = "SELECT * FROM Wards AS W WHERE W.district_id = ?";
                $params = array($district_id);
                $sth = $db->select($sql,$params);
                $arr = [];
                $ward_from_DB = $sth->fetchAll();
                foreach ($ward_from_DB as $row) {

                    // tạo sản phẩm
                    $obj = new WardObj($row);
                    
                    // thêm obj vào mảng
                    $arr[] = $obj;
                }
                return $arr;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
        }

        function LoadDistrict($province_id){
            try {
                $db = new DB();
                $sql = "SELECT * FROM District AS D WHERE D.province_id = ?";
                $params = array($province_id);
                $sth = $db->select($sql,$params);
                $arr = [];
                $district_from_DB = $sth->fetchAll();
                foreach ($district_from_DB as $row) {

                    // tạo sản phẩm
                    $obj = new DistrictObj($row);
                    $wards = $this->LoadWard($row['district_id']);
                    $obj->setWards($wards);
                    // thêm obj vào mảng
                    $arr[] = $obj;
                }
                return $arr;
            } catch (PDOException $e) {
                return  $sql . "<br>" . $e->getMessage();
            }
        }

        function LoadProvince(){
                try {
                    $db = new DB();
                    $sql = "SELECT * FROM `Province`";
                    $sth = $db->select($sql);
                    $arr = [];
                    $province_from_DB = $sth->fetchAll();
                    foreach ($province_from_DB as $row) {

                        // tạo sản phẩm
                        $obj = new ProvinceObj($row);
                        $districts = $this->LoadDistrict($row['province_id']);
                        $obj->setDistricts($districts);
                        // thêm obj vào mảng
                        $arr[] = $obj;
                    }
                    return $arr;
                } catch (PDOException $e) {
                    return  $sql . "<br>" . $e->getMessage();
                }
        }
    }
?>