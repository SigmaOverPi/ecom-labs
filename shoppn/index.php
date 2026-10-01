<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/core/core.php";

require __DIR__ . "/controllers/CartController.php";

require __DIR__ . "/controllers/CustomerController.php";

require __DIR__ . "/controllers/ProductController.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Shoppn</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>css/style.css">
</head>
<body>
    <?php require 'views/layout/header.php'; ?>

    <main>
        <h1>Welcome to the Home Page</h1>
    </main>
</body>
</html>
