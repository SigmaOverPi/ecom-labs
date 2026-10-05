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
}