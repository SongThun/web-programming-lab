<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/app/utils.php";
require_once __DIR__ . "/app/controllers/AdminController.php";
session_start();

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
if ($role === 'user') {
    // echo "Unauthorized access.";
    header("Location: " . BASE_URL . '404.php');
    exit();
} else if ($role === 'guest') {
    // echo "Unauthorized access. Please ";
    // echo '<a href="' . BASE_URL . '/login/">login.</a>';
    header("Location: " . BASE_URL . '404.php');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$valid_pages = ['home', 'product', 'login', 'register', 'logout'];

$controller = new AdminController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= STYLE_PATH ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const BASE_URL = "<?= rtrim($baseUrl, '/') ?>";
        window.BASE_URL = BASE_URL;
        window.API = "<?= API ?>";
    </script>
    <script type="module" src="<?= e(SCRIPT_PATH . "config.js") ?>"></script>
    <title>Lorem ipsum Admin</title>
</head>

<body>
    <div class="container admin-page">
        <?php require "app/views/include/admin-header.php" ?>
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
                            case 'view':
                                $controller->product_view();
                                break;
                            default:
                                $controller->product_index();
                                break;
                        }
                        break;
                    case 'login':
                        $auth_controller->authorize();
                        break;
                    case 'logout':
                        $auth_controller->logout();
                        break;
                    case 'register':
                        $auth_controller->register();
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