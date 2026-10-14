<?php
// Read flash messages once (get_flash clears them), so they only show when set
$flashError = get_flash('error');
$flashSuccess = get_flash('success');
?>
<header class="site-header">
    <nav>
        <!-- Logo always takes you back to the shop -->
        <a class="logo" href="<?= BASE_URL; ?>index.php">Shoppn</a>


            <?php if(is_logged_in()): ?>
                    <!-- Admins only -->
                    <?php if(is_admin()): ?>
                        <div class="side-nav">
                            <div class="main-links">
                                <a href="<?= BASE_URL; ?>index.php">Shop</a>
                                <a href="<?= BASE_URL; ?>views/admin/product.php">Products</a>
                                <a href="<?= BASE_URL; ?>views/admin/category.php">Categories</a>
                                <a href="<?= BASE_URL; ?>views/admin/brand.php">Brands</a>
                            </div>

                            <div class="conditional-links">
                                <span class="welcome">Hi, <?= htmlspecialchars($_SESSION['name'] ?? 'user'); ?></span>
                                <a href="<?= BASE_URL; ?>logout.php">Logout</a>
                            </div>
                        </div>

                    <?php else: ?>
                        <div class="side-nav full">
                            <span class="welcome">Hi, <?= htmlspecialchars($_SESSION['name'] ?? 'user'); ?></span>
                            <a href="<?= BASE_URL; ?>logout.php">Logout</a>
                        </div>
                    <?php endif; ?>

                    <!--TODO: Add a My Account link here once views/my_account.php is built -->
                    
                    

                <?php else: ?>
                    <div class="side-nav full">
                        <a href="<?= BASE_URL; ?>index.php">Shop</a>
                        <a href="<?= BASE_URL; ?>views/register.php">Register</a>
                        <a href="<?= BASE_URL; ?>views/login.php">Login</a>
                    </div>
            <?php endif; ?>

    </nav>

    <?php if($flashError): ?>
        <p class="flash flash-error"><?= $flashError ?></p>
    <?php endif ?>
    <?php if($flashSuccess): ?>
        <p class="flash flash-success"><?= $flashSuccess ?></p>
    <?php endif ?>
</header>
