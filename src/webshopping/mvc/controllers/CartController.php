<?php
    class CartController extends Controller{
        private $categories;
        private $products;

        public function __construct()
        {   

            // load product
            $model = $this->model("Product");
            $data_product = $model->LoadProducts();

            // load category
            $model = $this->model("Category");
            $data_category = $model->LoadCategories();

            foreach($data_category as $each){
                $key = $this->Str2Url($each->getName());
                $parent_name = $this->Str2Url($each->getParent_category_name());
                $each->setParent_category_name($parent_name);
                $data[$key] = $each;
            }

            $this->products = $data_product;
            $this->categories = $data;
        }

        function validateProduct($data){
            
            if($this->validateNull($data)){
                return "Vui lòng nhập đủ thông tin";
            }

            $arr_Number['quantity'] = $data['quantity'];

            if($this->validateNumber($arr_Number)){
                //var_dump($arr_Number);
                return "Số lượng không hợp lệ";
            }

            $value = $data['size'];
            $array = array('S', 'M', 'L', 'XL','XXL'); // Mảng cần kiểm tra

            if (!in_array($value, $array)) {
                return "Size không tồn tại";
            }

            return "validated";
        }

        // function Show(){
        //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //         if(isset($_SESSION['usr'])){
        //             $account_data = array(
        //                 "product_code" => $_POST['product_code'],
        //                 "size" => $_POST['size'],
        //                 "quantity" => $_POST['quantity']
        //             );
        //             $err = $this->validateProduct($account_data);
        //             if($err == "validated"){

        //             }else{
        //                 echo $err;
        //             }
        //         }
        //         else{
        //             header("Location: /Auth");
        //         }
        //     }
            
        //     // chuyển data về dạng key value để dễ for
        //     $tmp = [];
        //     foreach($this->categories as $key => $value){
        //         $tmp[$value->getParent_category_name()][$key] =  $value->getName();
        //     }

        //     $data["categories"] = $tmp;
            
        //     $page = $this->view("cart", $data);
        // }

        function Show(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_SESSION['usr'])){
                   
                }
                else{
                    header("Location: /Auth");
                }
            }
            
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            
            $page = $this->view("cart", $data);
        }
    }
?>