<?php
    class CustomerController extends Controller{
        private $categories;
        private $countItemInCart;
        private $customer;
        private $order;
        private  $orderHistory;
        private $access = false;

        function CheckAccess(){
            if($this->access == false){
                header('Location: /Dashboard_category');
                exit;
            }
        }


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
            if(!isset($_SESSION['usr']) && !isset($_SESSION['usr']['cart_code'])){
                header("Location: /Auth");
            }
            if(isset($_SESSION['usr']['cart_code'])){
                $model = $this->model("CartItem");
                $data_category = $model->CountItem($_SESSION['usr']['cart_code']);
                if(!empty($data_category['numberOfItem']) && empty($data_category['err'])){
                    $this->countItemInCart = $data_category['numberOfItem'];
                }
            }

            // usr info
            $model = $this->model("Customer");
            $customer = $model->FindCustomerInfo($_SESSION['usr']['email']);
            $this->customer = $customer;

            //order
            $model = $this->model("Order");
            $this->order = $model->LoadOrder($_SESSION['usr']['email']);
            $this->orderHistory = $model->LoadOrderHistory($_SESSION['usr']['email']);
        }

        function Show($params){
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                    $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;

            //var_dump($this->customer);
            $data['info'] =$this->customer;

            $page = $this->view("informationUser", $data);
        }

        function Order($params){
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                    $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;

            $data['order'] = $this->order;
            $data['orderHistory'] = $this->orderHistory;
            //var_dump($data['order'][0]);
            //var_dump($data['orderHistory']);
            $page = $this->view("orderManagement", $data);
        }

        function OrderDetail($params){
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                    $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;

            if(empty($params[0])){
                $page = $this->view("404", $data);
            }
            else{
                $orderDetail = null;
                foreach($this->order as $each){
                    if($params[0] == $each->getOrder_code()){
                        $orderDetail = $each;
                    }
                }
                foreach($this->orderHistory as $each){
                    if($params[0] == $each->getOrder_code()){
                        $orderDetail = $each;
                    }
                }

                if($orderDetail == null){
                    $page = $this->view("404", $data);
                }
                else{
                    $data['order'] = $orderDetail;
                    //var_dump($data['order']);
                    //echo substr($data['order']->getOrder_items()[0]->getProduct()[0]->getImages()[0], 1); 
                    $page = $this->view("detailOrder", $data);
                }
            }
        }

        function ResetPassword($params){
            // chuyển data về dạng key value để dễ for
            $tmp = [];
            foreach($this->categories as $key => $value){
                    $tmp[$value->getParent_category_name()][$key] =  $value->getName();
            }

            $data["categories"] = $tmp;
            $page = $this->view("UserChangePassword", $data);
        }

        function validationCustomer($data){
            $this->CheckAccess();
            // check thiếu data

            if($this->validateNull($data)){
                return "Vui lòng nhập đủ thông tin";
            }
            $arr_Number['phone'] = $data['phone'];

            if($this->validateNumber($arr_Number)){
                //var_dump($arr_Number);
                return "Giá trị số không hợp lệ";
            }
            $err = $this->validFullName($data['full_name']);
            if($err != "validated"){
                return $err;
            }

            if($data['phone'][0] != '0' || strlen($data['phone']) < 10){
                return "Vui lòng nhập đúng số điện thoại";
            }

            return "validated";
        }

        function EditInfo(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    'full_name' => $_POST['fullName'],
                    'phone' => $_POST['phone']
                ];
                $this->access = true;
                $customer_data = array_map('trim', $data);

                $res = $this->validationCustomer($customer_data);

                if($res == "validated"){
                    $customer_data['email'] = $_SESSION['usr']['email'];
                    $model = $this->model("Customer");
                    $data = $model->EditCustomer($customer_data);
                }
                else{
                    echo $res;
                }
            }
        }

        function ChangePassword(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $data = [
                    'old_password' => $_POST['old_password'],
                    'new_password' => $_POST['new_password'],
                    'retype_new_password' => $_POST['retype_new_password']
                ];
                $customer_data = array_map('trim', $data);

                if($this->validateNull($data)){
                    echo "Vui lòng nhập đủ thông tin";
                }
                else{
                    $pass_hash = hash('sha256', $data['old_password']);
                    $dataAccount[] = $_SESSION['usr']['email'];
                    $dataAccount[] = $pass_hash;
                    $model = $this->model("Customer");
                    $result = $model->checkAccount($dataAccount);
                    if(!empty($result)){
                        $data_pass['password'] = $data['new_password'];
                        $data_pass['retype_password'] = $data['retype_new_password'];
                        $err = $this->checkStrongPassword($data_pass);
                        if($err != "validated"){
                            echo $err;
                        }
                        else{
                            $pass_new_hash = hash('sha256', $data['new_password']);
                            $data_new['email'] = $_SESSION['usr']['email'];
                            $data_new['password'] = $pass_new_hash;
    
                            $model = $this->model("Customer");
                            $err = $model->ResetPassword($data_new);
                            if($err != "done"){
                                echo $err;
                            }
                            else{
                                echo "done";
                            }
                        }   
                    }
                    else{
                        echo "Sai mật khẩu cũ";
                    }
                }

            }
        }
    }
?>