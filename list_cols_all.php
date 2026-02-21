<?php
$conn = new mysqli('localhost', 'root', '', 'lawfirm_db', 4307);
$res = $conn->query("SHOW COLUMNS FROM case_categories");
while($row = $res->fetch_assoc()) echo $row['Field'] . "\n";
echo "--- Sliders ---\n";
$res = $conn->query("SHOW COLUMNS FROM sliders");
while($row = $res->fetch_assoc()) echo $row['Field'] . "\n";
echo "--- Features ---\n";
$res = $conn->query("SHOW COLUMNS FROM features");
while($row = $res->fetch_assoc()) echo $row['Field'] . "\n";
