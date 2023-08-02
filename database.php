<?php

class Database {
    private $host = "localhost";
    private $username = "mbanga";
    private $password = "bite@00427";
    private $database = "heavenly_tomb_db";
    private $conn;

    private function connectToDatabase() {
        try {
            $conn = new mysqli($this->host, $this->username, $this->password, $this->database);

            // Check for connection errors
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Set the character set to UTF-8 to support international characters
            $conn->set_charset("utf8mb4");

            return $conn;
        } catch (Exception $e) {
            die("Connection error: " . $e->getMessage());
        }
    }

    public function __construct() {
        $this->conn = $this->connectToDatabase();
    }

    public function getConnection() {
        return $this->conn;
    }

    public function prepareStatement($sql) {
        return $this->conn->prepare($sql);
    }

    public function closeConnection() {
        if ($this->conn !== null) {
            $this->conn->close();
        }
    }
}

?>
