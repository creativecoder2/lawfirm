<?php
$conn = new mysqli('localhost', 'root', '', 'lawfirm_db', 4307);
$res = $conn->query("SHOW COLUMNS FROM case_studies");
while($row = $res->fetch_assoc()) echo $row['Field'] . "\n";
