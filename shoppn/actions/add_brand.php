<?php
require_once "../core/core.php";
require_once '../controllers/ProductController.php';
require_admin();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $controller = new ProductController();
    $brand = $_POST["brand"];

    $result = $controller->addBrand($brand);

    if($result['success'] == true){
        set_flash("success", "Brand added successfully");
        redirect(BASE_URL . 'views/admin/brand.php');
    }else{
        set_flash("error", $result['error']);
        redirect(BASE_URL . 'views/admin/brand.php');
    }
}else{
    redirect(BASE_URL . 'views/admin/brand.php');
}