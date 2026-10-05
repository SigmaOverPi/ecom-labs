<?php
require_once "../core/core.php";
require_once "../controllers/ProductController.php";
require_admin();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $cleanBrandName = trim($_POST['brand']);
    $brandId = filter_var($_POST['brand_id'], FILTER_VALIDATE_INT);
    if(empty($cleanBrandName)){
        set_flash("error", "Brand name is empty");
        redirect(BASE_URL . "views/admin/brand.php");
    }elseif($brandId <= 0){
        set_flash("error", "Brand ID is invalid");
        redirect(BASE_URL . "views/admin/brand.php");
    }else{
        $controller = new ProductController();

        $result = $controller->updateBrand($brandId, $cleanBrandName);

        if($result['success'] == true){
            set_flash("success", "Brand updated successfully");
            redirect(BASE_URL . "views/admin/brand.php");
        }else{
            set_flash("error", $result['error']);
            redirect(BASE_URL . "views/admin/brand.php");
        }
    }
}else{
    redirect(BASE_URL . "views/admin/brand.php");
}