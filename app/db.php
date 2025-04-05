<?php
class Database {
    public static $instance = null;
    private $connection;
    public function __construct() {
        $this->connection = new mysqli('localhost','root','','lorem_ipsum');
        
        if ($this->connection->connect_error) {
            die("Fail connection to database: " . $this->connection->connect_error);
        } 
    }
    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->connection;
    }
}
?>