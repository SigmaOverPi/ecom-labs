<?php
require_once "../core/core.php";
require_once '../controllers/ProductController.php';
require_admin();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if($_FILES['product_image']['error'] !== UPLOAD_ERR_OK){
        set_flash("error", "File not picked up or upload error");
        redirect(BASE_URL . 'views/admin/product.php');
    }

    $allowed_ext = ["jpg", "jpeg", "png", "gif", "webp"];

    $ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));

    if(!in_array($ext, $allowed_ext)){
        set_flash("error", "File extension not allowed");
        redirect(BASE_URL . 'views/admin/product.php');
    }

    if($_FILES['product_image']['size'] > (5 * 1024 * 1024)){
        set_flash("error", "File size too big");
        redirect(BASE_URL . 'views/admin/product.php');
    }

    $filename = uniqid('prod_') . '.' . $ext;

    if(!move_uploaded_file($_FILES['product_image']['tmp_name'], BASE_PATH . 'images/products/' . $filename)){
        set_flash("error", "Failed to save image");
        redirect(BASE_URL . 'views/admin/product.php');
    }

    $cat = (int) ($_POST['product_cat'] ?? 0);
    $brand = (int) ($_POST['product_brand'] ?? 0);
    $title = clean($_POST['product_title'] ?? '');
    $price = (float) ($_POST['product_price'] ?? 0);
    $desc = clean($_POST['product_desc'] ?? '');
    $keywords = clean($_POST['product_keywords'] ?? '');

    $image = 'images/products/' . $filename;

    $controller = new ProductController();
    $result = $controller->addProduct($cat, $brand, $title, $price, $desc, $image, $keywords);

    if($result['success'] == true){
        set_flash("success", "Product added successfully");
    }else{
        // Don't leave an unused file behind if the database insert failed
        unlink(BASE_PATH . $image);
        set_flash("error", $result['error']);
    }
    
    redirect(BASE_URL . 'views/admin/product.php');
}else{
    redirect(BASE_URL . 'views/admin/product.php');
}