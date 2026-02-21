<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = "4307";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to " . $dbname . " on port " . $port . "<br>";

$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "Tables in " . $dbname . ":<br>";
  while($row = $result->fetch_array()) {
    echo $row[0] . "<br>";
  }
} else {
  echo "0 tables found in " . $dbname;
}

$conn->close();
?>
