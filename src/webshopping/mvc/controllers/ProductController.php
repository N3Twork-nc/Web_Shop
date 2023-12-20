<?php
    class ProductController extends Controller{
        private $categories;
        private $countItemInCart;

        public function __construct()
        {   
            // load category
            $model = $this->model("Category");
            $data_category = $model->LoadCategories();

            foreach($data_category as $each){
                $key = $this->Str2Url($each->getName());
                $parent_name = $this->Str2Url($each->getParent_category_name());
                $each->setParent_category_name($parent_name);
                $data[$key] = $each;
            }

            $this->categories = $data;
            if(isset($_SESSION['usr']['cart_code'])){
                $model = $this->model("CartItem");
                $data_category = $model->CountItem($_SESSION['usr']['cart_code']);
                if(!empty($data_category['numberOfItem']) && empty($data_category['err'])){
                    $this->countItemInCart = $data_category['numberOfItem'];
                }
            }
        }

        function Show($params){
            $data = [];
            $page = "product";

            if(!empty($params[0])){
                //var_dump($this->category);
                
                $model = $this->model("Product");
                
                $product['product_code'] = $params[0];

                $data["product"] = $model->LoadProducts($product);
                if(empty($data["product"])){
                    $page = "home";
                }
                else{
                    $category['child_category'] = $data["product"][0]->getCategoryObj()->getName();

                    $data["related_products"] = $model->LoadProducts($category);
                    $data["product"] = $data["product"][0];
                }
            }
            else{
                $page = "home";
            }

            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            $data["csrf_token_product"] =  bin2hex(random_bytes(50));
            $_SESSION["csrf_token_product"] =  $data["csrf_token_product"];
            //var_dump($data["product"]);
            $this->view($page, $data);
        }
    }
?>