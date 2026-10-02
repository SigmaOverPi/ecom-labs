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
                    <input class="email-input" type="text" name="email">
                    <p style="display: none;" id="email-regex-error">Regex Error</p>
                </div>

                <div class="form-item">
                    <label for="pass">Password</label>
                    <input class="pass-input" type="password" name="pass">
                    <p style="display: none; max-width: 300px;" id="pass-regex-error">Password Must Be At Least 8 Characters and Must Contain 1 of each(lowercase, uppercase, number, special)</p>
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
                    <input class="contact-input" type="tel" name="contact">
                    <p style="display: none;" id="contact-regex-error">Regex Error</p>
                </div>

                <button type="submit">Register</button>
            </form>
        </main>
        <script src="../js/validate.js"></script>
    </body>
</html>