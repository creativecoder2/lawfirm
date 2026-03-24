<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawfirm_db";
$port = 4307;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add show_in_footer to menus
$check_menus = $conn->query("SHOW COLUMNS FROM menus LIKE 'show_in_footer'");
if ($check_menus->num_rows == 0) {
    $conn->query("ALTER TABLE menus ADD show_in_footer TINYINT(1) DEFAULT 1 AFTER is_active");
    echo "Added show_in_footer to menus table\n";
} else {
    echo "show_in_footer already exists in menus table\n";
}

// Add show_in_footer to practice_areas
$check_practice = $conn->query("SHOW COLUMNS FROM practice_areas LIKE 'show_in_footer'");
if ($check_practice->num_rows == 0) {
    $conn->query("ALTER TABLE practice_areas ADD show_in_footer TINYINT(1) DEFAULT 1 AFTER is_active");
    echo "Added show_in_footer to practice_areas table\n";
} else {
    echo "show_in_footer already exists in practice_areas table\n";
}

$conn->close();
?>
