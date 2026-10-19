<?php
require_once __DIR__ . "/../classes/CartClass.php";
require_once __DIR__ . "/../classes/ProductClass.php";

class CartController{
    private $model;

    public function __construct(){
        $this->model = new CartClass();
    }
    public function addToCart($pid, $qty, $ip, $cid=null){
        if($pid <= 0 || $qty < 1){
            return ["success" => false, "error" => "Invalid Product"];
        }

        // The cart's foreign key rejects unknown products with an exception, so check first
        $productModel = new ProductClass();

        if(!$productModel->getProductById($pid)){
            return ["success" => false, "error" => "Product not found"];
        }

        if($this->model->isInCart($pid, $ip)){
            return ["success" => false, "error" => "Product already in your cart"];
        }

        $result = $this->model->addToCart($pid, $qty, $ip, $cid);

        if($result){
            return ["success" => true];
        }else{
            return ["success" => false, "error" => "Failed to add to cart"];
        }
    }

    public function getCartItems($ip){
        return $this->model->getCartItems($ip);
    }

    public function getCartCount($ip){
        return $this->model->getCartCount($ip);
    }

    public function getCartTotal($ip){
        return $this->model->getCartTotal($ip);
    }

    public function removeFromCart($pid, $ip){
        if($pid <= 0){
            return ["success" => false, "error" => "Invalid product"];
        }

        if(!$this->model->removeFromCart($pid, $ip)){
            return ["success" => false, "error" => "Failed to remove item"];
        }

        return ["success" => true];
    }

    public function updateQty($pid, $qty, $ip){
        if($pid <= 0){
            return ["success" => false, "error" => "Invalid product"];
        }

        // A quantity of 0 or less is not allowed; use Remove to take an item out
        if($qty < 1){
            return ["success" => false, "error" => "Quantity must be at least 1"];
        }

        if(!$this->model->updateQty($pid, $qty, $ip)){
            return ["success" => false, "error" => "Failed to update quantity"];
        }

        return ["success" => true];
    }
}
