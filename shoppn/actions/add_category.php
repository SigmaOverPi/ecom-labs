<?php
require_once "../core/core.php";
require_once "../controllers/ProductController.php";
require_admin();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $controller = new ProductController();
    $category = $_POST['category'];

    $result = $controller->addCategory($category);

    if($result['success'] == true){
        set_flash("success", "Category added successfully");
        redirect(BASE_URL . "views/admin/category.php");
    }else{
        set_flash("error", $result['error']);
        redirect(BASE_URL . "views/admin/category.php");
    }
}else{
    redirect(BASE_URL . "views/admin/category.php");
}