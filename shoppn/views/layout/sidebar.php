<?php
// Included by index.php and single_product.php
require_once __DIR__ . '/../../controllers/ProductController.php';

$sidebarController = new ProductController();

$sidebarCategories = $sidebarController->getAllCategories();
$sidebarBrands = $sidebarController->getAllBrands();
?>
<aside class="sidebar">
    <a href="<?= BASE_URL ?>index.php">All Products</a>

    <h3>Categories</h3>
    <?php foreach($sidebarCategories as $category): ?>
        <a href="<?= BASE_URL ?>index.php?cat=<?= $category['cat_id'] ?>"><?= htmlspecialchars($category['cat_name']) ?></a>
    <?php endforeach; ?>

    <h3>Brands</h3>
    <?php foreach($sidebarBrands as $brand): ?>
        <a href="<?= BASE_URL ?>index.php?brand=<?= $brand['brand_id'] ?>"><?= htmlspecialchars($brand['brand_name']) ?></a>
    <?php endforeach; ?>
</aside>
