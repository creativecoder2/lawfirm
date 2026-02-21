<?php
$servername = "localhost";
$username = "";
$password = "";
$dbname = "lawfirm_db";
$port = 4307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add column if not exists
function add_column_if_not_exists($conn, $table, $column, $definition) {
    $check = $conn->query("SHOW COLUMNS FROM $table LIKE '$column'");
    if ($check->num_rows == 0) {
        $sql = "ALTER TABLE $table ADD $column $definition";
        if ($conn->query($sql) === TRUE) {
            echo "Column $column added to $table successfully\n";
        } else {
            echo "Error adding column $column to $table: " . $conn->error . "\n";
        }
    } else {
        echo "Column $column already exists in $table\n";
    }
}

// Add is_active column to existing tables
$tables = ['sliders', 'features', 'practice_areas', 'testimonials', 'teams'];
foreach ($tables as $table) {
    add_column_if_not_exists($conn, $table, 'is_active', "TINYINT(1) DEFAULT 1");
}

// Create Case Studies table
$sql = "CREATE TABLE IF NOT EXISTS case_studies (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    category VARCHAR(100),
    image VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table case_studies created successfully\n";
} else {
    echo "Error creating table case_studies: " . $conn->error . "\n";
}

// Create Counters table
$sql = "CREATE TABLE IF NOT EXISTS counters (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    count_value VARCHAR(50),
    icon VARCHAR(50),
    is_active TINYINT(1) DEFAULT 1,
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table counters created successfully\n";
} else {
    echo "Error creating table counters: " . $conn->error . "\n";
}

// Create Blogs table
$sql = "CREATE TABLE IF NOT EXISTS blogs (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100),
    date_published DATE,
    image VARCHAR(255),
    link VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table blogs created successfully\n";
} else {
    echo "Error creating table blogs: " . $conn->error . "\n";
}

$conn->close();
?>
