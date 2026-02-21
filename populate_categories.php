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

// Original Categories from the HTML
$categories = [
    ['name' => 'Family Matters', 'slug' => 'Family-Matters'],
    ['name' => 'Real Estate', 'slug' => 'Real-Estate'],
    ['name' => 'Business', 'slug' => 'Business'],
    ['name' => 'Criminal', 'slug' => 'Criminal'],
    ['name' => 'Injury', 'slug' => 'Injury'],
    ['name' => 'Education Law', 'slug' => 'Education-Law'],
    ['name' => 'Drugs Crime', 'slug' => 'Drugs-Crime']
];

echo "Populating categories...\n";

foreach ($categories as $cat) {
    $name = $cat['name'];
    $slug = $cat['slug']; // Use the specific slug from the original HTML design

    // Check if exists (by name or slug)
    $check = $conn->query("SELECT id FROM case_categories WHERE name = '$name' OR slug = '$slug'");
    if ($check->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO case_categories (name, slug, is_active) VALUES (?, ?, 1)");
        $stmt->bind_param("ss", $name, $slug);
        
        if ($stmt->execute()) {
            echo "Inserted: $name ($slug)\n";
        } else {
            echo "Error inserting $name: " . $stmt->error . "\n";
        }
    } else {
        echo "Category already exists: $name\n";
         // Optional: Update slug to match the original design if it exists but is different?
         // For now, let's assume if it exists it's fine, but user emphasized "wohi show krwao".
         // Let's FORCE update the slug to match the user's design requirement if it exists.
         $conn->query("UPDATE case_categories SET slug = '$slug' WHERE name = '$name'");
         echo "Updated slug for: $name\n";
    }
}

// Also, let's look at the existing case_studies and try to map them to these categories.
// This is a bit looser since we don't know the exact IDs, but we can try to distribute them or 
// just leave them for the admin to assign. The user said "insert krwao" which implies the categories.

echo "Done.\n";
$conn->close();
?>
