<header>
    <nav>
        <!-- If logged in -->
        <?php if(isset($_SESSION['customer_id'])): ?>
            <!-- Show when logged in -->
            <span>Welcome <?= htmlspecialchars($_SESSION['customer_name'] ?? ''); ?></span>
            <a href="<?= BASE_URL; ?>/views/my_account.php">My Account</a>

            <!-- Admins only -->
            <?php if(is_admin()): ?>
                <a href="<?php echo BASE_URL; ?>/views/admin_dashboard.php">Admin</a>
            <?php endif ?>

            <a href="<?php echo BASE_URL; ?>/views/register.php">Logout</a>

            <?php else: ?>
                <!-- When logged out -->
                <a href="<?php echo BASE_URL; ?>/views/register.php">Register</a>
                <a href="<?php echo BASE_URL; ?>/views/login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>