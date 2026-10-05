<?php
require_once "../../core/core.php";
require_once "../../controllers/ProductController.php";
require_admin();

$controller = new ProductController();

$brands = $controller->getAllBrands();

if(isset($_GET['edit'])){
    $brandToEdit = $controller->getBrandById($_GET['edit']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand - Shoppn</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
    <p style="display: flex; justify-content: center; align-items: center;"><?php echo get_flash('error') ?></p>
    <p style="display: flex; justify-content: center; align-items: center;"><?php echo get_flash('success') ?></p>
    <main class="home-main">
        <table>
            <tr>
                <th>Brand Name</th>
                <th>Action</th>
            </tr>
            <?php foreach($brands as $brand): ?>
                <tr class="brand">
                    <td><?= htmlspecialchars($brand['brand_name']) ?></td>
                    <td><a style="font-size: 16px;" href="brand.php?edit=<?= $brand['brand_id'] ?>">Edit</a></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <?php if(isset($brandToEdit)): ?>
            <form id="register-form" action="<?= BASE_URL ?>actions/update_brand.php" method="post">
                <div class="form-item">
                    <label for="brand">Brand</label>
                    <input class="brand-input" type="text" name="brand" value="<?= htmlspecialchars($brandToEdit['brand_name']) ?>">
                    <input type="hidden" name="brand_id" value="<?= $brandToEdit['brand_id'] ?>">
                </div>

                <button type="submit">Update Brand</button>
            </form>
            <?php else: ?>
                <form id="register-form" action="<?= BASE_URL ?>actions/add_brand.php" method="post">
                    <div class="form-item">
                        <label for="brand">Brand</label>
                        <input class="brand-input" type="text" name="brand">
                        <!-- <p style="display: none;" id="email-regex-error">Regex Error</p> -->
                    </div>

                    <button type="submit">Add Brand</button>
                </form>
        <?php endif ?>
    </main>
</body>
</html>