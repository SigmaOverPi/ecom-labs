<?php
require_once "../core/core.php";
require_once "../controllers/CartController.php";

// No require_login(): guests manage their cart too, identified by IP address

$back = BASE_URL . 'views/cart.php';

if($_SERVER['REQUEST_METHOD'] !== "POST"){
    redirect($back);
}

// Both submit buttons are named "action"; only the clicked one is sent
$action = $_POST['action'] ?? '';
$ip = get_ip();
$controller = new CartController();

if($action === 'update'){
    // qty[pid] inputs arrive as an array: [product_id => quantity, ...]
    $quantities = $_POST['qty'] ?? [];

    foreach($quantities as $pid => $qty){
        $result = $controller->updateQty((int) $pid, (int) $qty, $ip);

        // Stop at the first bad value so the user sees which problem happened
        if($result['success'] !== true){
            set_flash("error", $result['error']);
            redirect($back);
        }
    }

    set_flash("success", "Cart updated");
    redirect($back);
}

if($action === 'remove'){
    // remove[] checkboxes: only the ticked ones are sent, as a list of product IDs
    $toRemove = $_POST['remove'] ?? [];

    if(empty($toRemove)){
        set_flash("error", "Tick the items you want to remove first");
        redirect($back);
    }

    foreach($toRemove as $pid){
        $result = $controller->removeFromCart((int) $pid, $ip);

        if($result['success'] !== true){
            set_flash("error", $result['error']);
            redirect($back);
        }
    }

    set_flash("success", "Item(s) removed");
    redirect($back);
}

set_flash("error", "Unknown cart action");
redirect($back);
