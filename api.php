<?php
// Include necessary files (e.g., controllers, models)
require_once __DIR__ . "/app/controllers/HomeController.php";
require_once __DIR__ . "/app/controllers/ProductController.php";
require_once __DIR__ . "/app/controllers/AuthController.php";
require_once __DIR__ . "/app/controllers/UserController.php";


session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';

$method = $_SERVER['REQUEST_METHOD'];
// function sendResponse($status, $data = [], $message = '') {
//     header("Content-Type: application/json");
//     echo json_encode([
//         'status' => $status,
//         'data' => $data,
//         'message' => $message
//     ]);
//     exit();
// }

// Check if the page is a valid API endpoint
$valid_pages = ['home', 'product', 'about', 'login', 'register', 'cart']; // Add all API endpoints here

if (in_array($page, $valid_pages)) {
    switch ($page) {
        case 'home':
            // Handle home page logic (can be left for HTML rendering if needed)
            break;
        case 'login':
            $controller = new AuthController();
            if ($method === 'POST') {
                $controller->authorize();
            }
            break;
        case 'register':
            $controller = new AuthController();
            if ($method === 'POST') {
                $controller->register();
            }
            break;
        case 'product':
            $action = isset($_GET['action']) ? $_GET['action'] : 'none';
            $controller = new ProductController();
            if ($method === 'POST' && $action === 'none') {
                $controller->load_products();
            }
            else if ($method === 'POST' && $action === 'add') {
                $controller->add();
            }
            else if ($method === 'PUT' && $action == 'edit') {
                $controller->edit();
            }
            else if ($method == "DELETE" && $action == 'delete') {
                $controller->delete();
            }
            break;
        case 'cart': 
            $controller = new UserController();
            if (isset($_GET['action']) && $_GET['action'] == 'checkout') {
                $controller->checkout();
            } else if (isset($_GET['item'])) {
                if ($role === 'user') {
                    $controller = new UserController();
                    $controller->add_to_cart();
                }
                else {
                    echo json_encode(["status"=>"fail", "msg" => "Please login to add to cart."]);
                }
            }
            break;
        default:
            break;
    }
} 

