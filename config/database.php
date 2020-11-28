<?php
class Database
{
    private $host = 'klbcedmmqp7w17ik.cbetxkdyhwsb.us-east-1.rds.amazonaws.com	';
    private $username = 'aljnhdru7sv17lqd';
    private $password = 'f8f8p6n926h840u5';
    private $dbname = 'f6qhz4pmqqpox00h';

    // private $host = 'localhost';
    // private $username = 'root';
    // private $password = '';
    // private $dbname = 'in-house';

    private $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}

$database = new Database();