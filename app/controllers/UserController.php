<?php
require_once __DIR__ . "/../models/UserModel.php";
class UserController
{   
    private $model;
    public function __construct()
    {
        $this->model = new UserModel();
    }
    public function add_to_cart()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'user' and isset($_SESSION['user_id'])) {
                $item_id = $_GET['item'];
                $amount = $_GET['amount'];
                $user_id = $_SESSION['user_id'];
                $this->model->update_cart($user_id, $item_id, $amount);
                header("Content-Type: application/json");
                echo json_encode(["status"=>"success", "data"=> "Add to cart success"]);
            }
            else {
                header("Content-Type: application/json");
                echo json_encode(["status"=>"fail", "msg"=>"Login required"]);
                exit();
            }
        }
    }
    public function cart_index() {
        $userid = $_SESSION['user_id'];
        $items = $this->model->get_cart($userid);
        require __DIR__ . "/../views/user/cart.php";
    }

    public function checkout() {
        $userid = $_SESSION['user_id'];
        $res = $this->model->delete_cart($userid);
        header("Content-Type: application/json");
        echo json_encode($res);
        exit();
    }
}
