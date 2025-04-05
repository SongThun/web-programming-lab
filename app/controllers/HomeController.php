<?php
require_once __DIR__ . "/../models/ProductModel.php";
class HomeController {
    private $model;
    public function __construct() {
        $this->model = new ProductModel();
    }
    public function index() {
        if (isset($_SESSION['role']) and $_SESSION['role'] == 'admin') {
            require __DIR__ . "/../views/admin/home.php";
        }
        else {
            $categories = $this->model->get_categories();
            require __DIR__ . "/../views/user/home.php";
        }
    }
}
?>