<?php
require_once __DIR__ . "../../db.php";

class ProductModel
{
    private $db;
    public function __construct()
    {
        $this->db = Database::get_instance();
    }
    public function get_categories()
    {
        $stmt = $this->db->prepare("SELECT * FROM categories");
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = $result->fetch_all(MYSQLI_ASSOC);
        return $categories;
    }
    public function get_most_popular($limit) {
        $sql = "SELECT * FROM products ORDER BY salesAmount DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function get_prices() {
        $stmt = $this->db->prepare("SELECT MIN(price) as min_price, MAX(price) as max_price FROM products;");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function get_categories_with_images() {
        $stmt = $this->db->prepare("CALL GetFirstImagePerCategory()");
        $stmt->execute();
        $result = $stmt->get_result();
        $categories = $result->fetch_all(MYSQLI_ASSOC);
        return $categories;
    }
    // public function get_products_by_name($title, $limit) {
    //     $sql = "SELECT p.*, c.catName 
    //         FROM products p
    //         JOIN categories c ON p.catID = c.catID
    //         WHERE p.title LIKE ?
    //         ORDER BY createdDate DESC
    //         LIMIT ? ";
    //     $stmt = $this->db->prepare($sql);
    //     $regex = "%$title%";
    //     $stmt->bind_param("s", $regex);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }
    // public function get_products_by_date($title, $limit)
    // {
    //     $sql = "SELECT p.*, c.catName 
    //         FROM products p
    //         JOIN categories c ON p.catID = c.catID WHERE 1=1";
    //     $params = [];
    //     $type = "";
    //     if (!empty($title)) {
    //         $sql .= " AND p.title LIKE ?";
    //         $params = [""]
    //     }
    //     $sql .= " ORDER BY createdDate DESC
    //             LIMIT ?";

    //     $regex = "%$title%";
    //     $stmt = $this->db->prepare($sql);
    //     $stmt->bind_param();
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }
    public function get_products($sort, $filter, $limit, $offset)
    {
        $sort_key = $sort['by'];
        $sort_order = $sort['order'];

        $categories = $filter['categories'];
        $price_range = $filter['price_range'];
        $title = trim($filter['title']);

        // Build base SQL
        $sql = "SELECT p.*, c.catName
            FROM products p
            JOIN categories c ON p.catID = c.catID
            WHERE 1=1";

        $params = [];
        $types = "";

        // Handle categories
        if (!empty($categories)) {
            $placeholders = implode(',', array_fill(0, count($categories), '?'));
            $sql .= " AND c.catID IN ($placeholders)";
            $params = array_merge($params, $categories);
            $types .= str_repeat("s", count($categories)); // "s" because catName is a string
        }
        else {
            return [];
        }
        
        // Handle price range
        if (!empty($price_range)) {
            $sql .= " AND p.price BETWEEN ? AND ?";
            $params[] = $price_range[0];
            $params[] = $price_range[1];
            $types .= "dd";
        }

        // Handle title search
        if (!empty($title)) {
            $sql .= " AND p.title LIKE ?";
            $params[] = "%$title%";
            $types .= "s";
        }

        // Add sorting, limit, offset
        $sql .= " ORDER BY p.$sort_key $sort_order LIMIT ? OFFSET ?";
        $params[] = $limit;
        $params[] = $offset;
        $types .= "ii";
        
        // Prepare and execute
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $this->db->error);
        }
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);
        return $products;
    }
    public function get_total_count($filter)
    {
        $sql = "SELECT COUNT(*) as total
            FROM products p
            JOIN categories c ON p.catID = c.catID
            WHERE 1=1";

        $params = [];
        $types = "";

        if (!empty($filter['categories'])) {
            $placeholders = implode(',', array_fill(0, count($filter['categories']), '?'));
            $sql .= " AND c.catID IN ($placeholders)";
            $params = array_merge($params, $filter['categories']);
            $types .= str_repeat("s", count($filter['categories']));
        }
        else {
            return 0;
        }

        if (!empty($filter['price_range'])) {
            $sql .= " AND p.price BETWEEN ? AND ?";
            $params[] = $filter['price_range'][0];
            $params[] = $filter['price_range'][1];
            $types .= "dd";
        }

        if (!empty($filter['title'])) {
            $sql .= " AND p.title LIKE ?";
            $params[] = "%" . trim($filter['title']) . "%";
            $types .= "s";
        }

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare count: " . $this->db->error);
        }

        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['total'];
    }

    public function get_total($title)
    {
        $sql = "SELECT COUNT(*) AS total FROM products WHERE 1=1";
        if (!empty($title)) {
            $sql .= " AND title LIKE ?";
        }
        $regex = "%$title%";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $regex);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['total'];
    }
    public function get_item($id)
    {
        $sql = "SELECT p.*, c.catName 
                FROM products p 
                JOIN categories c ON p.catID = c.catID
                WHERE p.id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function insert($data) {
        $sql = "INSERT INTO products(title, catID, productDesc, price, inStock, discount, imageLink) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->begin_transaction();
        try {
            // Prepare the statement
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("sisdids", 
                $data['title'], 
                $data['catID'], 
                $data['productDesc'],
                $data['price'], 
                $data['inStock'], 
                $data['discount'], 
                $data['imageLink']
            );
            $stmt->execute();
            $last_id = $this->db->insert_id;
            
            $this->db->commit();

            $stmt = $this->db->prepare(
                "SELECT *
                FROM products p
                JOIN categories c ON p.catID = c.catID
                WHERE p.id = ?"
            );
            $stmt->bind_param("i", $last_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return ["status" => "success", "data" => $result->fetch_assoc()];
        }
        catch (Exception $e) {
            $this->db->rollback();
            return ["status" => "fail", "msg" => $e->getMessage()];
        }
    }
    public function update($id, $data) {
        $sql = "UPDATE products 
                SET title = ?, catID = ?, productDesc = ?, price = ?, inStock = ?, discount = ?, imageLink = ?
                WHERE id = ?";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('sisdidsi', 
                $data['title'], 
                $data['catID'], 
                $data['productDesc'],
                $data['price'], 
                $data['inStock'], 
                $data['discount'], 
                $data['imageLink'],
                $id
            );
            
            $stmt->execute();
            $this->db->commit();

            if ($stmt->affected_rows > 0) {
                return ["status" => "success"];
            } else {
                return ["status" => "fail", "msg" => "No rows affected"];
            }
        } catch (Exception $e) {
            return ["status" => "fail", "msg" => $e->getMessage()];
        }
    }
    public function delete($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return ["status" => "success"];
        } catch (Exception $e) {
            return ["status" => "fail", "msg" => $e->getMessage()];
        }
    }
}
