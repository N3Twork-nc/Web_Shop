<?php
    class PaymentController extends Controller{
        private $categories;
        private $products;
        private $countItemInCart;
        private $province;
        private $access = false;

        function CheckAccess(){
            if($this->access == false){
                header('Location: /Dashboard_category');
                exit;
            }
        }

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
            }
            if(isset($_SESSION['usr']['cart_code'])){
                $model = $this->model("CartItem");
                $data_category = $model->CountItem($_SESSION['usr']['cart_code']);
                if(!empty($data_category['numberOfItem']) && empty($data_category['err'])){
                    $this->countItemInCart = $data_category['numberOfItem'];
                }
                else{
                    $this->countItemInCart = 0;
                }
            }

            if($this->countItemInCart <= 0){
                header("Location: /Cart");
            }
        }

        function Show(){
            // echo $this->countItemInCart;
            // die();
            $data = [];
            if(isset($_SESSION['usr']) && isset($_SESSION['usr']['cart_code'])){
                $tmp['cart_code'] = $_SESSION['usr']['cart_code'];
                $model = $this->model("CartItem");
                //var_dump($model);
                $data['cartItem'] = $model->LoadCartItem($tmp);
                //var_dump($data['cartItem'][0]);
            }   
            else{
                header("Location: /Auth");
            }
            
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            $data['countItemInCart'] = $this->countItemInCart;

            $page = $this->view("delivery", $data);
        }

        function validatedStr($data){
            $this->CheckAccess();

            $pattern = '/^[\p{L}a-z A-Z0-9\/]+$/u';

            foreach($data as $key => $values){
                if (!preg_match($pattern, $values))
                    return true;
            }
            return false;
        }
        
        function MakeOrder(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    'provinceText' => $_POST['provinceText'],
                    'districtText' => $_POST['districtText'],
                    'wardText' => $_POST['wardText'],
                    'address' => $_POST['address']
                ];
                $data = array_map('trim', $data);
                $this->access = true;
                if($this->validateNull($data)){
                    echo "Vui lòng nhập đủ thông tin";
                }else{
                    if($this->validatedStr($data)){
                        echo "Dữ liệu không được chứa kí tự đặc biệt";
                    }
                    else{
                        $tmp['cart_code'] = $_SESSION['usr']['cart_code'];
                        $model = $this->model("CartItem");
                        $data_cart = $model->LoadCartItem($tmp);

                        if (is_array($data_cart)) {
                            $total_price = 0;

                            foreach($data_cart as $each){
                                $total_price += $each->getTotal_price();
                            }

                            $order_code = $this->generateOrderCode(8) . time();

                            $address = $data['address'] . ", " . $data['wardText'] . ", " . $data['districtText'] . ", " . $data['provinceText'];
                            $data_order['address'] = $address;
                            $data_order['email'] = $_SESSION['usr']['email'];
                            $data_order['cart_code'] = $_SESSION['usr']['cart_code'];
                            $data_order['order_code'] = $order_code;
                            $data_order['total_price'] = $total_price;
                            $data_order['orderItem'] = $data_cart;

                            $model = $this->model("Order");
                            $err = $model->MoveCartToOrder($data_order);
                            echo $err;
                        } else {
                            echo "Lỗi trong quá trình tạo đơn hàng";
                        }
                    }
                }
            }
        }

        function generateOrderCode($length = 8) {
            $this->CheckAccess();
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        
            return $randomString;
        }
    }
?>