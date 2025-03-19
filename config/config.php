<?php
define('BASE_PATH', __DIR__ . '/../');
define('BASE_URL', '/thedailygrind/');

include_once BASE_PATH . 'config/routes.php';
include_once BASE_PATH . 'config/conn.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
