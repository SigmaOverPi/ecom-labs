<?php
require_once "../core/core.php";

// Placeholder until the cart task: tell the user instead of showing a blank page
$id = (int) ($_GET['id'] ?? 0);

set_flash("error", "The cart is coming soon");

if($id <= 0){
    redirect(BASE_URL . 'index.php');
}

redirect(BASE_URL . 'views/single_product.php?id=' . $id);
