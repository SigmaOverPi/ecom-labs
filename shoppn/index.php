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
    <main class="home-main">
        <h1>Welcome to shoppn</h1>
        <a href="<?= BASE_URL ?>views/login.php">Login</a>
        <a href="<?= BASE_URL ?>views/register.php">Register</a>
    </main>
</body>
</html>
