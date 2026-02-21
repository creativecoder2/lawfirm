<?php
ob_start();
include 'index.php';
ob_end_clean();
$CI =& get_instance();
$teams = $CI->db->get('teams')->result();
echo "---TEAMS_LIST_START---\n";
foreach($teams as $team) {
    echo "ID: " . $team->id . " | Name: " . $team->name . " | Slug: " . $team->slug . "\n";
}
echo "---TEAMS_LIST_END---\n";
