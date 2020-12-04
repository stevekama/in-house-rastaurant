<?php 

require_once(INIT_PATH . DS . 'initialization.php');

class Order_Items_Migration
{

    private $conn;

    // table name and schema 
    private $table_name = "order_items";

    // connect to db
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }

    // create table
    public function create()
    {
        $query = "CREATE TABLE IF NOT EXISTS " . $this->table_name . "(";
        $query .= "id INT(11) UNSIGNED  NOT NULL PRIMARY KEY AUTO_INCREMENT, ";
        $query .= "user_id INT(11) NOT NULL, ";
        $query .= "order_id INT(11) NOT NULL, ";
        $query .= "food_id INT(11) NOT NULL, ";
        $query .= "food_name VARCHAR(200) NOT NULL, ";
        $query .= "price VARCHAR(200) NOT NULL, ";
        $query .= "created_date TIMESTAMP NULL DEFAULT NULL, ";
        $query .= "edited_date TIMESTAMP NULL DEFAULT NULL";
        $query .= ")";

        // execute query 
        $this->conn->exec($query);
        return true;
    }

    // read columns 
    public function find_columns()
    {
        $stmt = $this->conn->query("DESCRIBE ".$this->table_name);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    // drop table 
    public function drop()
    {
        $query = "DROP TABLE " . $this->table_name;

        $this->conn->exec($query);
        return true;
    }
}