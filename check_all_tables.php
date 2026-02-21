<?php
$conn = new mysqli('localhost', 'root', '', 'lawfirm_db', 4307);
$tables = ['sliders', 'features', 'practice', 'testimonials', 'teams', 'case_studies', 'case_categories', 'counters', 'blogs', 'social_links', 'menus'];

foreach ($tables as $table) {
    echo "Table: $table\n";
    $res = $conn->query("SHOW COLUMNS FROM $table");
    if ($res) {
        $cols = [];
        while($row = $res->fetch_assoc()) $cols[] = $row['Field'];
        echo "Cols: " . implode(', ', $cols) . "\n";
        if (!in_array('priority', $cols)) {
            echo "MISSING priority in $table\n";
        }
    } else {
        echo "Table $table does not exist\n";
    }
    echo "-------------------\n";
}
