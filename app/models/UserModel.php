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
            $this->db->commit();
            return ["status" => "success"];
        }
        catch (Exception $e) {
            $this->db->rollback();
            return ["status" => "fail", "msg" => $e->getMessage()];
        }
    }
    public function delete_cart_item($userid, $itemid) {
        $this->db->begin_transaction();
        try {
            $sql = "DELETE FROM cart WHERE userID = ? AND productID = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("ii", $userid, $itemid);
            $stmt->execute();
            $this->db->commit();
            return ["status"=>"success", "data"=>$this->get_cart($userid)];
        } catch (Exception $e) {
            $this->db->rollback();
            return ["status"=>"fail", "msg"=> $e->getMessage()];
        }
    }
    public function get_cart($userid) {
        $sql = "SELECT c.amount, p.id, p.title, p.price, p.discount, ROUND(p.price * (1 - p.discount) * c.amount, 2) AS total, p.imageLink
                FROM cart c 
                JOIN products p ON c.productID = p.id 
                WHERE c.userID = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userid);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function delete_cart($userid) {
        try {
            // Step 1: Fetch cart items for this user
            $stmt = $this->db->prepare("SELECT productID, amount FROM cart WHERE userID = ?");
            $stmt->bind_param("i", $userid);
            $stmt->execute();
            $result = $stmt->get_result();
            $cartItems = $result->fetch_all(MYSQLI_ASSOC);
    
            // Step 2: Update each product's salesAmount and inStock
            foreach ($cartItems as $item) {
                $updateStmt = $this->db->prepare("
                    UPDATE products 
                    SET salesAmount = salesAmount + ?, 
                        inStock = inStock - ? 
                    WHERE id = ?
                ");
                $updateStmt->bind_param("ddi", $item['amount'], $item['amount'], $item['productID']);
                $updateStmt->execute();
            }
    
            // Step 3: Delete all cart entries for the user
            $deleteStmt = $this->db->prepare("DELETE FROM cart WHERE userID = ?");
            $deleteStmt->bind_param("i", $userid);
            $deleteStmt->execute();
    
            return ["status" => "success"];
        } catch (Exception $e) {
            return ["status" => "fail", "msg" => $e->getMessage()];
        }
    }
    
    public function get_sales() {
        $stmt = $this->db->prepare("SELECT * FROM sales;");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}
?>