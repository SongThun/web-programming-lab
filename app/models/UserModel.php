<?php
require_once __DIR__ . "../../db.php";

class UserModel {
    private $db;
    public function __construct() {
        $this->db = Database::get_instance();
    }
    public function update_cart($user_id, $item_id, $amount) {
        $this->db->begin_transaction();
        try {
            $stmt1 = $this->db->prepare("SELECT * FROM cart WHERE userID = ? AND productID = ?");
            $stmt1->bind_param("ii", $user_id, $item_id);
            $stmt1->execute();
            $result = $stmt1->get_result();
            $record = $result->fetch_assoc();
            if (empty($record)) {
                $stmt2 = $this->db->prepare("INSERT INTO cart(userID,productID,amount) VALUES (?,?,?)");
                $stmt2->bind_param("iii",$user_id, $item_id, $amount);
                $stmt2->execute();
            }
            else {
                $stmt2 = $this->db->prepare("UPDATE cart SET amount = amount + ? WHERE userID = ? AND productID = ? ");
                $stmt2->bind_param("iii",$amount, $user_id, $item_id);
                $stmt2->execute();
            }
        }
        catch (Exception $e) {
            $this->db->rollback();
        }
    }
}
?>