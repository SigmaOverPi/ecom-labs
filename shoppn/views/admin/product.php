<?php
require_once "../../core/core.php";
require_once "../../controllers/ProductController.php";
require_admin();

$controller = new ProductController();

$categories = $controller->getAllCategories();
$brands = $controller->getAllBrands();
$products = $controller->getAllProducts();

if(isset($_GET['edit'])){
    $productToEdit = $controller->getProductById((int) $_GET['edit']);

    if(!$productToEdit){
        set_flash("error", "Product not found");
        redirect(BASE_URL . 'views/admin/product.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - Shoppn</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
    <link rel="shortcut icon" href="<?= BASE_URL ?>images/shoppn.png">
</head>
<body>
    <?php require __DIR__ . '/../layout/header.php'; ?>

    <main class="form-main">
        <table>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php foreach($products as $product): ?>
                <tr class="product">
                    <td><img src="<?= BASE_URL . htmlspecialchars($product['product_image']) ?>" alt="" style="width: 60px;"></td>
                    <td><?= htmlspecialchars($product['product_title']) ?></td>
                    <td><?= htmlspecialchars($product['cat_name']) ?></td>
                    <td><?= htmlspecialchars($product['brand_name']) ?></td>
                    <td><?= number_format($product['product_price'], 2) ?></td>
                    <td><a style="font-size: 16px;" href="product.php?edit=<?= $product['product_id'] ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <!-- One form for both modes: $productToEdit decides the action, values and button -->
        <form id="register-form" action="<?= BASE_URL ?>actions/<?= isset($productToEdit) ? 'update_product.php' : 'add_product.php' ?>" method="post" enctype="multipart/form-data">
            <?php if(isset($productToEdit)): ?>
                <input type="hidden" name="product_id" value="<?= $productToEdit['product_id'] ?>">
                <input type="hidden" name="current_image" value="<?= htmlspecialchars($productToEdit['product_image']) ?>">
            <?php endif ?>

            <div class="form-item">
                <label for="product_cat">Category</label>
                <select name="product_cat" id="product_cat" required>
                    <option value="">-- Select category --</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?= $category['cat_id'] ?>" <?= (isset($productToEdit) && $category['cat_id'] == $productToEdit['product_cat']) ? 'selected' : '' ?>><?= htmlspecialchars($category['cat_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-item">
                <label for="product_brand">Brand</label>
                <select name="product_brand" id="product_brand" required>
                    <option value="">-- Select brand --</option>
                    <?php foreach($brands as $brand): ?>
                        <option value="<?= $brand['brand_id'] ?>" <?= (isset($productToEdit) && $brand['brand_id'] == $productToEdit['product_brand']) ? 'selected' : '' ?>><?= htmlspecialchars($brand['brand_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-item">
                <label for="product_title">Title</label>
                <input type="text" name="product_title" id="product_title" value="<?= htmlspecialchars($productToEdit['product_title'] ?? '') ?>" required>
            </div>

            <div class="form-item">
                <label for="product_price">Price</label>
                <input type="number" name="product_price" id="product_price" step="0.01" min="0.01" value="<?= htmlspecialchars($productToEdit['product_price'] ?? '') ?>" required>
            </div>

            <div class="form-item">
                <label for="product_desc">Description</label>
                <textarea name="product_desc" id="product_desc" rows="4" required><?= htmlspecialchars($productToEdit['product_desc'] ?? '') ?></textarea>
            </div>

            <div class="form-item">
                <label for="product_keywords">Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" value="<?= htmlspecialchars($productToEdit['product_keywords'] ?? '') ?>" required>
            </div>

            <?php if(isset($productToEdit)): ?>
                <div class="form-item">
                    <label>Current</label>
                    <img src="<?= BASE_URL . htmlspecialchars($productToEdit['product_image']) ?>" alt="Current product image" style="height: 100%;">
                </div>
            <?php endif ?>

            <div class="form-item">
                <label for="product_image"><?= isset($productToEdit) ? 'New Image' : 'Image' ?></label>
                <input type="file" name="product_image" id="product_image" accept="image/jpeg,image/png,image/gif,image/webp" <?= isset($productToEdit) ? '' : 'required' ?>>
            </div>

            <button type="submit"><?= isset($productToEdit) ? 'Update Product' : 'Add Product' ?></button>

            <?php if(isset($productToEdit)): ?>
                <!-- Leaves edit mode and goes back to the add form -->
                <a href="product.php">Cancel</a>
            <?php endif ?>
        </form>
    </main>
</body>
</html>
