<?php
require_once('database.php');

class Users {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Create a new user
    public function createUser($data) {
        $query = "INSERT INTO " . $this->table_name . " (first_name, last_name, email, phone, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssss", $data['first_name'], $data['last_name'], $data['email'], $data['phone'], $data['password']);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve a user by ID
    public function getUser($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return null;
        }
    }
    // Retrieve a user by email
    public function getUserByEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return null;
        }
    }
    // Authenticate a user
// Authenticate a user
    public function authenticateUser($email, $password) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $stored_password = $user['password'];

            // Verify the password
            if ($password === $stored_password) {
                // Password is correct
                return $user;
            } else {
                // Password is incorrect
                return null;
            }
        } else {
            // User does not exist
            return null;
        }
    }


    
    // Update a user
    public function updateUser($id, $data) {
        $query = "UPDATE " . $this->table_name . " SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssssi", $data['first_name'], $data['last_name'], $data['email'], $data['phone'], $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Delete a user
    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    // Check if email already exists in the database
    public function emailExists($email) {
        $query = "SELECT id FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>
