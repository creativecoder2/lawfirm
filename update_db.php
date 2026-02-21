<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create Sliders table
$sql = "CREATE TABLE IF NOT EXISTS sliders (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    title VARCHAR(100),
    subtitle VARCHAR(255),
    button_text VARCHAR(50),
    button_link VARCHAR(255),
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table sliders created successfully\n";
} else {
    echo "Error creating table sliders: " . $conn->error . "\n";
}

// Create Features table
$sql = "CREATE TABLE IF NOT EXISTS features (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50),
    title VARCHAR(100),
    subtitle VARCHAR(255),
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table features created successfully\n";
} else {
    echo "Error creating table features: " . $conn->error . "\n";
}

// Create Practice Areas table
$sql = "CREATE TABLE IF NOT EXISTS practice_areas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    icon VARCHAR(50),
    title VARCHAR(100),
    description TEXT,
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table practice_areas created successfully\n";
} else {
    echo "Error creating table practice_areas: " . $conn->error . "\n";
}

// Create Testimonials table
$sql = "CREATE TABLE IF NOT EXISTS testimonials (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    designation VARCHAR(100),
    image VARCHAR(255),
    message TEXT,
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table testimonials created successfully\n";
} else {
    echo "Error creating table testimonials: " . $conn->error . "\n";
}

// Create Teams table
$sql = "CREATE TABLE IF NOT EXISTS teams (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    designation VARCHAR(100),
    image VARCHAR(255),
    facebook VARCHAR(255),
    twitter VARCHAR(255),
    linkedin VARCHAR(255),
    order_index INT(6) DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Table teams created successfully\n";
} else {
    echo "Error creating table teams: " . $conn->error . "\n";
}

// Create Settings table
$sql = "CREATE TABLE IF NOT EXISTS settings (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key_name VARCHAR(50) UNIQUE,
    value TEXT
)";
if ($conn->query($sql) === TRUE) {
    echo "Table settings created successfully\n";
} else {
    echo "Error creating table settings: " . $conn->error . "\n";
}

// Insert default settings
$default_settings = [
    'site_title' => 'Legal Eagle Law Firm',
    'contact_phone' => '+92 322 4490008',
    'contact_email' => 'legallaw669@gmail.com',
    'contact_address' => 'Office no 3 2nd floor, Kareem chamber, road, Mozang Chungi, Lahore, 54000',
    'about_title' => 'Building Trust Through Decades of Service',
    'about_text' => 'Founded in 2020 by Maaz Ahmed, our firm began with a simple mission...',
    'about_image' => 'assets/images/about/img-2.png',
    'hero_title' => 'We Fight For Your Justice As Like A Friend.',
    'hero_text' => 'There are many variations of passages of Lorem Ipsum available...',
    'video_url' => 'https://www.youtube.com/embed/uQBL7pSAXR8?autoplay=1',
    'consultation_title' => 'Ready to Discuss Your Case?',
    'consultation_text' => 'Don’t wait to protect your rights. Contact us today...'
];

foreach ($default_settings as $key => $value) {
    $value = $conn->real_escape_string($value);
    $sql = "INSERT IGNORE INTO settings (key_name, value) VALUES ('$key', '$value')";
    $conn->query($sql);
}

echo "Default settings inserted\n";

$conn->close();
?>
