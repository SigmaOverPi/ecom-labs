<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/CartController.php';

// No require_login(): guests can view their cart (it's tracked by IP)
$controller = new CartController();

$ip = get_ip();
$items = $controller->getCartItems($ip);
$total = $controller->getCartTotal($ip);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Shoppn</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
    <?php require __DIR__ . '/layout/header.php'; ?>

    <main class="home-main">
        <h2>Your Cart</h2>

        <?php if(empty($items)): ?>
            <p>Your cart is empty.</p>
            <a href="<?= BASE_URL ?>index.php">Continue shopping</a>
        <?php else: ?>
            <!-- One form, two submit buttons: the clicked button's value tells the action what to do -->
            <form class="cart-form" action="<?= BASE_URL ?>actions/update_cart.php" method="post">
                <table class="cart-table">
                    <tr>
                        <th>Remove</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php foreach($items as $item): ?>
                        <tr>
                            <td><input type="checkbox" name="remove[]" value="<?= $item['p_id'] ?>" aria-label="Remove <?= htmlspecialchars($item['product_title']) ?>"></td>
                            <td class="cart-product">
                                <img src="<?= BASE_URL . htmlspecialchars($item['product_image']) ?>" alt="">
                                <a href="<?= BASE_URL ?>views/single_product.php?id=<?= $item['p_id'] ?>"><?= htmlspecialchars($item['product_title']) ?></a>
                            </td>
                            <td>₵<?= number_format($item['product_price'], 2) ?></td>
                            <td><input type="number" name="qty[<?= $item['p_id'] ?>]" value="<?= $item['qty'] ?>" min="1" aria-label="Quantity"></td>
                            <td>₵<?= number_format($item['qty'] * $item['product_price'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="cart-total">
                        <td colspan="4">Total</td>
                        <td>₵<?= number_format($total, 2) ?></td>
                    </tr>
                </table>

                <div class="cart-actions">
                    <button type="submit" name="action" value="update">Update Quantities</button>
                    <button type="submit" name="action" value="remove">Remove Selected</button>
                </div>
            </form>

            <div class="cart-actions">
                <a href="<?= BASE_URL ?>index.php">Continue shopping</a>

                <?php if(is_logged_in()): ?>
                    <a href="<?= BASE_URL ?>views/payment.php">Proceed to Checkout</a>
                <?php else: ?>
                    <!-- Checkout needs an account, so guests are sent to log in first -->
                    <a href="<?= BASE_URL ?>views/login.php">Log in to checkout</a>
                <?php endif ?>
            </div>
        <?php endif ?>
    </main>
</body>
</html>
