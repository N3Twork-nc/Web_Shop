<?php
    class Dashboard_productController extends Controller{
        private $access = false;

        function CheckAccess(){
            if($this->access == false){
                header('Location: /Dashboard_product');
                exit;
            }
        }

        function Show(){

            $data = [];
            // load product
            $model = $this->model("Product");
            $data["products"] = $model->LoadProducts();

            // load category
            $model = $this->model("Category");
            $data["categories"] = $model->LoadCategories();

            $page = $this->view("dashboard_product", $data);
        }

        function ValidateProductData($data){

            $this->CheckAccess();

            // check thiếu data
            if($this->validateNull($data)){
                return "Vui lòng nhập đủ thông tin";
            }

            $arr_Str["product_name"] = $data['product_name'];
            $arr_Str["product_description"] = $data['product_description'];
            $arr_Str["product_code"] = $data['product_code'];
            $arr_Str["product_state"] = $data['product_state'];

            if($this->validateSpecialCharacter($arr_Str)){
                return "Dữ liệu không được chứa kí tự đặc biệt";
            }

            $whitelist = ['red', 'pink', 'yellow', 'green', 'blue', 'beige', 'white', 'black', 'brown', 'gray'];
            if(!in_array($data['product_color'], $whitelist, true)){
                return "Màu không hợp lệ";
            }

            $arr_Number['category_id'] = $data['category_id'];
            $arr_Number['product_price'] = $data['product_price'];

            if($this->validateNumber($arr_Number)){
                //var_dump($arr_Number);
                return "Giá trị số không hợp lệ";
            }
        
            foreach ($data['size_quantities'] as $size => $quantity) {
                if (!is_numeric($quantity) || $quantity < 0) {
                    return "Số lượng cho kích thước $size không hợp lệ.";
                }
            }
            
            return 'validated';
        }

        function IsValidFile($file){

            $this->CheckAccess();

            // get extension
            $imageFileType = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = false;
            
            
            if(isset($file["tmp_name"]) && $file["tmp_name"] != ''){
                $check = getimagesize($file["tmp_name"]);
            }
            if($check === false) {
                return "File không phải file ảnh";
            }

            
            // Kiểm tra định dạng hình ảnh
            $allowedMimeTypes = ['image/jpeg', 'image/png'];
            if (!in_array($file['type'], $allowedMimeTypes)) {
                return "File không đúng định dạng";
            }

            // Kiểm tra kích thước tệp tin (vd: tối đa 2MB)
            if ($file['size'] > 2097152) {
                return "File vượt quá kích thước";
            }

            // Kiểm tra lỗi khi upload
            if ($file['error'] > 0) {
                return "Có lỗi khi upload file";
            }

            return true;
        }

        function UpLoadFiles($uploadedFile){

            //check việc sử dụng hàm này
            $this->CheckAccess();

            $fileDirs = [];
            $files = [];
            
            $count = 0;

            if(!isset($uploadedFile)){
                return "Vui lòng chọn file";
            }

            foreach($uploadedFile as $key => $values){
                    //print_r($values);
                    //echo $key;
                $count += 1;
                if(!is_array($values)){
                    return "File không hợp lệ";
                }
                foreach($values as $index => $value){
                    $files[$index][$key] = $value;
                }
            }

            if($count < 5 || $count > 5){
                return "Vui lòng chọn 4 file";
            }

            // gộp các thuộc tính của file thành một cụm

            $uploadPath = './public/products/';
            $year = date('Y', time());
            $month = date('m', time());
            $day = date('d', time());
            $uploadPath = $uploadPath . $year . "/" . $month . "/" . "14";
            
            // nếu chưa có dir thì tạo
            if(!is_dir($uploadPath)){
                // set quyền và cho phép tạo luôn cả thư mục con và thư mục cha
                mkdir($uploadPath, 0764 , true);
            }

            // check valid file
            foreach($files as $file){
                $res = $this->IsValidFile($file);
                if($res !== true){
                    return $res;
                }
            }
            
            // di chuyển từng file vào dir vừa tạo
            foreach($files as $file){
                $extension = '';
                if($file['type'] === 'image/jpeg'){
                    $extension = '.jpeg';
                }
                else if($file['type'] === 'image/png'){
                    $extension = '.png';
                }

                $fileName = "img" . time() . $extension;

                // delay để tạo tên file
                sleep(1);

                // lưu lại dir
                $fileDirs[] = $uploadPath . "/" .  $fileName;
                move_uploaded_file($file['tmp_name'], $uploadPath . "/" .  $fileName);
            }
            return $fileDirs;
        }

        function AddProduct(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // sinh mã sp
                if($_POST == NULL){
                    echo "reload";
                }
                else {
                    $product_code = "SP" . time();
                    sleep(1);

                    $this->access = true;

                    $size_quantities = array(
                        "S" => $_POST['SoLuongSP_S'],
                        "M" => $_POST['SoLuongSP_M'],
                        "L" => $_POST['SoLuongSP_L'],
                        "XL" => $_POST['SoLuongSP_XL'],
                        "XXL" => $_POST['SoLuongSP_XXL']
                    );
        
                    $product_data = array(
                        "product_code" => $product_code,
                        "product_name" => $_POST['TenSanPham'],
                        "product_price" => $_POST['GiaSanPham'],
                        "category_id" => $_POST['DanhMucSanPham'],
                        "product_color" => $_POST['color'],
                        "product_description" => $_POST['MoTa'],
                        "product_state" => $_POST["ProductState"],
                        "size_quantities" => $size_quantities,
                    );
                        
                    $check = $this->ValidateProductData($product_data);
                    if($check === "validated"){
                        
                        $uploadedFile = $_FILES["fileToUpload"];
                        $fileNames = $this->UpLoadFiles($uploadedFile);
                        if(!is_array($fileNames)){
                            echo $fileNames;
                        }
                        else{
                            // thêm ảnh vào data
                            $product_data["product_images"] = $fileNames;

                            $model = $this->model("Product");
                            $model->InsertProduct($product_data);
                        }
                    }
                    else{
                        echo $check;
                    }
                }
            }
        }
        

        function EditProduct(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if($_POST == NULL){
                    echo "reload";
                }
                else {

                    $this->access = true;

                    $size_quantities = array(
                        "S" => $_POST['SoLuongSP_S'],
                        "M" => $_POST['SoLuongSP_M'],
                        "L" => $_POST['SoLuongSP_L'],
                        "XL" => $_POST['SoLuongSP_XL'],
                        "XXL" => $_POST['SoLuongSP_XXL']
                    );
        
                    $product_data = array(
                        "product_code" => $_POST['MaSanPham'],
                        "product_name" => $_POST['TenSanPham'],
                        "product_price" => $_POST['GiaSanPham'],
                        "category_id" => $_POST['DanhMucSanPham'],
                        "product_color" => $_POST['color'],
                        "product_description" => $_POST['MoTa'],
                        "product_state" => $_POST["ProductState"],
                        "size_quantities" => $size_quantities,
                    );

                    //var_dump($_POST['MaSanPham']);
                        
                    $check = $this->ValidateProductData($product_data);
                    if($check === "validated"){

                        $model = $this->model("Order");

                        $res = $model->CheckOrderDelivered($product_data);

                        if($res === "done"){
                            $model = $this->model("Product");
                            $old_images = $model->LoadProductImages($product_data['product_code']);
                            if(is_array($old_images)){
                                if($old_images != null){
            
                                    $uploadedFile = $_FILES["fileToUpload"];
                                    $fileNames = $this->UpLoadFiles($uploadedFile);
                                    if(!is_array($fileNames)){
                                        echo $fileNames;
                                    }
                                    else{
    
                                        // xóa hình cũ
                                        foreach($old_images as $each){
                                            unlink($each);
                                        }
    
                                        // thêm ảnh vào data
                                        $product_data["product_images"] = $fileNames;
    
                                        $model->EditProduct($product_data);
                                    }   
                                }
                                else {
                                    echo "Mã sản phẩm không tồn tại";
                                }
                            }
                            else {
                                echo $old_images;
                            }
                        }
                        else{
                            echo $res;
                        }
                        // lấy đường dẫn hình và xóa nó đi
                    }
                    else{
                        echo $check;
                    }
                }
            }
        }

        function DeleteProduct(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                $product_data = array(
                    "product_code" => $_POST['product_code'],
                );
                $check = $this->validateSpecialCharacter($product_data);
                if($check == false){
                        $model = $this->model("Order");

                        $res = $model->CheckOrderDelivered($product_data);

                        if($res === "done"){
                            $model = $this->model("Product");

                            // lấy đường dẫn hình và xóa nó đi
                            $images = $model->LoadProductImages($product_data['product_code']);
    
                            if(is_array($images)){
                                if($images != null){
                                    foreach($images as $each){
                                        unlink($each);
                                    }
            
                                    $model->DeleteProduct($product_data);
                                }
                                else {
                                    var_dump($images);
                                    echo "Mã sản phẩm " . $product_data["product_code"] . " không tồn tại";
                                }
                            }
                            else {
                                echo $images;
                            }
                        }
                        else{
                            echo $res;
                        }
                    }
                else{
                    echo $check;
                }
            }
        }
    }
?>