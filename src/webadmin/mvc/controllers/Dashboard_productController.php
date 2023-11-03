<?php
    class Dashboard_productController extends Controller{
        private $checkAccess = false;

        function Show(){
            $model = $this->model("Product");
            $data = $model->LoadProducts();
            var_dump($data);
            //$page = $this->view("dashboard_product", $data);
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

            // check việc sử dụng hàm này
            // if($this->checkAccess == false){
            //     header('Location: /Dashboard_product');
            //     exit;
            // }
            // else{
            //     echo 'oke';
            // }
            $files = [];

            // gộp các thuộc tính của file thành một cụm
            foreach($uploadedFile as $key => $values){
                foreach($values as $index => $value){
                    $files[$index][$key] = $value;
                }
            }

            $uploadPath = './public/products/';
            $year = date('Y', time());
            $month = date('m', time());
            $day = date('d', time());
            $uploadPath = $uploadPath . $year . "/" . $month . "/" . $day . "/";
            if(!is_dir($uploadPath)){

                // set quyền và cho phép tạo luôn cả thư mục con và thư mục cha
                mkdir($uploadPath, 0744, TRUE);
            }
            
            foreach($files as $file){
                if($this->IsValidFile($file)){
                    
                    move_uploaded_file($file['tmp_name'], $uploadPath . "/" . $file['name']);
                }
                else{
                    return "Lỗi khi upload file hoặc sai quy định upload file";
                }
            }
        }

        function AddProduct(){
            // sinh mã sp
            //"SP" . time();

            $this->checkAccess = true;
            $uploadedFile = $_FILES["fileToUpload"];
            $this->UpLoadFiles($uploadedFile);
            // echo $target_file;
            // $uploadOk = 1;
            // $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // // Check if image file is a actual image or fake image
            // if(isset($_POST["submit"])) {
            // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            // if($check !== false) {
            //     echo "File is an image - " . $check["mime"] . ".";
            //     $uploadOk = 1;
            // } else {
            //     echo "File is not an image.";
            //     $uploadOk = 0;
            // }
            // }

            // $data['product_code']= 'P004';
            // $data['name'] = 'Áo Sơ Mi Cổ Tròn';
            // $data['description'] = 'như shit';
            // $data['price'] = 3000;
            // $data['discount_code'] = 'DCODE';
            // $data['category_id'] = 13;
            // $data['details_data'] = [
            //     "Xanh lá" => [
            //         "sizes" => [
            //             "S" => 5,
            //             "M" => 6,
            //             "L" => 7
            //         ],
            //         "images" => [
            //             'img1', 'img2', 'img3'
            //         ]
            //     ],
            //     "Xanh lam" => [
            //         "sizes" => [
            //             "S" => 5,
            //             "M" => 6,
            //             "L" => 7
            //         ],
            //         "images" => [
            //             'img4', 'img5', 'img6'
            //         ]
            //     ],
            //     "Be" => [
            //         "sizes" => [
            //             "S" => 5,
            //             "M" => 6,
            //             "L" => 7
            //         ],
            //         "images" => [
            //             'img5', 'img6', 'img7'
            //         ]
            //     ]
            // ];
            // $model = $this->model("Product");
            // $model->InsertProduct($data);
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