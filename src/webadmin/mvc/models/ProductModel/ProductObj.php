<?php
    class ProductObj{
        private $product_code;
        private $name;
        private $description;
        private $price;
        private $discount_percent;
        private $type;
        private $categories;
        private $colors;
        private $sizes;
        private $images;
        private $quantity;
        private $detail_quantity;
        private $update_latest;

        public function __construct($row)
        {
            $this->product_code = $row['product_code'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->discount_percent = $row['discount_percent'];
            $this->type = $row['type'];
            $this->categories = $row['categories'];
            $this->update_latest = $row['update_latest'];
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

        public function getDiscount_percent()
        {
                return $this->discount_percent;
        }

        public function setDiscount_percent($discount_percent)
        {
                $this->discount_percent = $discount_percent;
        }


        public function getType()
        {
                return $this->type;
        }

        public function setType($type)
        {
                $this->type = $type;
        }

        public function getCategories()
        {
                return $this->categories;
        }

        public function setCategories($categories)
        {
                $this->categories = $categories;
        }

        public function getColors()
        {
                return $this->colors;
        }

        public function setColors($colors)
        {
                $this->colors = $colors;
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
        
        public function getDetail_quantity()
        {
                return $this->detail_quantity;
        }

        public function setDetail_quantity($detail_quantity)
        {
                $this->detail_quantity = $detail_quantity;

        }
    }
?>