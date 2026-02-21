<?php
$files = [
    'application/controllers/Welcome.php',
    'application/controllers/Admin.php',
    'application/models/Auth_model.php',
    'application/views/home.php',
    'application/views/case_studies_details.php',
    'application/views/admin/dashboard.php',
    'application/views/admin/case_categories/index.php',
    'application/views/admin/case_categories/add.php',
    'application/views/admin/case_categories/edit.php',
    'application/views/admin/case_studies/index.php',
    'application/views/admin/case_studies/add.php',
    'application/views/admin/case_studies/edit.php',
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $output = shell_exec("php -l " . escapeshellarg($file));
        echo $file . ": " . $output;
    } else {
        echo "File not found: $file\n";
    }
}
?>
