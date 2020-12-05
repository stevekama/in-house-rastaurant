<?php

require_once(INIT_PATH . DS . 'initialization.php');

class Orders
{

    private $conn;
    private $table_name = "orders";

    // table properties

    public $id;
    public $user_id;
    public $amount;
    public $paid;
    public $payment_status;
    public $order_status;
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
            $query .= "user_id, amount, ";
            $query .= "paid, payment_status, order_status, ";
            $query .= "created_date, edited_date";
            $query .= ")VALUES(";
            $query .= ":user_id, :amount, ";
            $query .= ":paid, :payment_status, :order_status, ";
            $query .= ":created_date, :edited_date";
            $query .= ")";
        }else{
            $query .= "UPDATE ".$this->table_name." SET ";
            $query .= "user_id = :user_id, amount = :amount, ";
            $query .= "paid = :paid, payment_status = :payment_status, order_status = :order_status, ";
            $query .= "created_date = :created_date, edited_date = :edited_date ";
            $query .= "WHERE id = :id";
        }

        // prepare query 
        $stmt = $this->conn->prepare($query);

        // clean up data
        if (!empty($this->id)) {
            $this->id = htmlentities($this->id);
        }
        $this->user_id = htmlentities($this->user_id);
        $this->amount = htmlentities($this->amount);
        $this->paid = htmlentities($this->paid);
        $this->payment_status = htmlentities($this->payment_status);
        $this->order_status = htmlentities($this->order_status);
        $this->created_date = htmlentities($this->created_date);
        $this->edited_date = htmlentities($this->edited_date);

        // bind parameters
        if (!empty($this->id)) {
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':paid', $this->paid);
        $stmt->bindParam(':payment_status', $this->payment_status);
        $stmt->bindParam(':order_status', $this->order_status);
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
            $orders_object = array();
            $count = $stmt->rowCount();
            if ($count > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders_object[] = $row;
                }
            }
            return $orders_object;
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
            $order = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $order;
        } else {
            return false;
        }
    }

    public function find_by_user_id($user_id = 0)
    {
        $query = "SELECT * FROM " . $this->table_name . " ";
        $query .= "WHERE user_id = :user_id ";
        $query .= "ORDER BY id DESC";

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute statemrent 
        if ($stmt->execute(array('user_id'=>$user_id))) {
            // fetch data
            $orders_object = array();
            $count = $stmt->rowCount();
            if ($count > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders_object[] = $row;
                }
            }
            return $orders_object;
        }
    }

    public function find_by_user_id_with_limit($user_id = 0, $limit)
    {
        $query = "SELECT * FROM " . $this->table_name . " ";
        $query .= "WHERE user_id = :user_id ";
        $query .= "ORDER BY id DESC LIMIT ".$limit;

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute statemrent 
        if ($stmt->execute(array('user_id'=>$user_id))) {
            // fetch data
            $orders_object = array();
            $count = $stmt->rowCount();
            if ($count > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $orders_object[] = $row;
                }
            }
            return $orders_object;
        }
    }

}