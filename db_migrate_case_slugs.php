<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = "4307";

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// 1. Check case_studies schema
$columns = [];
$result = $conn->query("SHOW COLUMNS FROM case_studies");
while($row = $result->fetch_assoc()) {
    $columns[] = $row['Field'];
}

echo "Current Case Studies columns: " . implode(', ', $columns) . "\n";

if (!in_array('slug', $columns)) {
    echo "Adding 'slug' column to case_studies...\n";
    $conn->query("ALTER TABLE case_studies ADD COLUMN slug VARCHAR(255) AFTER title");
}

// 2. Update slugs for existing data
function slugify($text) {
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);
    // trim
    $text = trim($text, '-');
    // remove duplicate -
    $text = preg_replace('~-+~', '-', $text);
    // lowercase
    $text = strtolower($text);
    if (empty($text)) return 'n-a';
    return $text;
}

$cases = $conn->query("SELECT id, title FROM case_studies");
while($case = $cases->fetch_assoc()) {
    $slug = slugify($case['title']);
    // Ensure uniqueness (simple)
    $stmt = $conn->prepare("UPDATE case_studies SET slug = ? WHERE id = ?");
    $stmt->bind_param("si", $slug, $case['id']);
    $stmt->execute();
    echo "Updated Case ID {$case['id']} with slug: $slug\n";
}

$conn->close();
?>
