<?php

    class AuthController extends Controller{
        function Show(){
            $data = [];
            $page = $this->view("login", $data);
        }
        
        function Login(){

            // lấy và validate data
            $data = [];
            $username = '';
            $password = '';
            if(isset($_POST['username']) && isset($_POST['password'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
            }

            if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
            {
                  $secret = '6Ld6ijcpAAAAACKaMc5Aj023Y2LGsN2rqPZSHcpu'; //Thay thế bằng mã Secret Key của bạn
                  $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
                  $response_data = json_decode($verify_response);
                  if($response_data->success)
                  {
                    array_push($data, $username);
                    $pass_hash = hash('sha256', $password);
                    array_push($data, $pass_hash);
        
                    // gọi model xử lý data
                    $model = $this->model("Admin");
                    $result = $model->checkAccount($data);
        
                    if($result != null){
                        if($result[1] == 1){
                            $err = $model->EditStatus($data);
                            if($err != "done"){
                                $_SESSION['message'] = $err;
                                header("Location: /Auth");
                                exit;
                            }
                        }
                        $_SESSION['usr'] = $username;
                        $_SESSION['role'] = $result[0];
                        $_SESSION['status_expire'] = $result[1];
                        //setcookie('session_id', session_id(), time() + 1800, "/", "", false, true); // HTTP Only
                        // sinh một id khác nhưng data vẫn giữ nguyên
                        session_regenerate_id(true);
                        header("Location: /Dashboard_home");
                    }
                    else{
                        $_SESSION['message'] = "Wrong username or password";
                        header("Location: /Auth");
                        exit;
                    }
                  }
                  else
                  {
                      $message = 'Không thể xác thực, vui lòng thử lại';
                  }
             }else{
                $_SESSION['message'] = 'Không thể xác thực, vui lòng thử lại';
                header("Location: /Auth");
                exit;
             }
        }

        public function Logout(){
			// Hủy tất cả các biến session
			session_unset();
            session_regenerate_id(true);
			// Xóa tất cả các session đã lưu trữ trên máy chủ
			//session_destroy(); // có thể dùng để buộc logout

			// Chuyển hướng đến trang chính hoặc trang đăng nhập
			header("Location: /Auth");
            exit;
		}
    }
?>