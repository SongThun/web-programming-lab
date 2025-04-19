<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'];
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

$baseUrl = $protocol . $host . $scriptDir . '/';
define('BASE_URL', $baseUrl);
define('ADMIN_URL', $baseUrl . 'admin/');
define('PRODUCT_URL', $baseUrl . 'product/');
define('IMAGE_PATH', $baseUrl . 'public/images/');
define('STYLE_PATH', $baseUrl . 'public/css/index.css');
define('SCRIPT_PATH', $baseUrl . 'public/js/');
define('API', $baseUrl . "api/");
?>