<?php
require_once "../core/core.php";
require_once "../controllers/CartController.php";

// No require_login(): guests can add to the cart, identified by IP address

$pid = (int) ($_GET['pid'] ?? 0);

if($pid <= 0){
    set_flash("error", "Invalid product");
    redirect(BASE_URL . 'index.php');
}

$ip = get_ip();
$cid = $_SESSION['customer_id'] ?? null; // null for guests
$qty = 1;

// Errors and success both return the user to the product they clicked
$back = BASE_URL . 'views/single_product.php?id=' . $pid;

$controller = new CartController();
$result = $controller->addToCart($pid, $qty, $ip, $cid);

if($result['success'] !== true){
    set_flash("error", $result['error']);
    redirect($back);
}

set_flash("success", "Added to cart");
redirect($back);
