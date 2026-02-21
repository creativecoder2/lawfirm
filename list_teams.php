<?php
include 'index.php';
$CI =& get_instance();
$teams = $CI->db->get('teams')->result();
foreach($teams as $team) {
    echo "ID: " . $team->id . " | Name: " . $team->name . " | Slug: " . $team->slug . "\n";
}
