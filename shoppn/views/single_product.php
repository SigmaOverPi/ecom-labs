<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$controller = new ProductController();

$id = (int) ($_GET['id'] ?? 0);

// getProductById returns null when no product has this ID
$product = ($id > 0) ? $controller->getProductById($id) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $product ? htmlspecialchars($product['product_title']) : 'Product' ?> - Shoppn</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
    <?php require __DIR__ . '/layout/header.php'; ?>

    <main class="home-main">
        <div class="shop-layout">
            <?php require __DIR__ . '/layout/sidebar.php'; ?>

            <section class="shop-content">
                <?php if(!$product): ?>
                    <h2>Product not found</h2>
                    <a href="<?= BASE_URL ?>index.php">Back to shop</a>
                <?php else: ?>
                    <div class="product-detail">
                        <img src="<?= BASE_URL . htmlspecialchars($product['product_image']) ?>" alt="<?= htmlspecialchars($product['product_title']) ?>">

                        <div class="product-info">
                            <h2><?= htmlspecialchars($product['product_title']) ?></h2>
                            <p>Category: <a href="<?= BASE_URL ?>index.php?cat=<?= $product['product_cat'] ?>"><?= htmlspecialchars($product['cat_name']) ?></a></p>
                            <p>Brand: <a href="<?= BASE_URL ?>index.php?brand=<?= $product['product_brand'] ?>"><?= htmlspecialchars($product['brand_name']) ?></a></p>
                            <p>Price: ₵<?= number_format($product['product_price'], 2) ?></p>
                            <p><?= nl2br(htmlspecialchars($product['product_desc'])) ?></p>

                            <a href="<?= BASE_URL ?>actions/add_to_cart.php?pid=<?= $product['product_id'] ?>">Add to Cart</a>
                            <a href="<?= BASE_URL ?>index.php">Back to shop</a>
                        </div>
                    </div>
                <?php endif ?>
            </section>
        </div>
    </main>
</body>
</html>
