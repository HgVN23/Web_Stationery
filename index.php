<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();
// Kiểm tra xem URL hiện tại có phải là trang chính hay không
if ($_SERVER['REQUEST_URI'] == '/web_stationery/') {
    header('Location: /web_stationery/home'); // Chuyển hướng đến trang home
    exit; // Dừng thực hiện script để tránh xuất thêm nội dung
}

define('_DIR_ROOT', str_replace('\\', '/', __DIR__));

if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

$folder = str_replace(strtolower($_SERVER['DOCUMENT_ROOT']), '', strtolower(_DIR_ROOT));
$web_root = $web_root . $folder;
define('_WEB_ROOT', $web_root);

require_once 'config/filterchar.php';
require_once 'config/routes.php';
require_once 'core/Route.php';
require_once 'app/App.php';
$app = new App();
