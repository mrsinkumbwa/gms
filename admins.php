<?php
require_once('database.php');

class Admins {
    private $conn;
    private $table_name = "admins";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Create a new admin
    public function createAdmin($data) {
        $query = "INSERT INTO " . $this->table_name . " (username, password, role) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sss", $data['username'], $data['password'], $data['role']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Authenticate an admin based on the provided username and password
    public function authenticateAdmin($username, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            return $admin;
        } else {
            return null;
        }
    }
    // Retrieve an admin by ID
    public function getAdmin($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            return $admin;
        } else {
            return null;
        }
    }

    // Retrieve an admin by username
    public function getAdminByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            return $admin;
        } else {
            return null;
        }
    }

    // Update an admin
    public function updateAdmin($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET username = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssi", $data['username'], $data['password'], $data['role'], $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete an admin
    public function deleteAdmin($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>
