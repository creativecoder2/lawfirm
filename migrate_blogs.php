<?php
$conn = new mysqli('localhost', 'root', '', 'lawfirm_db', 4307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create blog_categories table
$sql = "CREATE TABLE IF NOT EXISTS blog_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    priority INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table blog_categories created successfully\n";
} else {
    echo "Error creating table: " . $conn->error . "\n";
}

// 2. Add columns to blogs table
$columns_to_add = [
    "description TEXT AFTER title",
    "category_id INT DEFAULT NULL AFTER description",
    "tags VARCHAR(255) DEFAULT NULL AFTER category_id",
    "slug VARCHAR(255) NOT NULL AFTER tags",
    "video_url VARCHAR(255) DEFAULT NULL AFTER slug",
    "quote TEXT DEFAULT NULL AFTER video_url",
    "priority INT DEFAULT 0 AFTER quote",
    "is_active TINYINT(1) DEFAULT 1 AFTER priority"
];

foreach ($columns_to_add as $col) {
    $sql = "ALTER TABLE blogs ADD COLUMN " . $col;
    if ($conn->query($sql) === TRUE) {
        echo "Column added successfully: " . $col . "\n";
    } else {
        echo "Error adding column: " . $conn->error . " (Maybe it already exists?)\n";
    }
}

// 3. Populate slugs for existing blogs if any
$result = $conn->query("SELECT id, title FROM blogs WHERE slug = '' OR slug IS NULL");
while($row = $result->fetch_assoc()) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row['title'])));
    $conn->query("UPDATE blogs SET slug = '$slug' WHERE id = " . $row['id']);
    echo "Updated slug for blog ID " . $row['id'] . "\n";
}

$conn->close();
?>
