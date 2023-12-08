<?php

    class AuthController extends Controller{
        private $categories;

        public function __construct()
        {   
            // load category
            $model = $this->model("Category");
            $data_category = $model->LoadCategories();

            foreach($data_category as $each){
                $key = $this->Str2Url($each->getName());
                $parent_name = $this->Str2Url($each->getParent_category_name());
                $each->setParent_category_name($parent_name);
                $data[$key] = $each;
            }

            $this->categories = $data;
        }
        function Show(){
            $data = [];
            $page = $this->view("login", $data);
        }
        
        function Login(){

            // lấy và validate data
            $data = [];
            $email = '';
            $password = '';
            if(isset($_POST['email']) && isset($_POST['password'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
            }

            array_push($data, $email);
            $pass_hash = hash('sha256', $password);
            array_push($data, $pass_hash);

            // gọi model xử lý data
            $model = $this->model("Customer");
            $result = $model->checkAccount($data);

            if($result != null){

                $data['email'] =  $email;
                $data['full_name'] =  $result['full_name'];
                $data['cart_code'] =  $result['cart_code'];
                $_SESSION['usr'] = $data;

                //setcookie('session_id', session_id(), time() + 1800, "/", "", false, true); // HTTP Only
                // sinh một id khác nhưng data vẫn giữ nguyên
                session_regenerate_id(true);
                header("Location: /Home");
            }
            else{
                $_SESSION['message'] = "Wrong username or password";
                header("Location: /Auth");
                exit;
            }

        }

        public function validateAccount($data){

            if($this->validateNull($data)){
                return "Vui lòng nhập đủ thông tin";
            }

            $arr_Number['phone'] = $data['phone'];

            $err = $this->validFullName($data['fullname']);
            
            if($err != "validated"){
                return $err;
            }
            
            if($this->validateNumber($arr_Number)){
                //var_dump($arr_Number);
                return "Số điện thoại không hợp lệ";
            }

            if($data['phone'][0] != '0' || strlen($data['phone']) < 10){
                return "Số điện thoại không hợp lệ";
            }

            if (!$this->validateEmail($data['email'])) {
                return "Email không hợp lệ!";
            }

            if($data['password'] != $data['retype_password']){
                return "Vui lòng nhập cùng một mật khẩu!";
            }

            if(strlen($data['password']) > 100){
                return "Mật khẩu quá dài!";
            }

            if(strlen($data['password']) < 10){
                return "Mật khẩu tối thiểu phải 10 kí tự!";
            }

            return "validated";
        }

        public function Register(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $account_data = array(
                    "fullname" => $_POST['fullname'],
                    "email" => $_POST['email'],
                    "password" => $_POST['password'],
                    "retype_password" => $_POST['retype_password'],
                    "phone" => $_POST['phone']
                );
                $err = $this->validateAccount($account_data);
                $err = "validated";
                if($err == "validated"){

                    // check xem email đã tồn tại chưa
                    $model = $this->model("Customer");
                    $customers = $model->FindCustomer($account_data['email']);
 
                    if($customers == true){
                        echo "Email đã tồn tại";
                    }
                    else{
                        
                        // hash mật khẩu
                        $pass_hash = hash('sha256', $account_data['password']);
                        $account_data['password'] = $pass_hash;

                        // tạo mã xác nhận
                        $verify_code = bin2hex(random_bytes(3));

                        // setup gửi mail kèm mã xác nhận
                        $data['email'] = $account_data['email'];
                        $data['fullname'] = $account_data['fullname'];
                        $data['subject'] = "Mã xác nhận cho SHOP PTIT";
                        $data['body'] = "Xin chào, " . $account_data['fullname'] ." <br> Bạn có đăng kí tài khoản tại trang web của chúng tôi, đây là mã xác nhận của bạn:
                        <div style='font-size:20px;font-family:LucidaGrande,tahoma,verdana,arial,sans-serif;padding:10px;background-color:#f2f2f2;border-left:1px solid #ccc;border-right:1px solid #ccc;border-top:1px solid #ccc;border-bottom:1px solid #ccc'>" . $verify_code . "</div>. Lưu ý mã sẽ hết hiệu lục sau 5 phút!";
                        $res = $this->SendMail($data);

                        // nếu gửi thành công
                        if($res == 'sent'){

                            // tạo session về thông tin khách hàng cũng như mã xác nhận
                            $_SESSION['account_data'] =  $account_data;
                            $token = bin2hex(random_bytes(20));
                            $_SESSION['token'] = $token;
                            $_SESSION['create_time'] = time();
                            $_SESSION['count'] = 0;
                            $_SESSION['verify_code'] = $verify_code;
                            echo "token:" . $token;

                        }
                        else{
                            echo "Lỗi khi gửi mã xác nhận, có thể do lỗi hệ thống hoặc email không đúng. Hãy kiểm tra và submit lại!";
                        }
                    }
                }
                else{
                    echo $err;
                }
            }
        }

        public function Logout(){
			// Hủy tất cả các biến session
			session_unset();

			// Xóa tất cả các session đã lưu trữ trên máy chủ
			//session_destroy(); // có thể dùng để buộc logout

			// Chuyển hướng đến trang chính hoặc trang đăng nhập
			header("Location: /Auth");
            exit;
		}

        public function Verify($params){

            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }
            
            $data['categories'] = $tmp;

            //check nếu params chỉ có 1 phần tử mới được chạy tiếp
            // so sánh token với chuỗi trong db
            // nếu giống thì báo thành công và hiện nút đăng nhập cho user
            // nếu không báo quay về trang chủ
            // xóa token trong db
            // nếu dược thì chỉ cho token tồn tại 15'

            $timeout = 300;

            if($params[0] == $_SESSION['token']){
                if(time() - $_SESSION['create_time'] > 300){
                    session_unset();
                    $page = $this->view("404", $data);
                }
                else{
                    if(isset($_POST['confirmCode'])){
                        if($_SESSION['count'] < 3){
                            if($_POST['confirmCode'] == $_SESSION['verify_code']){
                                // tạo mã giỏ hàng
                                $tmp =  explode("@",$_SESSION['account_data']['email']);
                                $cart_code = $tmp[0];
                                $cart_code = $cart_code . "_" . hash('sha256', $_SESSION['account_data']['email']);

                                $account_data = array(
                                    "full_name" => $_SESSION['account_data']['fullname'],
                                    "email" => $_SESSION['account_data']['email'],
                                    "password" => $_SESSION['account_data']['password'],
                                    "phone" => $_SESSION['account_data']['phone'],
                                    "cart_code" => $cart_code
                                );
                                
                                session_unset();
                                                    // check xem email đã tồn tại chưa
                                $model = $this->model("Customer");
                                $customers = $model->FindCustomer($_SESSION['email']);

                                if($customers == true){
                                    $_SESSION['create_time'] -= 300;
                                    $_SESSION['err'] =  "Email đã tồn tại vui lòng đăng kí lại!";
                                    $page = $this->view("confirmUser", $data);
                                }
                                else{

                                    $model = $this->model("Customer");
                                    $err = $model->InsertCustomer($account_data);
                                    if($err == "done"){
                                        $page = $this->view("registerSuccess", $data);
                                    }
                                    else{
                                        $_SESSION['err'] =  $err;
                                        $page = $this->view("confirmUser", $data);
                                    }
                                }
                            }
                            else{
                                $_SESSION['err'] = "Sai mã nhận";
                                $_SESSION['count'] += 1;
                                $page = $this->view("confirmUser", $data);
                            }
                        }
                        else{
                            $_SESSION['create_time'] -= 300;
                            $_SESSION['err'] =  "Quá số lần nhập, vui lòng tạo lại tài khoản";
                            $page = $this->view("confirmUser", $data);
                        }
                    }
                    else{
                        $page = $this->view("confirmUser", $data);
                    }
                }
            }               
            else{
                header("Location: /Auth");
            }
		}
    }
?>