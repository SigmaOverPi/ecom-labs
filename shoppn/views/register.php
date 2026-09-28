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
            <form id="register-form" action="../actions/register.php" method="post">
                <div class="form-item">
                    <label for="name">Name</label>
                    <input type="text" name="name">
                </div>

                <div class="form-item">
                    <label for="email">Email</label>
                    <input type="text" name="email">
                </div>

                <div class="form-item">
                    <label for="pass">Password</label>
                    <input type="password" name="pass">
                </div>

                <div class="form-item">
                    <label for="country">Country</label>
                    <select name="country" id="country-select">
                        <option value="ghana">Ghana</option>
                    </select>
                </div>

                <div class="form-item">
                    <label for="city">City</label>
                    <input type="text" name="city">
                </div>

                <div class="form-item">
                    <label for="contact">Contact</label>
                    <input type="tel" name="contact">
                </div>

                <button type="submit">Submit Form</button>
            </form>
        </main>
        <script src="" async defer></script>
    </body>
</html>