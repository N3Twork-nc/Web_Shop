<?php
    class CategoryController extends Controller{
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


        function Show($params){
            $data = [];
            $data['name'] = "None";
            if(!empty($params[0])){
                //var_dump($this->category);
                
                // Kiểm tra xem chuỗi có là key trong mảng không
                if (array_key_exists($params[0], $this->categories)) {

                    // Nếu có, lấy giá trị tương ứng
                    $value = $this->categories[$params[0]];
                    $model = $this->model("Product");
                    $data['name'] = $this->categories[$params[0]]->getName();
                    // kiểm tra xem có phải danh mục cha không
                    if(empty($value->getParent_category_name())){
                        $category_data['parent_category'] = $value->getName();
                        $data["products"] = $model->LoadProducts($category_data);
                    }
                    else{
                        $category_data['child_category'] = $value->getName();
                        $data["products"] = $model->LoadProducts($category_data);
                    }
                    
                } else {
                    $data["products"] = $this->products;
                }
            }
            else{
                $data["products"] = $this->products;
            }

            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;

            $page = $this->view("category", $data);
        }

        function Find(){
            $data = [];
            if (isset($_POST['product_name'])) {
                $product_name = $_POST['product_name'];
                // Sử dụng $keywords để thực hiện công việc tìm kiếm trong cơ sở dữ liệu hoặc xử lý các tác vụ khác
                $model = $this->model("Product");
                $data["products"] = $model->FindProducts($product_name);
            }
            else{
                $data["products"] = [];
            }

            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            $data['name'] = htmlspecialchars($product_name);
            //var_dump($data["products"]);
            $page = $this->view("category", $data);
        }
    }
?>