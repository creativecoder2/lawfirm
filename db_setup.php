<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = "4307";

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS menus (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    title VARCHAR(255) NOT NULL, 
    link VARCHAR(255) NOT NULL, 
    priority INT DEFAULT 0, 
    is_active TINYINT(1) DEFAULT 1, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table menus created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error . "<br>";
}

// Insert data
$menus = [
    ['Home', '', 1],
    ['About Us', 'welcome/about', 2],
    ['Practices Area', 'welcome/practice', 3],
    ['Cases', 'welcome/case_studies', 4],
    ['Blog', 'welcome/blog', 5],
    ['Contact', 'welcome/contact', 6]
];

foreach ($menus as $m) {
    $stmt = $conn->prepare("INSERT INTO menus (title, link, priority) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $m[0], $m[1], $m[2]);
    $stmt->execute();
}

echo "Default menu items inserted successfully";

$conn->close();
?>
