<?php
require_once __DIR__ . '/core/core.php';

// Clear all session data, then end the session
session_unset();
session_destroy();

redirect(BASE_URL . 'index.php');
