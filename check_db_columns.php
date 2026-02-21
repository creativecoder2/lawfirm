<?php
$conn = mysqli_connect("localhost", "root", "", "lawfirm_db", 4307);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$tables = ['sliders', 'features', 'practice_areas', 'testimonials', 'teams', 'case_studies', 'case_categories', 'counters', 'blogs'];
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SHOW COLUMNS FROM $table LIKE 'priority'");
    if ($result && mysqli_num_rows($result) > 0) {
        echo "$table: has priority\n";
    } else {
        echo "$table: NO priority\n";
    }
}
foreach ($tables as $table) {
    $result = mysqli_query($conn, "SHOW COLUMNS FROM $table LIKE 'order_index'");
    if ($result && mysqli_num_rows($result) > 0) {
        echo "$table: has order_index\n";
    } else {
        echo "$table: NO order_index\n";
    }
}
mysqli_close($conn);
