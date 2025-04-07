<?php
require_once __DIR__ . "../../db.php";

class AuthModel {
    private $db;
    public function __construct() {
        $this->db = Database::get_instance();
    }
    public function get_user($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user;
    }
    public function add_user($username, $password, $email) {
        try {
            $stmt = $this->db->prepare("INSERT INTO users(username,password,email) VALUES (?,?,?)");
            $stmt->bind_param("sss", $username, $password,$email);
            $stmt->execute();
        } catch (Exception $e){
            return ["status" => "fail", "msg" => $e->getMessage()];
        }
        $last_id = $this->db->insert_id;  // This gives the last inserted ID

        // Step 3: Retrieve the newly inserted record using the ID
        $query = "SELECT * FROM users WHERE userid = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $last_id);  // 'i' stands for integer
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the record as an associative array
        $new_user = $result->fetch_assoc();
        return ["status" => "success", "data" => $new_user];
    }
}
?>
