<?php
    class Dashboard_staffController extends Controller{
        private $access = false;

        function CheckAccess(){
            if($this->access == false){
                header('Location: /Dashboard_order');
                exit;
            }
        }
        function Show(){
            $model = $this->model("Admin");
            $data = $model->LoadAdmins();
            $data["csrf_token_staff"] =  bin2hex(random_bytes(50));
            $_SESSION["csrf_token_staff"] =  $data["csrf_token_staff"];
            $page = $this->view("dashboard_staff", $data);
        }

        function validationStaff($data){
            $this->CheckAccess();
            // check thiếu data

            if($this->validateNull($data)){
                echo "Vui lòng nhập đủ thông tin";
                return;
            }

            $arr_Str["username"] = $data['username'];

            if($this->validateSpecialCharacter($arr_Str)){
                return "Dữ liệu không được chứa kí tự đặc biệt";
            }

            return "validated";
        }

        function AddStaff(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                $staff_data = array(
                    "username" => $_POST['username'],
                    "password" => $_POST['password'],
                    "role" => $_POST['role']
                );
                $this->access = true;
                $staff_data = array_map('trim', $staff_data);
                
                if($staff_data['role'] == 'admin'){
                    echo "Không được thêm admin";
                    return;
                }

                $check = $this->validationStaff($staff_data);
                if($check == "validated"){
                    $data_password['password'] = $staff_data['password'];
                    $data_password['retype_password'] = $staff_data['password'];
                    $err = $this->checkStrongPassword($data_password);
                    if($err != "validated"){
                        echo $err;
                        return;
                    }
                    $staff_data['password'] = hash('sha256', $staff_data['password']);
                    $model = $this->model("Admin");
                    $err = $model->AddStaff($staff_data);
                    echo $err;
                }
                else{
                    echo $check;
                }
            }
        }

        function EditStaff(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                $staff_data = array(
                    "username" => $_POST['username'],
                    "role" => $_POST['role']
                );
                $this->access = true;
                $staff_data = array_map('trim', $staff_data);
                    
                $check = $this->validationStaff($staff_data);
                if($staff_data['role'] == 'admin'){
                    echo "Không được sửa nhân viên thành admin";
                    return;
                }
                if($check == "validated"){
                    $model = $this->model("Admin");

                    $user = $model->FindAdmin($staff_data['username']);

                    if($user->getRole() == 'admin'){
                        echo "Không có quyền sửa admin";
                    }
                    else{
                        if(empty($user->getUsername())){
                            echo "User không tồn tại!";
                        }
                        else{
                            $err = $model->EditStaff($staff_data);
                            echo $err;
                        }
                    }
                }
                else{
                    echo $check;
                }
            }
        }

        function ResetPassword(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                $staff_data = array(
                    "username" => $_POST['username'],
                    "password" => $_POST['password']
                );
                $this->access = true;
                $staff_data = array_map('trim', $staff_data);
                    
                $check = $this->validationStaff($staff_data);

                if($check == "validated"){
                    
                    $model = $this->model("Admin");

                    $user = $model->FindAdmin($staff_data['username']);

                    if($user->getRole() == 'admin'){
                        echo "Không có quyền reset password admin";
                    }
                    else{
                        if(empty($user->getUsername())){
                            echo "User không tồn tại!";
                        }
                        else{
                            $data_password['password'] = $staff_data['password'];
                            $data_password['retype_password'] = $staff_data['password'];
                            $err = $this->checkStrongPassword($data_password);
                            if($err != "validated"){
                                echo $err;
                                return;
                            }
                            $staff_data['password'] = hash('sha256', $staff_data['password']);
                            $err = $model->ResetPassword($staff_data);
                            echo $err;
                        }
                    }
                }
                else{
                    echo $check;
                }
            }
        }

        function DeleteStaff(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                $staff_data = array(
                    "username" => $_POST['username'],
                );
                $this->access = true;
                $staff_data = array_map('trim', $staff_data);

                $check = $this->validationStaff($staff_data);

                if($check == "validated"){
                    
                    $model = $this->model("Admin");

                    $user = $model->FindAdmin($staff_data['username']);

                    if($user->getRole() == 'admin'){
                        echo "Không có quyền xóa admin";
                    }
                    else{
                        if(empty($user->getUsername())){
                            echo "User không tồn tại!";
                        }
                        else{
                            $err = $model->DeleteStaff($staff_data);
                            echo $err;
                        }
                    }
                }
                else{
                    echo $check;
                }
            }
        }
    }
?>