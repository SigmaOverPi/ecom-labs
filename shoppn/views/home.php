<?php
require_once '../core/core.php';

// The product grid now lives in index.php
// Login and require_admin() still redirect here, so send them on to the shop page.
redirect(BASE_URL . 'index.php');
