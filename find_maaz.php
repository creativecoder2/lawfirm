<?php
ob_start();
include 'index.php';
ob_end_clean();
$CI =& get_instance();
$team = $CI->db->like('name', 'Maaz')->get('teams')->row();
if ($team) {
    echo "FOUND: " . $team->name . " | ID: " . $team->id . "\n";
    echo "BIO: " . substr($team->bio, 0, 50) . "...\n";
} else {
    echo "NOT FOUND\n";
    // List all just in case
    $all = $CI->db->get('teams')->result();
    foreach($all as $a) echo "ID: " . $a->id . " Name: " . $a->name . "\n";
}
