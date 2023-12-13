<?php
    class Dashboard_categoryController extends Controller{
        private $access = false;

        function CheckAccess(){
            if($this->access == false){
                header('Location: /Dashboard_product');
                exit;
            }
        }

        function Show(){
            $model = $this->model("Category");
            $data = $model->LoadCategories();
            $page = $this->view("dashboard_category", $data);
        }

        function ValidateData($data){

            $this->CheckAccess();

            // check thiếu data
            if($this->validateNull($data)){
                return "Vui lòng nhập đủ thông tin";
            }

            $arr_Str["category_name"] = $data['category_name'];

            $arr_Number['category_parent_id'] = $data['category_parent_id'];
            $arr_Number['category_id'] = $data['category_id'] == null ? 0 : $data['category_id'];

            if($this->validateNumber($arr_Number)){
                //var_dump($arr_Number);
                return "Giá trị số không hợp lệ";
            }

            if($this->validateSpecialCharacter($arr_Str)){
                return "Dữ liệu không được chứa kí tự đặc biệt";
            }
            
            return 'validated';
        }

        function AddCategory(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $this->access = true;
    
                $category_data = array(
                    "category_name" => $_POST['CategoryName'],
                    "category_parent_id" => $_POST['CategoryParentID']
                );
                
                $category_data = array_map('trim', $category_data);

                $check = $this->ValidateData($category_data);
                if($check == "validated"){
                    
                        $model = $this->model("Category");
                        $model->InsertCategory($category_data);
                }
                else{
                    echo $check;
                }
            }
        }

        function EditCategory(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $this->access = true;
    
                $category_data = array(
                    "category_id" => $_POST['CategoryID'],
                    "category_name" => $_POST['CategoryName'],
                    "category_parent_id" => $_POST['CategoryParentID']
                );

                $category_data = array_map('trim', $category_data);
                    
                $check = $this->ValidateData($category_data);
                if($check == "validated"){
                    if($category_data["category_id"] <= 8){
                        echo "Không được sửa danh mục cha";
                    }
                    else if($category_data["category_id"] > 8){
                        $model = $this->model("Category");
                        $model->EditCategory($category_data);
                    }
                }
                else{
                    echo $check;
                }
            }
        }

        function DeleteCategory(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                $category_data = array(
                    "category_id" => $_POST['category_id']
                );

                $check = $this->validateNumber($category_data);
                $category_data = array_map('trim', $category_data);
                
                if($check == false){
                    if($category_data["category_id"] <= 8){
                        echo "Không được xóa danh mục cha";
                    }
                    else if($category_data["category_id"] > 8){
                        $model = $this->model("Category");
                        $model->DeleteCategory($category_data);}
                    }
                else{
                    echo $check;
                }
            }
        }
    }
?>