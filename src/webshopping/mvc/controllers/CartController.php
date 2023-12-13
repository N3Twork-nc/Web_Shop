<?php
    class CartController extends Controller{
        private $categories;
        private $products;
        private $count_item_in_cart;

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
            if(!isset($_SESSION['usr']) && !isset($_SESSION['usr']['cart_code'])){
                header("Location: /Auth");
            }else{
                $model = $this->model("Cart");
                $data_category = $model->CountItem($_SESSION['usr']['cart_code']);
            }
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
            if($data['quantity'] == 0){
                return "Số lượng phải lớn không";
            }

            $value = $data['size'];
            $array = array('S', 'M', 'L', 'XL','XXL'); // Mảng cần kiểm tra

            if (!in_array($value, $array)) {
                return "Size không tồn tại";
            }

            return "validated";
        }

        function Show(){
            $data = [];
            $tmp['cart_code'] = $_SESSION['usr']['cart_code'];
            $model = $this->model("CartItem");
            //var_dump($model);
            $data['cartItem'] = $model->LoadCartItem($tmp);
            //var_dump($data['cartItem']);

            
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            
            $page = $this->view("cart", $data);
        }

        function AddProduct(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $product_data = [
                    'cart_code' => $_SESSION['usr']['cart_code'],
                    'product_code' => $_POST['product_code'],
                    'size' => $_POST['size'],
                    'quantity' => $_POST['quantity']
                ];
                $err = $this->validateProduct($product_data);
                if($err == 'validated'){
                    $model = $this->model("CartItem");
                    $price = $model->FindPrice($product_data['product_code']);
                    if(empty($price)){
                        echo "Không tồn tại mã sản phẩm";
                    }
                    else{
                        $product_data['total_price'] = $price[0] * $product_data['quantity'];
                        $err = $model->AddProduct($product_data);
                        if($err != "done"){
                            echo $err;
                        }
                        else{
                            echo "done";
                        }
                    } 
                }
                else{
                    echo $err;
                }
            }
        }
    }
?>