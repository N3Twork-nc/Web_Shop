<?php
    class Dashboard_productController extends Controller{
        private $checkAccess = false;

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

            // check thiếu data
            foreach($data as $key => $values){
                if($values == '')
                    return 'Vui lòng nhập đủ thông tin';
            }

            $pattern = '/^[\p{L}a-z A-Z0-9]+$/u';
            if (!preg_match($pattern, $data['product_name']) ||
                !preg_match($pattern, $data['product_description']) ||
                !preg_match($pattern, $data['product_color'])) {
                return "Dữ liệu không được chứa ký tự đặc biệt.";
            }
            
            if (!is_numeric($data['category_id']) || $data['category_id'] < 0) {
                return "Danh mục không hợp lệ.";
            }

            // Kiểm tra giá và số lượng có phải là số không
            if (!is_numeric($data['product_price']) || $data['product_price'] < 0) {
                return "Giá không hợp lệ.";
            }
        
            foreach ($data['size_quantities'] as $size => $quantity) {
                if (!is_numeric($quantity) || $quantity < 0) {
                    return "Số lượng cho kích thước $size không hợp lệ.";
                }
            }
            
            return 'validated';
        }

        function IsValidFile($file){
            // get extension
            $imageFileType = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = false;
            
            
            if(isset($file["tmp_name"]) && $file["tmp_name"] != ''){
                $check = getimagesize($file["tmp_name"]);
            }
            if($check === false) {
                return false;
            }
            
            // Kiểm tra định dạng hình ảnh
            $allowedMimeTypes = ['image/jpeg', 'image/png'];
            if (!in_array($file['type'], $allowedMimeTypes)) {
                return false;
            }

            // Kiểm tra kích thước tệp tin (vd: tối đa 2MB)
            if ($file['size'] > 2097152) {
                return false;
            }

            // Kiểm tra lỗi khi upload
            if ($file['error'] > 0) {
                return false;
            }

            return true;
        }

        function UpLoadFiles($uploadedFile){

            //check việc sử dụng hàm này
            if($this->checkAccess == false){
                header('Location: /Dashboard_product');
                exit;
            }

            $fileDirs = [];
            $files = [];
            
            $count = 0;
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
            $uploadPath = $uploadPath . $year . "/" . $month . "/" . $day;

            // nếu chưa có dir thì tạo
            if(!is_dir($uploadPath)){

                // set quyền và cho phép tạo luôn cả thư mục con và thư mục cha
                mkdir($uploadPath, 0744, TRUE);
            }

            // check valid file
            foreach($files as $file){
                if(!$this->IsValidFile($file)){
                    return "Lỗi khi upload file hoặc sai quy định upload file";
                }
            }
            
            // di chuyển từng file vào dir vừa tạo
            foreach($files as $file){
                $extension = '';
                if($file['type'] == 'image/jpeg'){
                    $extension = '.jpeg';
                }
                else if($file['type'] == 'image/png'){
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
                $product_code = "SP" . time();
                sleep(1);

                $this->checkAccess = true;

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
                    "size_quantities" => $size_quantities,
                );
                    
                $check = $this->ValidateProductData($product_data);
                if($check == "validated"){
                    
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
        

        function ModifyProduct(){
            $data['product_code']= 'P004';
            $data['name'] = 'Áo Sơ Mi Cổ Tròn';
            $data['description'] = 'như shit';
            $data['price'] = 3000;
            $data['discount_code'] = 'DCODE';
            $data['category_id'] = 13;
            $data['details_data'] = [
                "Xanh lá" => [
                    "sizes" => [
                        "S" => 5,
                        "M" => 6,
                        "L" => 7
                    ],
                    "images" => [
                        'img1', 'img2', 'img3'
                    ]
                ],
                "Xanh lam" => [
                    "sizes" => [
                        "S" => 5,
                        "M" => 6,
                        "L" => 7
                    ],
                    "images" => [
                        'img4', 'img5', 'img6'
                    ]
                ],
                "Be" => [
                    "sizes" => [
                        "S" => 5,
                        "M" => 6,
                        "L" => 7
                    ],
                    "images" => [
                        'img5', 'img6', 'img7'
                    ]
                ]
            ];
            $model = $this->model("Product");
            $model->InsertProduct($data);
        }
    }
?>