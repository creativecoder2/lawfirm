<?php
$conn = new mysqli('localhost', 'root', '', 'lawfirm_db', 4307);
$result = $conn->query("DESCRIBE blogs");
while($row = $result->fetch_assoc()) {
    echo $row['Field'] . " (" . $row['Type'] . ")\n";
}
echo "---\n";
$result = $conn->query("SHOW TABLES LIKE 'blog_categories'");
if($result->num_rows > 0) {
    echo "blog_categories table exists\n";
    $result = $conn->query("DESCRIBE blog_categories");
    while($row = $result->fetch_assoc()) {
        echo $row['Field'] . " (" . $row['Type'] . ")\n";
    }
} else {
    echo "blog_categories table does NOT exist\n";
}
