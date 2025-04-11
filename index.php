<?php
require_once __DIR__ . '/app/controllers/HomeController.php';
require_once __DIR__ . '/app/controllers/ProductController.php';
require_once __DIR__ . '/app/controllers/AuthController.php';
require_once __DIR__ . '/app/controllers/UserController.php';

session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';

if ($role === 'admin' && !in_array($page, ["", 'logout', 'login', 'register'])) {
    header("Location: admin.php");
    exit();
}

$valid_pages = ['home', 'product', 'about', 'login', 'register', 'logout', 'admin', 'cart'];

$home_controller = new HomeController();
$product_controller = new ProductController();
$auth_controller = new AuthController();
$user_controller = new UserController();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Lorem ipsum</title>
</head>

<body>
    <?php
    if (!in_array($page, ['login', 'register'])) {
        include "app/views/include/header.php";
    }
    ?>
    <?php
    if (in_array($page, $valid_pages)) {
        $method = $_SERVER['REQUEST_METHOD'];
        switch ($page) {
            case 'product':
                if (isset($_GET['item'])) {
                    $product_controller->item();
                } else {
                    $product_controller->index();
                }
                break;
            case 'cart':
                $user_controller->cart_index();
                break;
            case 'login':
                $auth_controller->index('login');
                break;
            case 'register':
                $auth_controller->index('register');
                break;
            case 'logout':
                $auth_controller->logout();
                break;
            case 'about':
                $home_controller->about();
                break;
            default:
                $home_controller->index();
        }
    } else {
        require '404.php';
    }
    ?>
    <?php
    include "app/views/include/footer.php";
    ?>
</body>

</html>