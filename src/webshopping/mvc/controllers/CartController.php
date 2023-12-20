<?php
    class CartController extends Controller{
        private $categories;
        private $products;
        private $countItemInCart;
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
            // parent::__construct();
        }

        function validateProduct($data){
            $this->CheckAccess();

            if($this->validateNull($data)){
                //var_dump($data);
                if(empty($data['csrf_token_product']))
                    return "Lỗi"; 
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

            $data['countItemInCart'] = $this->countItemInCart;
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            $data["csrf_token_cart"] =  bin2hex(random_bytes(50));
            $_SESSION["csrf_token_cart"] =  $data["csrf_token_cart"];
            $page = $this->view("cart", $data);
        }

        function AddProduct(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $product_data = [
                    'cart_code' => $_SESSION['usr']['cart_code'],
                    'product_code' => $_POST['product_code'],
                    'size' => $_POST['size'],
                    'quantity' => $_POST['quantity'],
                    'csrf_token_product' => $_POST['csrf_token_product']
                ];
                $this->access = true;
                $product_data = array_map('trim', $product_data);
                $err = $this->validateProduct($product_data);
                if($err == 'validated'){
                    if($product_data['csrf_token_product'] == $_SESSION['csrf_token_product'] && !empty($product_data['csrf_token_product'])){
                        // unset($_SESSION['csrf_token_product']);

                        $model = $this->model("CartItem");
                        $price = $model->FindPrice($product_data['product_code']);
                        if(empty($price)){
                            echo "Không tồn tại mã sản phẩm";
                        }
                        else{
                            $quantity = $model->FindQuantity($product_data);
                            if(empty($quantity)){
                                $product_data['total_price'] = $price[0] * $product_data['quantity'];
                                $err = $model->AddProduct($product_data);
                                if($err != "done"){
                                    echo $err;
                                }
                                else{
                                    echo "done";
                                }
                            }
                            else{
                                $quantity[0] += $product_data['quantity'];
                                $total_price = $quantity[0] * $price[0];
                                $product_data['quantity'] = $quantity[0];
                                $product_data['total_price'] = $total_price;
                                $err =  $model->ChangeQuantityAndPrice($product_data);
                                if($err != "done"){
                                    echo $err;
                                }
                                else{
                                    echo "done";
                                }
                            }
                        } 
                    }
                    else{
                        echo "Lỗi";
                    }
                }
                else{
                    echo $err;
                }
            }
        }

        function ProductInCart(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $product_data = [
                    'cart_code' => $_SESSION['usr']['cart_code'],
                    'product_code' => $_POST['product_code'],
                    'size' => $_POST['sizeOfProduct'],
                    'csrf_token_cart' => $_POST['csrf_token_cart']
                ];

                $this->access = true;
                $action = $_POST['actionWithProduct'];
                $product_data = array_map('trim', $product_data);

                // check size
                $array = array('S', 'M', 'L', 'XL','XXL'); // Mảng cần kiểm tra
                
                if (!in_array($product_data['size'], $array)) {
                    echo "Size không tồn tại";
                }
                else{
                    // lấy số lượng
                    $model = $this->model("CartItem");
                    $quantity = $model->FindQuantity($product_data);
                    $price = $model->FindPrice($product_data['product_code']);
                    $price[0] = floatval($price[0]);
                    if(empty($quantity) || empty($price)){
                        // không tìm thấy giỏ hàng muốn thêm
                        echo "Lỗi";
                    }
                    else{
                        if($product_data['csrf_token_cart'] == $_SESSION['csrf_token_cart'] && !empty($product_data['csrf_token_cart'])){
                            // unset($_SESSION['csrf_token_cart']);

                            if($action == 'increase'){
                                $quantity[0] += 1;
                                $total_price = $quantity[0] * $price[0];
                                $product_data['quantity'] = $quantity[0];
                                $product_data['total_price'] = $total_price;
    
                                $err =  $model->ChangeQuantityAndPrice($product_data);
                                if($err != "done"){
                                    echo $err;
                                }
                                else{
                                    echo "done";
                                }
                            }
                            else if($action == 'decrease'){
                                if($quantity[0] > 1){
                                    $quantity[0] -= 1;
                                    $total_price = $quantity[0] * $price[0];
                                    $product_data['quantity'] = $quantity[0];
                                    $product_data['total_price'] = $total_price;
    
                                    $err =  $model->ChangeQuantityAndPrice($product_data);
                                    if($err != "done"){
                                        echo $err;
                                    }
                                    else{
                                        echo "done";
                                    }
                                }
                                else{
                                    echo "Không thể giảm số lượng về 0";
                                }
                            }
                            else if($action == 'delete'){
                                $err =  $model->DeleteProductInCart($product_data);
                                if($err != "done"){
                                    echo $err;
                                }
                                else{
                                    echo "done";
                                }
                            }
                            else{
                                //Khi không thỏa trường hợp nào
                                echo "Lỗi";
                            }
                        }
                        else{
                            echo "Lỗi";
                        }
                    }
                }
            }
        }
    }
?>