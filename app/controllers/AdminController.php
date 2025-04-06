<?php
require_once __DIR__ . "/../models/UserModel.php";
require_once __DIR__ . "/../models/ProductModel.php";

class AdminController {
    private $product;
    private $users;
    private $limit;
    public function __construct() {
        $this->product = new ProductModel();
        $this->users = new UserModel();
        $this->limit = 12;
    }
    public function index() {
        require __DIR__ . "/../views/admin/home.php";
    }
    public function product_index() {
        $products = $this->product->get_products_by_date($this->limit);
        $categories = $this->product->get_categories();
        $total = $this->product->get_total();
        $total_pages = ceil($total / $this->limit);
        require __DIR__ . "/../views/admin/product/product.php";
    }
    public function product_add() {
        $categories = $this->product->get_categories();
        require __DIR__ . "/../views/admin/product/add.php";
    }
    public function product_view() {
        $categories = $this->product->get_categories();
        $id = $_GET['item'];
        $prod = $this->product->get_item($id);
        require __DIR__ . "/../views/admin/product/edit.php";
    }
    public function customer_index() {
        require __DIR__ . "/../views/admin/user/customer.php";
    }
    public function admin_index() {
        require __DIR__ . "/../views/admin/user/admin.php";
    }
    public function sales_index() {
        $sales = $this->users->get_sales();
        require __DIR__ . "/../views/admin/sales.php";
    }
}
?>