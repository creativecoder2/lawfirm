<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate_Team extends CI_Controller {

    public function index() {
        $this->load->dbforge();

        $all_fields = array(
            'slug' => array('type' => 'VARCHAR', 'constraint' => '255', 'unique' => TRUE, 'after' => 'name'),
            'bio' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'designation'),
            'education' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'bio'),
            'experience' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => TRUE, 'after' => 'education'),
            'email' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE, 'after' => 'experience'),
            'phone' => array('type' => 'VARCHAR', 'constraint' => '50', 'null' => TRUE, 'after' => 'email'),
            'address' => array('type' => 'TEXT', 'null' => TRUE, 'after' => 'phone'),
            'languages' => array('type' => 'VARCHAR', 'constraint' => '255', 'null' => TRUE, 'after' => 'address'),
            'priority' => array('type' => 'INT', 'constraint' => '11', 'default' => 0, 'after' => 'linkedin'),
            'is_active' => array('type' => 'INT', 'constraint' => '1', 'default' => 1, 'after' => 'priority')
        );

        foreach ($all_fields as $field => $config) {
            if (!$this->db->field_exists($field, 'teams')) {
                $this->dbforge->add_column('teams', array($field => $config));
            }
        }

        // Rename description to bio if it exists and bio doesn't have data
        if ($this->db->field_exists('description', 'teams')) {
            $this->db->query("UPDATE teams SET bio = description WHERE bio IS NULL OR bio = ''");
        }

        // Populate slugs for existing entries
        $query = $this->db->get('teams');
        foreach ($query->result() as $row) {
            if (empty($row->slug)) {
                $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $row->name)));
                $this->db->where('id', $row->id);
                $this->db->update('teams', array('slug' => $slug));
            }
        }

        echo "Teams table migrated successfully!";
    }
}
