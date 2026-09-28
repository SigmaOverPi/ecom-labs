<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../core/core.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <p style="display: flex; justify-content: center; align-items: center;"><?php echo get_flash('error') ?></p>
        <main>
            <form id="login-form" action="../actions/login.php" method="post">
                <div class="form-item">
                    <label for="email">Email</label>
                    <input class="email-input" type="text" name="email">
                    <p style="display: none;" id="email-regex-error">Regex Error</p>
                </div>

                <div class="form-item">
                    <label for="pass">Password</label>
                    <input type="password" name="pass">
                </div>

                <button type="submit">Submit Form</button>
            </form>
        </main>
        <script src="../js/validate.js"></script>
    </body>
</html>