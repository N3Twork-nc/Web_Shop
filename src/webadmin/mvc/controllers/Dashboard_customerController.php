<?php
    class Dashboard_customerController extends Controller{
        private $access = false;

        function CheckAccess(){
            if($this->access == false){
                header('Location: /Dashboard_customer');
                exit;
            }
        }
        function Show(){
            $model = $this->model("Customer");
            $data['customer'] = $model->LoadCustomers();
            $data["csrf_token_customer"] =  bin2hex(random_bytes(50));
            $_SESSION["csrf_token_customer"] =  $data["csrf_token_customer"];
            //echo $data["csrf_token_customer"];
            $page = $this->view("dashboard_customer", $data);
        }

        function validationCustomer($data){
            $this->CheckAccess();
            // check thiếu data

            if($this->validateNull($data)){
                if(empty($data["csrf_token_customer"])){
                    return "Lỗi";
                }
                return "Vui lòng nhập đủ thông tin";
            }
            $arr_Number['phone'] = $data['phone'];

            if($this->validateNumber($arr_Number)){
                //var_dump($arr_Number);
                return "Giá trị số không hợp lệ";
            }

            $arr_Str["full_name"] = $data['full_name'];

            if($this->validateName($arr_Str)){
                return "Tên khách hàng không được chứa số";
            }

            if($this->validateSpecialCharacter($arr_Str)){
                return "Dữ liệu không được chứa kí tự đặc biệt";
            }

            if($data['phone'][0] != '0' || strlen($data['phone']) < 10){
                return "Vui lòng nhập đúng số điện thoại";
            }

            if (!$this->validateEmail($data['email'])) {
                return "Email không hợp lệ!";
            }
            return "validated";
        }

        function Edit(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $customer_data = array(
                    "full_name" => $_POST['TenKhachHang'],
                    "email" => $_POST['Email'],
                    "phone" => $_POST['SDT'],
                    "csrf_token_customer" => $_POST['csrf_token_customer']
                );
                $this->access = true;
                $customer_data = array_map('trim', $customer_data);

                $res = $this->validationCustomer($customer_data);
                if($res == "validated"){
                    if($customer_data['csrf_token_customer'] == $_SESSION['csrf_token_customer'] && !empty($customer_data['csrf_token_customer'])){
                        $model = $this->model("Customer");
                        $err = $model->EditCustomer($customer_data);
                        echo $err;
                    }
                    else{
                        echo "Lỗi";
                    }
                }
                else {
                    echo $res;
                }
                
            }
        }
    }
?>