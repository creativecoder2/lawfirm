<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dump_settings extends CI_Controller {
    public function index() {
        $this->load->database();
        $settings = $this->db->get('settings')->result_array();
        echo "Settings:\n";
        foreach ($settings as $s) {
            echo $s['key_name'] . " => " . $s['value'] . "\n";
        }
    }
}
