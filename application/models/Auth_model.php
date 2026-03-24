<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function validate_user($username, $password) {
        // Check by username first
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 0) {
            // Try by email
            $this->db->where('email', $username);
            $query = $this->db->get('users');
        }

        if ($query->num_rows() == 1) {
            $user = $query->row();
            if ($password == $user->password) {
                return $user;
            }
        }
        return false;
    }
}
