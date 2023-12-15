<?php
    class PaymentController extends Controller{
        private $categories;
        private $products;
        private $countItemInCart;

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
            if(isset($_SESSION['usr']['cart_code'])){
                $model = $this->model("CartItem");
                $data_category = $model->CountItem($_SESSION['usr']['cart_code']);
                if(!empty($data_category['numberOfItem']) && empty($data_category['err'])){
                    $this->countItemInCart = $data_category['numberOfItem'];
                }
            }
        }

        function Show(){
            $data = [];
                        // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;

            $page = $this->view("payment", $data);
        }

        function Delivery(){
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
            
            $page = $this->view("delivery", $data);
        }
    }
?>