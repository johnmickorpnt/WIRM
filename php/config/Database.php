<?php

class Database
{
    private $host = 'localhost';
    // private $port = '3306';
    private $db = 'u460957039_wirm';
    private $username = 'u460957039_root';
    private $password = 'I5?qVQg@';
    private $conn;

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $this->conn;
    }
}
