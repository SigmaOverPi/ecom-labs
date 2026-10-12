<?php
require_once __DIR__ . "/../classes/ProductClass.php";

class ProductController{
    private $model;

    public function __construct(){
        $this->model = new ProductClass();
    }

    public function addBrand($name){
        if(empty($name)){
            return ["success" => false, "error" => "Brand name cannot be empty"];
        }

        $result = $this->model->addBrand($name);

        if($result){
            return["success" => true];
        }else{
            return ["success" => false, "error" => "Failed to add brand"];
        }
    }

    public function getAllBrands(){
        return $this->model->getAllBrands();
    }

    public function getBrandById($id){
        return $this->model->getBrandById($id);
    }

    public function updateBrand($id, $name){
        if(empty($id) || empty($name)){
            return["success" => false, "error" => "All fields must be filled"];
        }

        $result = $this->model->updateBrand($id, $name);

        if($result){
            return ["success" => true];
        }else{
            return ["success" => false, "error" => "Failed to update brand"];
        }
    }

    public function addCategory($name){
        if(empty($name)){
            return ["success" => false, "error" => "Category name is empty"];
        }

        $result = $this->model->addCategory($name);

        if($result){
            return ["success" => true];
        }else{
            return ["success" => false, "error" => "Failed to add category"];
        }
    }

    public function getAllCategories(){
        return $this->model->getAllCategories();
    }

    public function getCategoryById($id){
        return $this->model->getCategoryById($id);
    }

    public function updateCategory($id, $name){
        if(empty($id) || empty($name)){
            return["success" => false, "error" => "All fields must be filled"];
        }

        $result = $this->model->updateCategory($id, $name);

        if($result){
            return ["success" => true];
        }else{
            return ["success" => false, "error" => "Failed to update category"];
        }
    }

    public function addProduct($cat, $brand, $title, $price, $desc, $image, $keywords){
        if(empty($cat) || empty($brand) || empty($title) || $price <= 0 || empty($desc) || empty($image) || empty($keywords)){
            return ["success" => false, "error" => "All fields must be filled"];
        }

        $result = $this->model->addProduct($cat, $brand, $title, $price, $desc, $image, $keywords);

        if($result){
            return ["success" => true];
        }else{
            return ["success" => false, "error" => "Failed to add product"];
        }
    }

    public function updateProduct($id, $cat, $brand, $title, $price, $desc, $image, $keywords){
        if(empty($id) || empty($cat) || empty($brand) || empty($title) || $price <= 0 || empty($desc) || empty($image) || empty($keywords)){
            return ["success" => false, "error" => "All fields must be filled"];
        }

        $result = $this->model->updateProduct($id, $cat, $brand, $title, $price, $desc, $image, $keywords);

        if($result){
            return ["success" => true];
        }else{
            return ["success" => false, "error" => "Failed to update product"];
        }
    }

    public function getProductById($id){
        return $this->model->getProductById($id);
    }

    public function getAllProducts(){
        return $this->model->getAllProducts();
    }

    public function getFeaturedProducts($n = 12){
        return $this->model->getFeaturedProducts((int) $n);
    }

    public function getProductsByCategory($cat){
        $cat = (int) $cat;

        if($cat <= 0){
            return [];
        }

        return $this->model->getProductsByCategory($cat);
    }

    public function getProductsByBrand($brand){
        $brand = (int) $brand;

        if($brand <= 0){
            return [];
        }

        return $this->model->getProductsByBrand($brand);
    }

    public function searchProducts($q){
        $q = trim($q);

        if($q === ''){
            return [];
        }

        return $this->model->searchProducts($q);
    }
}