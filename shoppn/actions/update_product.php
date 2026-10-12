<?php
require_once "../core/core.php";
require_once '../controllers/ProductController.php';
require_admin();

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    redirect(BASE_URL . 'views/admin/product.php');
}

$id = (int) ($_POST['product_id'] ?? 0);

if($id <= 0){
    set_flash("error", "Product ID is invalid");
    redirect(BASE_URL . 'views/admin/product.php');
}

// Errors send the admin back to the same product's edit form
$back = BASE_URL . 'views/admin/product.php?edit=' . $id;

// Tracks whether a new file was saved, so it can be deleted if the update fails
$newUpload = false;

if($_FILES['product_image']['error'] === UPLOAD_ERR_NO_FILE){
    // No new image picked: keep the one already saved
    $image = clean($_POST['current_image'] ?? '');
}else{
    if($_FILES['product_image']['error'] !== UPLOAD_ERR_OK){
        set_flash("error", "Upload error");
        redirect($back);
    }

    $allowed_ext = ["jpg", "jpeg", "png", "gif", "webp"];

    $ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));

    if(!in_array($ext, $allowed_ext)){
        set_flash("error", "File extension not allowed");
        redirect($back);
    }

    if($_FILES['product_image']['size'] > (5 * 1024 * 1024)){
        set_flash("error", "File size too big");
        redirect($back);
    }

    $filename = uniqid('prod_') . '.' . $ext;

    if(!move_uploaded_file($_FILES['product_image']['tmp_name'], BASE_PATH . 'images/products/' . $filename)){
        set_flash("error", "Failed to save image");
        redirect($back);
    }

    $image = 'images/products/' . $filename;
    $newUpload = true;
}

$cat = (int) ($_POST['product_cat'] ?? 0);
$brand = (int) ($_POST['product_brand'] ?? 0);
$title = clean($_POST['product_title'] ?? '');
$price = (float) ($_POST['product_price'] ?? 0);
$desc = clean($_POST['product_desc'] ?? '');
$keywords = clean($_POST['product_keywords'] ?? '');

$controller = new ProductController();
$result = $controller->updateProduct($id, $cat, $brand, $title, $price, $desc, $image, $keywords);

if($result['success'] !== true){
    // Don't leave an unused file behind if the database update failed
    if($newUpload){
        unlink(BASE_PATH . $image);
    }
    set_flash("error", $result['error']);
    redirect($back);
}

set_flash("success", "Product updated successfully");
redirect(BASE_URL . 'views/admin/product.php');
