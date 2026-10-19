<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/core/core.php";

require_once __DIR__ . "/controllers/ProductController.php";

$controller = new ProductController();

$q = trim($_GET['q'] ?? '');
$cat = (int) ($_GET['cat'] ?? 0);
$brand = (int) ($_GET['brand'] ?? 0);

// Search first, then category, then brand, otherwise featured
if($q !== ''){
    $products = $controller->searchProducts($q);
    $heading = 'Results for "' . $q . '"';
}elseif($cat > 0){
    $products = $controller->getProductsByCategory($cat);
    $category = $controller->getCategoryById($cat);
    $heading = $category ? 'Category: ' . $category['cat_name'] : 'Category not found';
}elseif($brand > 0){
    $products = $controller->getProductsByBrand($brand);
    $brandRow = $controller->getBrandById($brand);
    $heading = $brandRow ? 'Brand: ' . $brandRow['brand_name'] : 'Brand not found';
}else{
    $products = $controller->getFeaturedProducts(12);
    $heading = 'Featured Products';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Shoppn</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>images/shoppn.png">
</head>
<body>
    <?php require __DIR__ . '/views/layout/header.php'; ?>

    <main class="home-main">

        <div class="shop-layout">
            <?php require __DIR__ . '/views/layout/sidebar.php'; ?>

            <section class="shop-content">
                <form class="search-form" action="<?= BASE_URL ?>index.php" method="get">
                    <input type="search" name="q" placeholder="Search products..." value="<?= htmlspecialchars($q) ?>">
                    <button type="submit">Search</button>
                </form>

                <h2><?= htmlspecialchars($heading) ?></h2>

                <?php if(empty($products)): ?>
                    <p>No products found.</p>
                <?php else: ?>
                    <div class="items-container">
                        <?php foreach($products as $product): ?>
                            <div class="item">
                                <div class="img-container">
                                    <img src="<?= BASE_URL . htmlspecialchars($product['product_image']) ?>" alt="<?= htmlspecialchars($product['product_title']) ?>">
                                </div>
                                <p><?= htmlspecialchars($product['product_title']) ?></p>
                                <p style="margin: 0 0 15px 0;">₵<?= number_format($product['product_price'], 2) ?></p>
                                <div class="item-links">
                                    <a href="<?= BASE_URL ?>views/single_product.php?id=<?= $product['product_id'] ?>">Details</a>
                                    <a href="<?= BASE_URL ?>actions/add_to_cart.php?pid=<?= $product['product_id'] ?>">Add to Cart</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif ?>
            </section>
        </div>
    </main>
</body>
</html>
