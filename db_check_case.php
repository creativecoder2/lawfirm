<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = "4307";

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

echo "--- CASE STUDIES TABLE ---\n";
$result = $conn->query("DESCRIBE case_studies");
while($row = $result->fetch_assoc()) {
    print_r($row);
}

echo "\n--- CASE CATEGORIES TABLE ---\n";
$result = $conn->query("DESCRIBE case_categories");
while($row = $result->fetch_assoc()) {
    print_r($row);
}

$conn->close();
?>
