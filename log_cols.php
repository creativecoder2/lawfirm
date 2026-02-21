<?php
$conn = new mysqli('localhost', 'root', '', 'lawfirm_db', 4307);
$tables = ['sliders', 'features', 'practice', 'testimonials', 'teams', 'case_studies', 'case_categories', 'counters', 'blogs', 'social_links', 'menus'];
$output = "";

foreach ($tables as $table) {
    $output .= "Table: $table\n";
    $res = $conn->query("SHOW COLUMNS FROM $table");
    if ($res) {
        $cols = [];
        while($row = $res->fetch_assoc()) $cols[] = $row['Field'];
        $output .= "Cols: " . implode(', ', $cols) . "\n";
        if (!in_array('priority', $cols)) {
            $output .= "MISSING priority\n";
        }
    } else {
        $output .= "Table $table does not exist\n";
    }
    $output .= "-------------------\n";
}
file_put_contents('table_check_results.txt', $output);
