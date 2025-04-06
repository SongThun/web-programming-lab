<?php
require_once __DIR__ . "/../models/ProductModel.php";
class ProductController {
    private $model;
    private $limit;
    public function __construct() {
        $this->model = new ProductModel();
        $this->limit = 12;
    }
    public function index() {
        $products = $this->model->get_products_by_date($this->limit);
        $total = $this->model->get_total();
        $categories = $this->model->get_categories();
        $limit = $this->limit;
        require __DIR__ . "/../views/user/product/product.php";
    }
    public function load_products() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $sort = $data['sort'];
            $filter = $data['filter'];
            $page_num = $data['page_num'];
            $limit = $this->limit;
            $offset = ($page_num - 1) * $limit;
            $products = $this->model->get_products($sort, $filter, $limit, $offset);
            $total = $this->model->get_total_count($filter);
            header("Content-Type: application/json");
            echo json_encode([
                "status" => "success",
                "data" => $products,
                "total_pages" => ceil($total / $limit) 
            ]);
            exit();
        }
    }
    public function item() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $item_info = $_GET['item'];
            $item_split = explode("-",$item_info);
            $item_id = end($item_split);
            
            $item = $this->model->get_item($item_id);
            require __DIR__ . "/../views/user/product/item.php";
        }
    }
    public function display_add() {
        require __DIR__ . "/../views/admin/product/add.php";
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            
            $imageData = $data["imageLink"];
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
            $decodedData = base64_decode($imageData);
            $imageName = strtolower($data['title']);
            $imagePath = 'public/images/' . str_replace(' ', '-', $imageName);
            if (!file_exists($imagePath)) {
                file_put_contents($imagePath, $decodedData);
            }
            $data['imageLink'] = $imageName;
            $res = $this->model->insert($data);
            
            header("Content-Type: application/json");
            echo json_encode($res);
            exit();
        }
    }
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);

            $imageData = $data["imageLink"];
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $imageData);
            $decodedData = base64_decode($imageData);
            $imageName = strtolower($data['title']);
            $imagePath = 'public/images/' . str_replace(' ', '-', $imageName);
            if (!file_exists($imagePath)) {
                file_put_contents($imagePath, $decodedData);
            }
            $data['imageLink'] = $imageName;
            $res = $this->model->update($_GET['item'], $data);
            
            header("Content-Type: application/json");
            echo json_encode($res);
            exit();
        }
    }
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $res = $this->model->delete($_GET['item']);
            
            header("Content-Type: application/json");
            echo json_encode($res);
            exit();
        }
    }
}
?>