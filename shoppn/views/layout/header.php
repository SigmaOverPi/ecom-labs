<header>
    <nav>
        <!-- If logged in -->
        <?php if(is_logged_in()): ?>
            <!-- Show when logged in -->
            <span>Welcome, <?= htmlspecialchars($_SESSION['name'] ?? 'user'); ?></span>
            <div class="side-nav">
                <a href="<?= BASE_URL; ?>index.php">Shop</a>
                <a href="<?= BASE_URL; ?>views/my_account.php">My Account</a>

                <!-- Admins only -->
                <?php if(is_admin()): ?>
                    <a href="<?= BASE_URL; ?>views/admin/product.php">Products</a>
                    <a href="<?= BASE_URL; ?>views/admin/category.php">Categories</a>
                    <a href="<?= BASE_URL; ?>views/admin/brand.php">Brands</a>
                <?php endif ?>

                <a href="<?= BASE_URL; ?>logout.php">Logout</a>
            </div>
        <?php else: ?>
            <!-- When logged out -->
            <span>Shoppn</span>
            <div class="side-nav">
                <a href="<?= BASE_URL; ?>index.php">Shop</a>
                <a href="<?= BASE_URL; ?>views/register.php">Register</a>
                <a href="<?= BASE_URL; ?>views/login.php">Login</a>
            </div>
        <?php endif; ?>
    </nav>
</header>
