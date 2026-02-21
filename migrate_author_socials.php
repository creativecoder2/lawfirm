<?php
define('BASEPATH', '1');
define('ENVIRONMENT', 'development');
require_once('application/config/database.php');

$conn = new mysqli($db['default']['hostname'], 'root', $db['default']['password'], $db['default']['database'], $db['default']['port']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if columns already exist
$result = $conn->query("SHOW COLUMNS FROM blogs LIKE 'author_facebook'");
if ($result->num_rows == 0) {
    $sql = "ALTER TABLE blogs 
            ADD COLUMN author_facebook VARCHAR(255) DEFAULT NULL,
            ADD COLUMN author_twitter VARCHAR(255) DEFAULT NULL,
            ADD COLUMN author_linkedin VARCHAR(255) DEFAULT NULL,
            ADD COLUMN author_instagram VARCHAR(255) DEFAULT NULL";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table 'blogs' updated successfully with author social columns.";
    } else {
        echo "Error updating table: " . $conn->error;
    }
} else {
    echo "Columns already exist in 'blogs' table.";
}

$conn->close();
?>
