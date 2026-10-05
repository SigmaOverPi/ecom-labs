<?php
require_once "../core/core.php";
require_once "../controllers/ProductController.php";
require_admin();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $cleanCatName = trim($_POST['category']);
    $catId = filter_var($_POST['cat_id'], FILTER_VALIDATE_INT);
    if(empty($cleanCatName)){
        set_flash("error", "Category name is empty");
        redirect(BASE_URL . "views/admin/category.php");
    }elseif($catId <= 0){
        set_flash("error", "Category ID is invalid");
        redirect(BASE_URL . "views/admin/category.php");
    }else{
        $controller = new ProductController();

        $result = $controller->updateCategory($catId, $cleanCatName);

        if($result['success'] == true){
            set_flash("success", "Category updated successfully");
            redirect(BASE_URL . "views/admin/category.php");
        }else{
            set_flash("error", $result['error']);
            redirect(BASE_URL . "views/admin/category.php");
        }
    }
}else{
    redirect(BASE_URL . "views/admin/category.php");
}