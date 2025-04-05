<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../models/AuthModel.php";
class AuthController
{
    private $model;
    public function __construct()
    {
        $this->model = new AuthModel();
    }
    public function index($type)
    {
        if ($type == 'login') {
            require __DIR__ . '/../views/user/login-form.php';
        } else if ($type == 'register') {
            require __DIR__ . '/../views/user/register-form.php';
        }
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            $username = trim($data["username"]);
            $password = password_hash(trim($data["password"]), PASSWORD_DEFAULT);
            $result = $this->model->add_user($username, $password);
            if ($result["status"] == "success") {
                $_SESSION['user_id'] = $result["data"]["userID"];
                $_SESSION['username'] = $result["data"]["username"];
                $_SESSION['role'] = $result["data"]["urole"];
                setcookie('remember_me', session_id(), time() + (24 * 60 * 60), '/');
            }

            header("Content-Type: application/json");
            echo json_encode(["status"=>$result["status"]]);
            exit();
        }
    }
    public function authorize()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            $username = trim($data["username"]);
            $password = trim($data["password"]);
            $user = $this->model->get_user($username);
            $res = [];
            if ($user != null && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user["userID"];
                $_SESSION['username'] = $user["username"];
                $_SESSION['role'] = $user["urole"];
                setcookie('remember_me', session_id(), time() + (24 * 60 * 60), '/');

                $res = [
                    "status" => "success"
                ];
            } else {
                $res = [
                    "status" => "fail",
                    "msg" => "Incorrect username or password."
                ];
            }
            header("Content-Type: application/json");
            echo json_encode($res);
            exit();
        }
    }
    public function logout()
    {
        session_start();
        setcookie('remember_me', session_id(), time() - 60 * 60, '/');
        session_reset();
        session_destroy();
        header("Location: index.php");  // Redirect to homepage
        exit();
    }
}
