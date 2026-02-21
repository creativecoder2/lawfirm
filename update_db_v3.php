<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = 4307;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Create case_categories table
$sql = "CREATE TABLE IF NOT EXISTS case_categories (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'case_categories' created successfully (or already exists).\n";
} else {
    echo "Error creating table 'case_categories': " . $conn->error . "\n";
}

// 2. Add new columns to case_studies if they don't exist
$columns_to_add = [
    'category_id' => "INT(11) AFTER id",
    'description' => "TEXT AFTER subtitle"
];

foreach ($columns_to_add as $col => $def) {
    $check = $conn->query("SHOW COLUMNS FROM case_studies LIKE '$col'");
    if ($check->num_rows == 0) {
        $sql = "ALTER TABLE case_studies ADD $col $def";
        if ($conn->query($sql) === TRUE) {
            echo "Column '$col' added to 'case_studies'.\n";
        } else {
            echo "Error adding column '$col': " . $conn->error . "\n";
        }
    } else {
        echo "Column '$col' already exists in 'case_studies'.\n";
    }
}

// 3. Migrate existing categories to new table and link them
echo "Migrating categories...\n";

// Get unique categories from case_studies (handling the space-separated ones might be tricky,
// but usually these are single categories in a dropdown context. 
// However, the previous data had 'Family Matters Business Injury' which looks like multiple tags.
// For the new feature, we want strict categories. 
// We will take the distinct values currently in 'category' column, clean them up, make them categories.

$result = $conn->query("SELECT id, category FROM case_studies WHERE category IS NOT NULL AND category != ''");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $original_category_string = $row['category'];
        
        // For this migration, we will treat the whole string as one category name 
        // OR we pick the first one if it's space separated. 
        // Given the requirement "proper phely case categories add hongi", 
        // let's try to extract a sensible single category name or just use the string.
        // The user's previous data had "Family Matters Business Injury". 
        // Let's split by space and take the first one as the primary category for migration purposes,
        // OR just create a category with that name to preserve data exactness.
        // Let's create proper clean categories from the plan: Family Law, Business, Criminal, etc.
        // But to be safe, let's just create a category for whatever is there.
        
        $cat_name = trim($original_category_string);
        // Simple slug generation
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $cat_name)));
        
        // Check if category exists
        $cat_check = $conn->query("SELECT id FROM case_categories WHERE name = '$cat_name'");
        if ($cat_check->num_rows > 0) {
            $cat_row = $cat_check->fetch_assoc();
            $cat_id = $cat_row['id'];
        } else {
            // Insert new category
            $stmt = $conn->prepare("INSERT INTO case_categories (name, slug, is_active) VALUES (?, ?, 1)");
            $stmt->bind_param("ss", $cat_name, $slug);
            $stmt->execute();
            $cat_id = $stmt->insert_id;
            $stmt->close();
            echo "Created new category: $cat_name\n";
        }
        
        // Update case_study with category_id
        $update_stmt = $conn->prepare("UPDATE case_studies SET category_id = ? WHERE id = ?");
        $update_stmt->bind_param("ii", $cat_id, $row['id']);
        $update_stmt->execute();
        $update_stmt->close();
    }
    echo "Migration completed.\n";
} else {
    echo "No existing case studies to migrate.\n";
}

$conn->close();
?>
