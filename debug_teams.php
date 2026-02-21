<?php
include 'index.php';
$CI =& get_instance();
$teams = $CI->db->get('teams')->result_array();
echo json_encode($teams, JSON_PRETTY_PRINT);
