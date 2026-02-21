<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate_contact extends CI_Controller {
    public function index() {
        // Create contact_messages table
        $sql = "CREATE TABLE IF NOT EXISTS `contact_messages` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) NOT NULL,
            `email` varchar(255) NOT NULL,
            `phone` varchar(50) DEFAULT NULL,
            `address` varchar(255) DEFAULT NULL,
            `message` text NOT NULL,
            `is_read` tinyint(1) DEFAULT 0,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        $this->db->query($sql);
        echo "contact_messages table created successfully!";
    }
}
