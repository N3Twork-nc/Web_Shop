<?php
include_once "./mvc/models/CustomerModel/CustomerObj.php";
    class OrderObj{
        private $order_code;
        private $order_date;
        private $state;
        private $total_price;
        private $customer;
        private $address;
        private $order_items;
        private $payment_code;
        private $payment_date;
        private $type;

        public function __construct($row)
        {
            $this->order_code = $row['order_code'];
            $this->order_date = $row['order_date'];
            $this->state = $row['state'];
            $this->total_price = $row['total_price'];

            $this->payment_code = $row['payment_code'];
            $this->payment_date = $row['payment_date'];
            $this->type = $row['type'];
            $this->address = $row['address'];
        }

        public function getOrder_code()
        {
                return $this->order_code;
        }

        public function setOrder_code($order_code)
        {
                $this->order_code = $order_code;

        }

        public function getOrder_date()
        {
                return $this->order_date;
        }

        public function setOrder_date($order_date)
        {
                $this->order_date = $order_date;
        }

        public function getState()
        {
                return $this->state;
        }

        public function setState($state)
        {
                $this->state = $state;
        }
        
        public function getTotal_price()
        {
                return $this->total_price;
        }

        public function setTotal_price($total_price)
        {
                $this->total_price = $total_price;
        }

        public function getCustomer()
        {
                return $this->customer;
        }

        public function setCustomer($customer)
        {
                $this->customer = $customer;
        }

        public function getOrder_items()
        {
                return $this->order_items;
        }

        public function setOrder_items($order_items)
        {
                $this->order_items = $order_items;
        }

        public function getPayment_code()
        {
                return $this->payment_code;
        }

        public function setPayment_code($payment_code)
        {
                $this->payment_code = $payment_code;

        }

        public function getPayment_date()
        {
                return $this->payment_date;
        }

        public function setPayment_date($payment_date)
        {
                $this->payment_date = $payment_date;
        }

        public function getType()
        {
                return $this->type;
        }

        public function setType($type)
        {
                $this->type = $type;
        }
        
        public function getAddress()
        {
                return $this->address;
        }

        public function setAddress($address)
        {
                $this->address = $address;
        }
    }

    class OrderItemObj{
        private $order_item_id;
        private $order_code;
        private $product_code;
        private $quantity;
        private $size;
        private $total_price;

        public function __construct($row)
        {
            $this->order_item_id = $row['order_item_id'];
            $this->order_code = $row['order_code'];
            $this->product_code = $row['product_code'];
            $this->quantity = $row['quantity'];

            $this->size = $row['size'];
            $this->total_price = $row['total_price'];
        }

        public function getOrder_item_id()
        {
                return $this->order_item_id;
        }

        public function setOrder_item_id($order_item_id)
        {
                $this->order_item_id = $order_item_id;
        }

        public function getOrder_code()
        {
                return $this->order_code;
        }

        public function setOrder_code($order_code)
        {
                $this->order_code = $order_code;
        }

        public function getProduct_code()
        {
                return $this->product_code;
        }

        public function setProduct_code($product_code)
        {
                $this->product_code = $product_code;
        }

        public function getQuantity()
        {
                return $this->quantity;
        }

        public function setQuantity($quantity)
        {
                $this->quantity = $quantity;
        }

        public function getSize()
        {
                return $this->size;
        }

        public function setSize($size)
        {
                $this->size = $size;
        }

        public function getTotal_price()
        {
                return $this->total_price;
        }
        public function setTotal_price($total_price)
        {
                $this->total_price = $total_price;
        }
    }
?>