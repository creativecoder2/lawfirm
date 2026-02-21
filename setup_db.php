<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS lawfirm_db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db("lawfirm_db");

// Create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table users created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// Insert default admin user
$admin_user = "admin";
$admin_pass = password_hash("password123", PASSWORD_DEFAULT);
$admin_email = "admin@lawfirm.com";

// Check if admin exists
$result = $conn->query("SELECT * FROM users WHERE username='admin'");
if ($result->num_rows == 0) {
    $sql = "INSERT INTO users (username, password, email) VALUES ('$admin_user', '$admin_pass', '$admin_email')";
    if ($conn->query($sql) === TRUE) {
        echo "Default admin user created successfully\n";
    } else {
        echo "Error creating admin user: " . $conn->error . "\n";
    }
} else {
    echo "Admin user already exists\n";
}

$conn->close();
?>
