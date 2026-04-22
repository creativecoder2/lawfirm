<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate_payment extends CI_Controller {
    public function index() {
        // Add consultation_fee to practice_areas
        $this->db->query("ALTER TABLE `practice_areas` ADD COLUMN IF NOT EXISTS `consultation_fee` decimal(10,2) DEFAULT 0.00;");

        // Add payment_method + practice_category_id to appointments
        $this->db->query("ALTER TABLE `appointments` ADD COLUMN IF NOT EXISTS `payment_method` varchar(50) DEFAULT NULL;");
        $this->db->query("ALTER TABLE `appointments` ADD COLUMN IF NOT EXISTS `practice_category_id` int(11) DEFAULT NULL;");
        $this->db->query("ALTER TABLE `appointments` ADD COLUMN IF NOT EXISTS `consultation_fee` decimal(10,2) DEFAULT NULL;");

        // Add PayFast settings
        $payfast_settings = [
            'payfast_merchant_id' => '',
            'payfast_secured_key' => '',
            'payfast_base_url'    => 'https://ipg2.apps.net.pk',
            'payfast_port'        => '8443',
            'payfast_mode'        => 'sandbox'
        ];

        foreach ($payfast_settings as $key => $val) {
            $exists = $this->db->get_where('settings', ['key_name' => $key])->row_array();
            if (!$exists) {
                $this->db->insert('settings', ['key_name' => $key, 'value' => $val]);
            }
        }

        echo "Payment migration completed successfully!";
    }
}
