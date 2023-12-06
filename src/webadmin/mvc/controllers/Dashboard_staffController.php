<?php
    class Dashboard_staffController extends Controller{
        function Show(){
            $model = $this->model("Admin");
            $data = $model->LoadAdmins();
            //var_dump($data);
            $page = $this->view("dashboard_staff", $data);
        }

        function validationStaff($data){
            // check thiếu data

            if($this->validateNull($data)){
                return "Vui lòng nhập đủ thông tin";
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

                $staff_data = array_map('trim', $staff_data);
                
                if($staff_data['role'] == 'admin'){
                    return "Không được thêm admin";
                }

                $check = $this->validationStaff($staff_data);
                if($check == "validated"){
                    
                    $model = $this->model("Admin");
                    $model->AddStaff($staff_data);
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
                );

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
                            $model->DeleteStaff($staff_data);
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
                            $model->DeleteStaff($staff_data);
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