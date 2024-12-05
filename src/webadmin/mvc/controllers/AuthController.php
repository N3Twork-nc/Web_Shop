<?php

class AuthController extends Controller
{
    private $categories;
    private $access = false;
    public function Str2Url($string)
    {
        // Loại bỏ các ký tự không hợp lệ
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]+/', '-', $string);
        return trim($string, '-');
    }


    function CheckAccess()
    {
        if ($this->access == false) {
            header('Location: /Dashboard_category');
            exit;
        }
    }

    public function __construct()
    {
        // Load category
        $model = $this->model("Category");
        $data_category = $model->LoadCategories();

        // Kiểm tra $data_category trước khi lặp
        if (is_array($data_category) || is_iterable($data_category)) {
            foreach ($data_category as $each) {
                $key = $this->Str2Url($each->getName());
                $parent_name = $this->Str2Url($each->getParent_category_name());
                $each->setParent_category_name($parent_name);
                $data[$key] = $each;
            }

            $this->categories = $data;
        } else {
            // Xử lý khi $data_category không hợp lệ
            error_log('Invalid $data_category: ' . print_r($data_category, true));
            $this->categories = [];
        }
    }


    function Show()
    {
        $data = [];
        $page = $this->view("login", $data);
    }

    function Login()
    {

        // lấy và validate data
        $data = [];
        $email = '';
        $password = '';
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
        }

        array_push($data, $email);
        $pass_hash = hash('sha256', $password);
        array_push($data, $pass_hash);

        // gọi model xử lý data
        $model = $this->model("Customer");
        $result = $model->checkAccount($data);

        if (!empty($result)) {
            $data['email'] = $email;
            $data['full_name'] = $result['full_name'];
            $data['cart_code'] = $result['cart_code'];
            $_SESSION['usr'] = $data;

            //setcookie('session_id', session_id(), time() + 1800, "/", "", false, true); // HTTP Only
            // sinh một id khác nhưng data vẫn giữ nguyên
            session_regenerate_id(true);
            header("Location: /Category/Show/");
        } else {
            $_SESSION['message'] = "Wrong username or password";
            header("Location: /Auth");
            exit;
        }
    }

    public function validateAccount($data)
    {
        $this->CheckAccess();

        if ($this->validateNull($data)) {
            return "Vui lòng nhập đủ thông tin";
        }

        $arr_Number['phone'] = $data['phone'];

        $err = $this->validFullName($data['fullname']);

        if ($err != "validated") {
            return $err;
        }

        if ($this->validateNumber($arr_Number)) {
            return "Số điện thoại không hợp lệ";
        }

        if ($data['phone'][0] != '0' || strlen($data['phone']) < 10) {
            return "Số điện thoại không hợp lệ";
        }

        if (!$this->validateEmail($data['email'])) {
            return "Email không hợp lệ!";
        }

        $password['password'] = $data['password'];
        $password['retype_password'] = $data['retype_password'];

        $err = $this->checkStrongPassword($password);
        if ($err != "validated") {
            return $err;
        }
        return "validated";
    }

    public function Register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $account_data = array(
                "fullname" => $_POST['fullname'],
                "email" => $_POST['email'],
                "password" => $_POST['password'],
                "retype_password" => $_POST['retype_password'],
                "phone" => $_POST['phone']
            );
            $this->access = true;
            $account_data = array_map('trim', $account_data);
            $err = $this->validateAccount($account_data);

            if ($err == "validated") {
                $model = $this->model("Customer");
                $customers = $model->FindCustomer($account_data['email']);

                if ($customers == true) {
                    echo "Email đã tồn tại";
                } else {
                    // hash mật khẩu
                    $pass_hash = hash('sha256', $account_data['password']);
                    $account_data['password'] = $pass_hash;

                    // tạo mã xác nhận
                    $verify_code = bin2hex(random_bytes(4));

                    // setup gửi mail kèm mã xác nhận
                    $data['email'] = $account_data['email'];
                    $data['fullname'] = $account_data['fullname'];
                    $data['subject'] = "Mã xác nhận cho SHOP N3TWork";
                    $data['body'] = "Xin chào, " . $account_data['fullname'] . " <br> Bạn có đăng kí tài khoản tại trang web của chúng tôi, đây là mã xác nhận của bạn:
                    <div style='font-size:20px;font-family:LucidaGrande,tahoma,verdana,arial,sans-serif;padding:10px;background-color:#f2f2f2;border-left:1px solid #ccc;border-right:1px solid #ccc;border-top:1px solid #ccc;border-bottom:1px solid #ccc'>" . $verify_code . "</div>. Lưu ý mã sẽ hết hiệu lục sau 5 phút!";
                    $res = $this->SendMail($data);

                    // nếu gửi thành công
                    if ($res == 'sent') {
                        $_SESSION['account_data'] = $account_data;
                        $token = bin2hex(random_bytes(20));
                        $_SESSION['token'] = $token;
                        $_SESSION['create_time'] = time();
                        $_SESSION['count'] = 0;
                        $_SESSION['verify_code'] = $verify_code;
                        echo "token:" . $token;
                    } else {
                        echo "Lỗi khi gửi mã xác nhận, có thể do lỗi hệ thống hoặc email không đúng. Hãy kiểm tra và submit lại!";
                    }
                }
            } else {
                echo $err;
            }
        }
    }


    public function ForgotPassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $check = true;
            $verify_data = array(
                "email" => $_POST['email']
            );
            $this->access = true;
            $verify_data = array_map('trim', $verify_data);

            if (!$this->validateEmail($verify_data['email']) || empty($verify_data['email'])) {
                echo "Email không hợp lệ!";
            } else {
                // check xem email đã tồn tại chưa
                $model = $this->model("Customer");
                $customers = $model->FindCustomer($verify_data['email']);

                if ($customers == true) {
                    $arrVerify = $model->FindCustomerVerify($verify_data);

                    // tạo mã xác nhận
                    $token = bin2hex(random_bytes(100));
                    // nếu chưa gửi mã xác thực lần nào
                    if (empty($arrVerify)) {
                        $verify_data['token'] = $token;
                        $verify_data['count'] = 0;
                        $err = $model->InsertToken($verify_data);
                        if ($err != 'done') {
                            $check = false;
                            echo "Lỗi";
                        }
                    } else {
                        $oneDayInSeconds = 24 * 60 * 60; // Số giây trong một ngày

                        if ($arrVerify[0]->getCount() > 3) {
                            $dateTime = new DateTime($arrVerify[0]->getCreate_time());
                            $timestamp = $dateTime->getTimestamp();
                            if (time() - $timestamp >= $oneDayInSeconds) {
                                $verify_data['token'] = $token;
                                $verify_data['count'] = 0;
                                $err = $model->DeleteToken($verify_data);
                                if ($err != 'done') {
                                    $check = false;
                                    echo "Lỗi";
                                } else {
                                    $err = $model->InsertToken($verify_data);
                                    if ($err != 'done') {
                                        $check = false;
                                        echo "Lỗi";
                                    }
                                }
                            } else {
                                $check = false;
                                echo "Bạn đã quá số lần gửi mã xác nhận cho hôm nay! Thử lại sau 24 tiếng!";
                            }
                        } else {
                            $dateTime = new DateTime($arrVerify[0]->getCreate_time());
                            $timestamp = $dateTime->getTimestamp();
                            if (time() - $timestamp >= $oneDayInSeconds) {
                                $verify_data['token'] = $token;
                                $verify_data['count'] = 0;
                                $err = $model->DeleteToken($verify_data);
                                if ($err != 'done') {
                                    $check = false;
                                    echo "Lỗi";
                                } else {
                                    $err = $model->InsertToken($verify_data);
                                    if ($err != 'done') {
                                        $check = false;
                                        echo "Lỗi";
                                    }
                                }
                            } else {
                                $verify_data['token'] = $token;
                                $verify_data['count'] = $arrVerify[0]->getCount() + 1;
                                $verify_data['used'] = 0;
                                $err = $model->UpdateToken($verify_data);
                                if ($err != 'done') {
                                    $check = false;
                                    echo "Lỗi";
                                }
                            }
                        }
                    }

                    if ($check) {
                        // setup gửi mail kèm mã xác nhận
                        $link = "<a href='http://localhost:8092/Auth/ResetPassword/$token'>Bấm vào đây để đặt lại mật khẩu</a>";
                        $data['email'] = $verify_data['email'];
                        $data['subject'] = "Reset mật khẩu tài khoản SHOP N3TWork";
                        $data['body'] = '<html><body>Bạn vừa gửi yêu cầu đặt lại mật khẩu vài phút trước:<br> ' . $link . '</body></html>';
                        $res = $this->SendMail($data);

                        // nếu gửi thành công
                        if ($res == 'sent') {
                            echo "Vui lòng kiểm tra mail của bạn để tiếp tục!";
                        } else {
                            echo "Lỗi khi gửi mail, có thể do lỗi hệ thống hoặc email không đúng. Hãy kiểm tra và submit lại!";
                        }
                    }
                } else {
                    echo "Vui lòng kiểm tra mail của bạn để tiếp tục!";
                }
            }
        }
    }


    public function ResetPassword($params)
    {

        $tmp = [];
        foreach ($this->categories as $key => $value) {
            $tmp[$value->getParent_category_name()][$key] = $value->getName();
        }

        $data['categories'] = $tmp;
        if (!empty($params)) {

            $data_token['token'] = $params[0];
            $model = $this->model("Customer");
            $arrVerify = $model->FindCustomerVerify($data_token);

            if (empty($arrVerify)) {
                header("Location: /Auth");
            } else {
                $dateTime = new DateTime($arrVerify[0]->getUpdate_time());
                $update_time = $dateTime->getTimestamp();
                if (time() - $update_time > 300 || $arrVerify[0]->getUsed() == 1) {
                    if ($arrVerify[0]->getUsed() == 0) {
                        $data_user = [
                            'email' => $arrVerify[0]->getEmail(),
                            'used' => 1
                        ];
                        $err = $model->UpdateVerifyTokenStatus($data_user);
                    }
                    $page = $this->view("404", $data);
                } else {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST['password']) || empty($_POST['retype_password'])) {
                            echo "Vui lòng nhập đủ thông tin";
                        } else {
                            $data_pass['password'] = $_POST['password'];
                            $data_pass['retype_password'] = $_POST['retype_password'];
                            $err = $this->checkStrongPassword($data_pass);
                            if ($err != "validated") {
                                return $err;
                            } else {
                                $password = hash('sha256', $_POST['password']);
                                $data_user = [
                                    'email' => $arrVerify[0]->getEmail(),
                                    'password' => $password,
                                    'used' => 1
                                ];

                                $model = $this->model("Customer");
                                $err = $model->ResetPassword($data_user);
                                if ($err != "done") {
                                    echo $err;
                                } else {
                                    $err = $model->UpdateVerifyTokenStatus($data_user);
                                    if ($err != "done") {
                                        echo $err;
                                    } else {
                                        echo "done";
                                    }
                                }
                            }
                        }
                    } else {
                        $data['token'] = $params[0];
                        $page = $this->view("changePassword", $data);
                    }
                }
            }
        } else {
            header("Location: /Auth");
        }
    }
}
?>