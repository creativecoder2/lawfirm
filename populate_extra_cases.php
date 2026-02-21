<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = 4307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Populating extra case studies...\n";

// Get all categories
$categories = $conn->query("SELECT id, name, slug FROM case_categories");

$common_desc = "This is an additional case study to demonstrate the related cases functionality. It contains the same placeholder text to fill out the design.\n\nI must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born. I will give you a complete account of the system.";

$images = [
    'assets/images/studies/1.jpg',
    'assets/images/studies/2.jpg',
    'assets/images/studies/3.jpg',
    'assets/images/studies/4.jpg',
    'assets/images/studies/5.jpg'
];

if ($categories->num_rows > 0) {
    $stmt = $conn->prepare("INSERT INTO case_studies (category_id, title, subtitle, image, description, is_active, order_index) VALUES (?, ?, ?, ?, ?, 1, 0)");

    while($cat = $categories->fetch_assoc()) {
        // Add 2 extra cases for each category
        for ($i = 1; $i <= 2; $i++) {
            $title = $cat['name'] . " Case Study " . $i;
            $subtitle = "Additional " . $cat['name'] . " Case";
            $image = $images[array_rand($images)]; // Random image
            
            $stmt->bind_param("issss", $cat['id'], $title, $subtitle, $image, $common_desc);
            if ($stmt->execute()) {
                echo "Inserted: $title\n";
            } else {
                echo "Error: " . $stmt->error . "\n";
            }
        }
    }
    $stmt->close();
}

$conn->close();
?>
