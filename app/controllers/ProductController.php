<?php
require_once __DIR__ . "/../models/ProductModel.php";
class ProductController
{
    private $model;
    private $limit;
    public function __construct()
    {
        $this->model = new ProductModel();
        $this->limit = 12;
    }

    public function index()
    {
        $categories = $this->model->get_categories();
        $prices = $this->model->get_prices();

        $get_cat = isset($_GET['category']) ? trim($_GET['category']) : "";
        if (!empty($get_cat)) {
            $cat = explode('-',$get_cat);
            $get_cat = end($cat);
        }
        $filter_cat = (!empty($get_cat)) ? [$get_cat] : array_column($categories, 'catID');
        $title = isset($_POST['title']) ? $_POST['title'] : "";
        $sort = ["by" => "createdDate", "order" => "DESC"];
        $filter = [
            "categories" => $filter_cat,
            "price_range" => [],
            "title" => $title
        ];
        $products = $this->model->get_products($sort, $filter, $this->limit, 0);
        $total = $this->model->get_total_count($filter);
        $limit = $this->limit;
        require __DIR__ . "/../views/user/product/product.php";
    }
    public function load_products()
    {
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
    public function item()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $item_info = $_GET['item'];
            $item_split = explode("-", $item_info);
            $item_id = end($item_split);
            // $item_id = $_POST['id'];
            
            $item = $this->model->get_item($item_id);
            $similar_items = $this->model->get_similar($item_id, 5);
            require __DIR__ . "/../views/user/product/item.php";
        }
    }
    public function display_add()
    {
        require __DIR__ . "/../views/admin/product/add.php";
    }
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents("php://input"), true);
            $data["discount"] = round($data["discount"] / 100, 2);
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
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $data = json_decode(file_get_contents("php://input"), true);
            $data["discount"] = round($data["discount"] / 100, 2);
            $imageData = $data["imageLink"] ?? null;

            // Default: don't update imageLink unless valid image data is found
            $shouldUpdateImage = false;
            $imageName = '';

            // Check for valid base64 image data
            if (
                $imageData &&
                preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)
            ) {
                $imageDataClean = substr($imageData, strpos($imageData, ',') + 1);
                $imageDataClean = trim($imageDataClean);

                if (!empty($imageDataClean)) {
                    $decodedData = base64_decode($imageDataClean);
                    if ($decodedData !== false) {
                        $imageExt = strtolower($type[1]);
                        $imageName = strtolower(str_replace(' ', '-', $data['title'])) . '.' . $imageExt;
                        $imagePath = 'public/images/' . $imageName;

                        if (!file_exists($imagePath)) {
                            file_put_contents($imagePath, $decodedData);
                        }

                        $shouldUpdateImage = true;
                    }
                }
            }

            // Update data only if image is valid
            if ($shouldUpdateImage) {
                $data['imageLink'] = $imageName;
            } else {
                $data['imageLink'] = ""; // Leave empty if no image uploaded
            }

            $res = $this->model->update($_GET['item'], $data);

            header("Content-Type: application/json");
            echo json_encode($res);
            exit();
        }
    }
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $res = $this->model->delete($_GET['item']);

            header("Content-Type: application/json");
            echo json_encode($res);
            exit();
        }
    }
    public function get_hint() {
        if (isset($_GET['title'])) {
            $title = $_GET['title'];
            $res = $this->model->match($title);
            header("Content-Type: application/json");
            echo json_encode($res);
            exit();
        } 
    }
}
