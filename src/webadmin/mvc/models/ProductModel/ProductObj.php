<?php
    class ProductObj{
        private $product_code;
        private $name;
        private $description;
        private $price;
        private $category_id;
        private $category_name;
        private $color;
        private $sizes;
        private $images;
        private $quantity;
        private $update_latest;

        public function __construct($row)
        {
            $this->product_code = $row['product_code'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
            $this->color = $row['color'];
            $this->update_latest = $row['update_latest'];
        }

        public function calculateQuantity(){
                $total = 0;
                foreach($this->sizes as $size => $quantity){
                        $total += $quantity;
                }
                return $total;
        }

        public function getProduct_code()
        {
                return $this->product_code;
        }

        public function setProduct_code($product_code)
        {
                $this->product_code = $product_code;
        }

        public function getName()
        {
                return $this->name;
        }

        public function setName($name)
        {
                $this->name = $name;

        }

        public function getDescription()
        {
                return $this->description;
        }

        public function setDescription($description)
        {
                $this->description = $description;
        }

        public function getPrice()
        {
                return $this->price;
        }

        public function setPrice($price)
        {
                $this->price = $price;

        }

        public function getColor()
        {
                return $this->color;
        }

        public function setColor($color)
        {
                $this->color = $color;
        }

        public function getSizes()
        {
                return $this->sizes;
        }

        public function setSizes($sizes)
        {
                $this->sizes = $sizes;

        }

        public function getImages()
        {
                return $this->images;
        }

        public function setImages($images)
        {
                $this->images = $images;

        }

        public function getQuantity()
        {
                return $this->quantity;
        }

        public function setQuantity($quantity)
        {
                $this->quantity = $quantity;
        }

        public function getUpdate_lastest()
        {
                return $this->update_latest;
        }

        public function setUpdate_latest($update_latest)
        {
                $this->update_latest = $update_latest;

        }

        public function getCategory_id()
        {
                return $this->category_id;
        }

        public function setCategory_id($category_id)
        {
                $this->category_id = $category_id;
        }

        public function getCategory_name()
        {
                return $this->category_name;
        }

        public function setCategory_name($category_name)
        {
                $this->category_name = $category_name;
        }
    }
?>