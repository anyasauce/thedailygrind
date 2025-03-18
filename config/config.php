<?php
define('BASE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/thedailygrind/');

include_once BASE_PATH . 'config/routes.php';

include_once BASE_PATH . 'config/conn.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>