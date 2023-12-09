<?php
    class Dashboard_orderController extends Controller{
        function Show(){

            $model = $this->model("Order");
            $data = $model->LoadOrder();
            //var_dump($data[0]->getCustomer()->getUsername());
            $page = $this->view("dashboard_order", $data);
        }

        function Delivery(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $order_data = array(
                    "order_code" => $_POST['order_code']
                );
                $model = $this->model("Order");
                $order = $model->FindOrder($order_data['order_code']);

                if($order[0]->getState() == 'pending'){
                    $data = $model->UpdateDelivery($order_data);
                }
                else{
                    echo "Chỉ được vận chuyển đơn đang chờ xử lý";
                }
            }
        }

        function ConfirmDelivery(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $order_data = array(
                    "order_code" => $_POST['order_code']
                );

                $model = $this->model("Order");
                $order = $model->FindOrder($order_data['order_code']);

                if($order[0]->getState() == 'delivering'){
                   if(empty($order[0]->getPayment_code())){
                    echo "Đơn hàng chưa được thanh toán trước nên không thể xác nhận giao hàng!";
                   }
                   else{
                        $data = $model->ConfirmDelivery($order_data);
                   }
                }
                else{
                    echo "Chỉ được xác nhận đơn hàng đang giao";
                }
            }
        }

        function Pay(){
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $order_data = array(
                    "order_code" => $_POST['order_code']
                );

                $model = $this->model("Order");
                $order = $model->FindOrder($order_data['order_code']);

                if($order[0]->getState() == 'delivering'){
                   if(empty($order[0]->getPayment_code())){
                        $payment_code = $this->generatePaymentCode(5) . time();
                        sleep(1);

                        $order_data['payment_code'] = $payment_code;
                        $data = $model->PayOrder($order_data);
                   }
                   else{
                    echo "Chỉ được thành toán một lần!";
                   }
                }
                else{
                    echo "Chỉ được thanh toán đơn hàng đang giao";
                }
            }
        }

        function Cancel(){

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $order_data = array(
                    "order_code" => $_POST['order_code']
                );

                $model = $this->model("Order");
                $order = $model->FindOrder($order_data['order_code']);

                if($order[0]->getState() == 'pending'){
                    $data = $model->CancelOrder($order_data);
                    //echo "oke";
                }
                else{
                    echo "Chỉ được hủy đơn đang chờ xử lý";
                }
            }
        }

        function generatePaymentCode($length = 5) {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
        
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
        
            return $randomString;
        }
    }
?>