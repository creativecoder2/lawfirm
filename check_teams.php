<?php
$c = new mysqli('localhost', 'root', '', 'lawfirm');
$res = $c->query('DESCRIBE teams');
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . ' - ' . $row['Type'] . PHP_EOL;
}
