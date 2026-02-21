<?php
$conn = mysqli_connect("localhost", "root", "", "lawfirm");
$result = mysqli_query($conn, "SHOW COLUMNS FROM case_studies");
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . "\n";
}
mysqli_close($conn);
