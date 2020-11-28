<?php
class Database
{
    // private $host = 'ao9moanwus0rjiex.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
    // private $username = 'wl2ey05gy264zjx4';
    // private $password = 'lphahk0enaa0jgnp';
    // private $dbname = 'wymjb97iib1h95gd';

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'in-house';

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