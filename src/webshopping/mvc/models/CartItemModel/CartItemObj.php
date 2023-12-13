<?php
include_once "./mvc/models/ProductModel/ProductObj.php";
    class CartItemObj{
        private $cart_item_id;
        private $product;
        private $quantity;
        private $size;
        private $total_price;
        private $price;

        public function __construct($row)
        {
            $this->cart_item_id = $row['cart_item_id'];
            $this->quantity = $row['quantity'];
            $this->size = $row['size'];
            $this->total_price = $row['total_price'];
            $this->price = $row['price'];
        }

        public function getCart_item_id()
        {
                return $this->cart_item_id;
        }

        public function setCart_item_id($cart_item_id)
        {
                $this->cart_item_id = $cart_item_id;
        }

        public function getProduct()
        {
                return $this->product;
        }

        public function setProduct($product)
        {
                $this->product = $product;
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

        public function getPrice()
        {
                return $this->price;
        }

        public function setPrice($price)
        {
                $this->price = $price;


        }
    }

?>