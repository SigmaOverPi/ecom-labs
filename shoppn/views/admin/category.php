<?php
require_once "../../core/core.php";
require_once "../../controllers/ProductController.php";
require_admin();

$controller = new ProductController();

$categories = $controller->getAllCategories();

if(isset($_GET['edit'])){
    $catToEdit = $controller->getCategoryById($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category - Shoppn</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
    <?php require __DIR__ . '/../layout/header.php'; ?>

    <main class="form-main">
        <table>
            <tr>
                <th>Category Name</th>
                <th>Action</th>
            </tr>
            <?php foreach($categories as $category): ?>
                <tr class="category">
                    <td><?= htmlspecialchars($category['cat_name']) ?></td>
                    <td><a style="font-size: 16px;" href="category.php?edit=<?= $category['cat_id'] ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if(isset($catToEdit)): ?>
            <form id="register-form" action="<?= BASE_URL ?>actions/update_category.php" method="post">
                <div class="form-item">
                    <label for="category">Category</label>
                    <input class="category-input" type="text" name="category" value="<?= htmlspecialchars($catToEdit['cat_name']) ?>">
                    <input type="hidden" name="cat_id" value="<?= $catToEdit['cat_id'] ?>">
                </div>

                <button type="submit">Update Category</button>
                <a href="category.php">Cancel</a>
            </form>
            <?php else: ?>
                <form id="register-form" action="<?= BASE_URL ?>actions/add_category.php" method="post">
                    <div class="form-item">
                        <label for="category">Category</label>
                        <input class="category-input" type="text" name="category">
                        <!-- <p style="display: none;" id="email-regex-error">Regex Error</p> -->
                    </div>

                    <button type="submit">Add Category</button>
                </form>
        <?php endif ?>
    </main>
</body>
</html>