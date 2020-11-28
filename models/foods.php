<?php

require_once(INIT_PATH . DS . 'initialization.php');

class Foods
{

    private $conn;
    private $table_name = "foods";

    // table properties

    public $id;
    public $type_id;
    public $food_name;
    public $description;
    public $price;
    public $created_date;
    public $edited_date;

    // connect to db
    public function __construct()
    {
        global $database;
        $this->conn = $database->connect();
    }


    // create new tenant
    public function save()
    {
        $query = "";
        if (empty($this->id)) {
            $query .= "INSERT INTO " . $this->table_name . "(";
            $query .= "type_id, food_name, ";
            $query .= "description, price, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":type_id, :food_name, ";
            $query .= ":description, :price, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "type_id = :type_id, food_name = :food_name, ";
            $query .= "description = :description, price = :price, ";
            $query .= "created_date = :created_date, edited_date = :edited_date ";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

        // clean up data
        if (!empty($this->id)) {
            $this->id = htmlentities($this->id);
        }
        $this->type_id = htmlentities($this->type_id);
        $this->food_name = htmlentities($this->food_name);
        $this->description = htmlentities($this->description);
        $this->price = htmlentities($this->price);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // bind parameters
        if (!empty($this->id)) {
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':type_id', $this->type_id);
        $stmt->bindParam(':food_name', $this->food_name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':created_date', $this->created_date);
        $stmt->bindParam(':edited_date', $this->edited_date);

        // execute query 
        if ($stmt->execute()) {
            if (empty($this->id)) {
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        }
    }

    public function find_all()
    {
        $query = "SELECT * FROM " . $this->table_name . " ";
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute statemrent 
        if ($stmt->execute()) {
            // fetch data
            $food_object = array();
            $count = $stmt->rowCount();
            if ($count > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $food_object[] = $row;
                }
            }
            return $food_object;
        }
    }

    public function find_by_id($id = 0)
    {
        $query = "SELECT * FROM " . $this->table_name . " ";
        $query .= "WHERE id = :id LIMIT 1";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if ($stmt->execute(array('id' => $id))) {
            $type = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $type;
        } else {
            return false;
        }
    }

    public function find_by_type_id($type_id = 0)
    {
        $query = "SELECT * FROM " . $this->table_name . " ";
        $query .= "WHERE type_id = :type_id ";
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute statemrent 
        if ($stmt->execute(array('type_id'=>$type_id))) {
            // fetch data
            $food_object = array();
            $count = $stmt->rowCount();
            if ($count > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $food_object[] = $row;
                }
            }
            return $food_object;
        }
    }

}