<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
    if ($role === 'user') {
        echo "Unauthorized access.";
        exit();
    }
    if ($role === 'guest') {
        echo "Unauthroized access. Please ";
        echo '<a href="?page=login">login.</a>';
        exit();
    }

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    $valid_pages = ['home', 'product', 'customer', 'admin-info', 'sales'];
    
    require_once "app/controllers/AdminController.php";
    $controller = new AdminController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/index.css">
    <title>Lorem ipsum Admin</title>
</head>
<body>
    <div class="container">
        <?php require "app/views/include/sidebar.php" ?>
        <div class="main">
            <?php 
                if (in_array($page, $valid_pages)) {
                    switch ($page) {
                        case 'product':
                            $action = isset($_GET['action']) ? $_GET['action'] : 'none';
                            switch ($action) {
                                case 'add':
                                    $controller->product_add();
                                    break;
                                case 'edit':
                                    $controller->product_edit();
                                default: 
                                    $controller->product_index();
                                    break;
                            }
                            break;
                        case 'customer':
                            $controller->customer_index();
                            break;
                        case 'admin-info':
                            $controller->admin_index();
                            break;
                        case 'sales':
                            $controller->sales_index();
                            break;
                        default:
                            $controller->index();
                            break;
                    }
                }
            ?>
            <?php require "app/views/include/footer.php" ?>
        </div>  
    </div> 
</body>
</html>
