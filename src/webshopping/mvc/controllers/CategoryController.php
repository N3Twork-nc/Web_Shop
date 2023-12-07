<?php
    class CategoryController extends Controller{
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


        function Show($params){
            $data = [];

            if(!empty($params[0])){
                //var_dump($this->category);
                
                // Kiểm tra xem chuỗi có là key trong mảng không
                if (array_key_exists($params[0], $this->categories)) {

                    // Nếu có, lấy giá trị tương ứng
                    $value = $this->categories[$params[0]];
                    $model = $this->model("Product");

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

            //var_dump($data["products"]);
            $page = $this->view("category", $data);
        }
    }
?>