<?php
    class HomeController extends Controller{
        private $categories;

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
        }
        function Show($params){
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                    $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            $page = $this->view("home", $data);

        }
        // function haha($params){
            
        //     // chuyển data về dạng key value để dễ for
        //     // $tmp = [];
        //     // foreach($this->categories as $key => $value){
        //     //         $tmp[$value->getParent_category_name()][$key] =  $value->getName();
        //     // }

        //     // $data["categories"] = $tmp;
        //     // $page = $this->view("home", $data);
        //     $data['email'] = "n20dcat011@student.ptithcm.edu.vn";
        //     $data['fullname'] = "Lê Văn Tèo";
        //     $data['subject'] = "Mã xác nhận";
        //     $data['body'] = "123456";
        //     $res = $this->SendMail($data);
        //     if($res == 'sent'){
        //         echo "oke";
        //     }
        //     else{
        //         echo $res;
        //     }
        // }
    }
?>