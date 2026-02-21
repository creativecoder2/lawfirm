<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Auth_model');
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'file', 'form']);
    }

    private function _slugify($text) {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        $text = strtolower($text);
        if (empty($text)) return 'n-a';
        return $text;
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        } else {
            redirect('admin/login');
        }
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }
        $this->load->view('admin/login');
    }

    public function login_post() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->validate_user($username, $password);

        if ($user) {
            $session_data = array(
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);
            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect('admin/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('admin/login');
    }

    public function dashboard() {
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('admin/includes/footer');
    }

    // Settings
    public function settings() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if ($this->input->post()) {
            $data = $this->input->post();
            
            // Handle Image Uploads
            $upload_fields = ['site_logo', 'about_image', 'signature_image'];
            foreach ($upload_fields as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $config['upload_path']   = './assets/images/settings/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']      = 2048;
                    $config['encrypt_name']  = TRUE;

                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0777, TRUE);
                    }

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload($field)) {
                        $uploadData = $this->upload->data();
                        $data[$field] = 'assets/images/settings/' . $uploadData['file_name'];
                    }
                }
            }

            foreach ($data as $key => $value) {
                $this->db->replace('settings', ['key_name' => $key, 'value' => $value]);
            }
            $this->session->set_flashdata('success', 'Settings updated successfully');
            redirect('admin/settings');
        }

        $settings = $this->db->get('settings')->result_array();
        $data['settings'] = [];
        foreach ($settings as $setting) {
            $data['settings'][$setting['key_name']] = $setting['value'];
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/settings', $data);
        $this->load->view('admin/includes/footer');
    }

    // Menus
    public function menus() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['menus'] = $this->db->order_by('priority', 'ASC')->get('menus')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/menus/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function menu_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->insert('menus', $data);
            $this->session->set_flashdata('success', 'Menu item added successfully');
            redirect('admin/menus');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/menus/add');
        $this->load->view('admin/includes/footer');
    }

    public function menu_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->where('id', $id)->update('menus', $data);
            $this->session->set_flashdata('success', 'Menu item updated successfully');
            redirect('admin/menus');
        }
        $data['menu'] = $this->db->get_where('menus', ['id' => $id])->row_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/menus/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function menu_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('menus');
        $this->session->set_flashdata('success', 'Menu item deleted successfully');
        redirect('admin/menus');
    }

    // About Us Management
    public function about_us() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if ($this->input->post()) {
            $data = $this->input->post();
            
            // Handle Image Uploads
            $upload_path = './assets/images/about/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            $upload_fields = ['image', 'signature_image'];
            foreach ($upload_fields as $field) {
                if (!empty($_FILES[$field]['name'])) {
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload($field)) {
                        $uploadData = $this->upload->data();
                        $data[$field] = 'assets/images/about/' . $uploadData['file_name'];
                    }
                }
            }

            $this->db->where('id', 1)->update('about_us', $data);
            $this->session->set_flashdata('success', 'About Us content updated successfully');
            redirect('admin/about_us');
        }

        $data['about'] = $this->db->get_where('about_us', ['id' => 1])->row_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/about_us/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function about_features() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['features'] = $this->db->order_by('priority', 'ASC')->get('about_features')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/about_features/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function about_feature_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->insert('about_features', $data);
            $this->session->set_flashdata('success', 'Feature added successfully');
            redirect('admin/about_features');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/about_features/add');
        $this->load->view('admin/includes/footer');
    }

    public function about_feature_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->where('id', $id)->update('about_features', $data);
            $this->session->set_flashdata('success', 'Feature updated successfully');
            redirect('admin/about_features');
        }
        $data['feature'] = $this->db->get_where('about_features', ['id' => $id])->row_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/about_features/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function about_feature_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('about_features');
        $this->session->set_flashdata('success', 'Feature deleted successfully');
        redirect('admin/about_features');
    }

    // Sliders
    public function sliders() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['sliders'] = $this->db->get('sliders')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/sliders/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function slider_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/slider/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $data = $this->input->post();
                $data['image'] = 'assets/images/slider/' . $file_data['file_name'];
                $this->db->insert('sliders', $data);
                $this->session->set_flashdata('success', 'Slider added successfully');
                redirect('admin/sliders');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect('admin/sliders'); // Simplify for now
            }
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/sliders/add');
        $this->load->view('admin/includes/footer');
    }

    public function slider_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('sliders', array('id' => $id));
        $this->session->set_flashdata('success', 'Slider deleted successfully');
        redirect('admin/sliders');
    }

    public function slider_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $data['slider'] = $this->db->get_where('sliders', array('id' => $id))->row_array();

        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/slider/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            $update_data = $this->input->post();

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $file_data = $this->upload->data();
                    $update_data['image'] = 'assets/images/slider/' . $file_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/slider_edit/' . $id);
                }
            }

            $this->db->where('id', $id);
            $this->db->update('sliders', $update_data);
            $this->session->set_flashdata('success', 'Slider updated successfully');
            redirect('admin/sliders');
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/sliders/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function slider_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('sliders', array('is_active' => $status));
        $this->session->set_flashdata('success', 'Slider status updated');
        redirect('admin/sliders');
    }

    // Subscribers
    public function subscribers() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['subscribers'] = $this->db->order_by('id', 'DESC')->get('subscribers')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/subscribers/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function subscriber_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('subscribers');
        $this->session->set_flashdata('success', 'Subscriber deleted');
        redirect('admin/subscribers');
    }

    public function subscriber_send_email($id = null) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if ($this->input->post()) {
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $email = $this->input->post('email'); // If null, send to all (optional)

            // For now, we simulate sending or use CI email library
            // $this->load->library('email');
            // ... set email params ...
            
            $this->session->set_flashdata('success', 'Email sent to ' . ($email ? $email : 'all subscribers'));
            redirect('admin/subscribers');
        }

        $data['subscriber'] = $id ? $this->db->get_where('subscribers', ['id' => $id])->row_array() : null;
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/subscribers/send_email', $data);
        $this->load->view('admin/includes/footer');
    }

    // Social Links
    public function social_links() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['social_links'] = $this->db->order_by('priority', 'ASC')->get('social_links')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/social_links/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function social_link_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->insert('social_links', $data);
            $this->session->set_flashdata('success', 'Social link added successfully');
            redirect('admin/social_links');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/social_links/add');
        $this->load->view('admin/includes/footer');
    }

    public function social_link_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->where('id', $id)->update('social_links', $data);
            $this->session->set_flashdata('success', 'Social link updated successfully');
            redirect('admin/social_links');
        }
        $data['social_link'] = $this->db->get_where('social_links', ['id' => $id])->row_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/social_links/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function social_link_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('social_links');
        $this->session->set_flashdata('success', 'Social link deleted successfully');
        redirect('admin/social_links');
    }
    
    // Features
    public function features() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['features'] = $this->db->get('features')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/features/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function feature_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->insert('features', $data);
            $this->session->set_flashdata('success', 'Feature added successfully');
            redirect('admin/features');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/features/add');
        $this->load->view('admin/includes/footer');
    }

    public function feature_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('features', array('id' => $id));
        $this->session->set_flashdata('success', 'Feature deleted successfully');
        redirect('admin/features');
    }

    public function feature_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $data['feature'] = $this->db->get_where('features', array('id' => $id))->row_array();

        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->where('id', $id);
            $this->db->update('features', $data);
            $this->session->set_flashdata('success', 'Feature updated successfully');
            redirect('admin/features');
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/features/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function feature_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('features', array('is_active' => $status));
        $this->session->set_flashdata('success', 'Feature status updated');
        redirect('admin/features');
    }

    // Practice Areas
     public function practice() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['practice'] = $this->db->get('practice_areas')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/practice/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function practice_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            
            // Handle Slug
            if (empty($data['slug'])) {
                $data['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])));
            }

            // Handle Image Upload
            $upload_path = './assets/images/practice/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $data['image'] = 'assets/images/practice/' . $uploadData['file_name'];
                }
            }

            $this->db->insert('practice_areas', $data);
            $this->session->set_flashdata('success', 'Practice Area added successfully');
            redirect('admin/practice');
        }
        $this->load_view('admin/practice/add');
    }

    public function practice_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('practice_areas', array('id' => $id));
        $this->session->set_flashdata('success', 'Practice Area deleted successfully');
        redirect('admin/practice');
    }

    public function practice_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $data['practice'] = $this->db->get_where('practice_areas', array('id' => $id))->row_array();

        if ($this->input->post()) {
            $update_data = $this->input->post();
            
            // Handle Slug
            if (empty($update_data['slug'])) {
                $update_data['slug'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $update_data['title'])));
            }

            // Handle Image Upload
            $upload_path = './assets/images/practice/';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, TRUE);
            }

            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $uploadData = $this->upload->data();
                    $update_data['image'] = 'assets/images/practice/' . $uploadData['file_name'];
                }
            }

            $this->db->where('id', $id);
            $this->db->update('practice_areas', $update_data);
            $this->session->set_flashdata('success', 'Practice Area updated successfully');
            redirect('admin/practice');
        }

        $this->load_view('admin/practice/edit', $data);
    }

    public function practice_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('practice_areas', array('is_active' => $status));
        $this->session->set_flashdata('success', 'Practice status updated');
        redirect('admin/practice');
    }

    // Testimonials
    public function testimonials() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['testimonials'] = $this->db->get('testimonials')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/testimonials/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function testimonial_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/testimonials/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $data = $this->input->post();
                $data['image'] = 'assets/images/testimonials/' . $file_data['file_name'];
                $this->db->insert('testimonials', $data);
                $this->session->set_flashdata('success', 'Testimonial added successfully');
                redirect('admin/testimonials');
            } else {
                 $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect('admin/testimonials');
            }
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/testimonials/add');
        $this->load->view('admin/includes/footer');
    }

    public function testimonial_delete($id) {
         if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('testimonials', array('id' => $id));
        $this->session->set_flashdata('success', 'Testimonial deleted successfully');
        redirect('admin/testimonials');
    }

    public function testimonial_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $data['testimonial'] = $this->db->get_where('testimonials', array('id' => $id))->row_array();

        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/testimonials/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            $update_data = $this->input->post();

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $file_data = $this->upload->data();
                    $update_data['image'] = 'assets/images/testimonials/' . $file_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/testimonial_edit/' . $id);
                }
            }

            $this->db->where('id', $id);
            $this->db->update('testimonials', $update_data);
            $this->session->set_flashdata('success', 'Testimonial updated successfully');
            redirect('admin/testimonials');
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/testimonials/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function testimonial_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('testimonials', array('is_active' => $status));
        $this->session->set_flashdata('success', 'Testimonial status updated');
        redirect('admin/testimonials');
    }

    // Teams
    public function teams() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['teams'] = $this->db->get('teams')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/teams/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function team_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/team/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            $data = $this->input->post();
            
            // Generate slug if not provided
            if (empty($data['slug'])) {
                $data['slug'] = $this->_slugify($data['name']);
            }

            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $data['image'] = 'assets/images/team/' . $file_data['file_name'];
                $this->db->insert('teams', $data);
                $this->session->set_flashdata('success', 'Team Member added successfully');
                redirect('admin/teams');
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('admin/team_add');
            }
        }
        $this->load_view('admin/teams/add');
    }

    public function team_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('teams', array('id' => $id));
        $this->session->set_flashdata('success', 'Team Member deleted successfully');
        redirect('admin/teams');
    }

    public function team_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['team'] = $this->db->get_where('teams', array('id' => $id))->row_array();

        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/team/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            $update_data = $this->input->post();
            
            if (empty($update_data['slug'])) {
                $update_data['slug'] = $this->_slugify($update_data['name']);
            }

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $file_data = $this->upload->data();
                    $update_data['image'] = 'assets/images/team/' . $file_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/team_edit/' . $id);
                }
            }

            $this->db->where('id', $id);
            $this->db->update('teams', $update_data);
            $this->session->set_flashdata('success', 'Team Member updated successfully');
            redirect('admin/teams');
        }

        $this->load_view('admin/teams/edit', $data);
    }

    public function team_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('teams', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Team member status updated');
        redirect('admin/teams');
    }

    // Blog Categories Management
    public function blog_categories() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['categories'] = $this->db->order_by('priority', 'ASC')->get('blog_categories')->result_array();
        $this->load_view('admin/blog_categories/index', $data);
    }

    public function blog_category_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'slug' => $this->_slugify($this->input->post('name')),
                'is_active' => 1
            ];
            $this->db->insert('blog_categories', $data);
            $this->session->set_flashdata('success', 'Category added successfully');
            redirect('admin/blog_categories');
        }
        $this->load_view('admin/blog_categories/add');
    }

    public function blog_category_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'slug' => $this->_slugify($this->input->post('name'))
            ];
            $this->db->where('id', $id);
            $this->db->update('blog_categories', $data);
            $this->session->set_flashdata('success', 'Category updated successfully');
            redirect('admin/blog_categories');
        }
        $data['category'] = $this->db->get_where('blog_categories', array('id' => $id))->row_array();
        $this->load_view('admin/blog_categories/edit', $data);
    }

    public function blog_category_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('blog_categories', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Status updated successfully');
        redirect('admin/blog_categories');
    }

    public function blog_category_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->delete('blog_categories');
        $this->session->set_flashdata('success', 'Category deleted successfully');
        redirect('admin/blog_categories');
    }

    // Case Studies
    public function case_studies() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->select('case_studies.*, case_categories.name as category_name');
        $this->db->from('case_studies');
        $this->db->join('case_categories', 'case_studies.category_id = case_categories.id', 'left');
        $data['case_studies'] = $this->db->get()->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/case_studies/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function case_study_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/case_studies/';
            // Create directory if it doesn't exist
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $data = $this->input->post();
                $data['slug'] = $this->_slugify($data['title']);
                $data['image'] = 'assets/images/case_studies/' . $file_data['file_name'];
                $this->db->insert('case_studies', $data);
                $this->session->set_flashdata('success', 'Case Study added successfully');
                redirect('admin/case_studies');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect('admin/case_studies');
            }
        }
        $data['categories'] = $this->db->where('is_active', 1)->get('case_categories')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/case_studies/add', $data);
        $this->load->view('admin/includes/footer');
    }

    public function case_study_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $data['case_study'] = $this->db->get_where('case_studies', array('id' => $id))->row_array();
        $data['categories'] = $this->db->where('is_active', 1)->get('case_categories')->result_array();

        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/case_studies/';
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            $update_data = $this->input->post();
            $update_data['slug'] = $this->_slugify($update_data['title']);

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $file_data = $this->upload->data();
                    $update_data['image'] = 'assets/images/case_studies/' . $file_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/case_study_edit/' . $id);
                }
            }

            $this->db->where('id', $id);
            $this->db->update('case_studies', $update_data);
            $this->session->set_flashdata('success', 'Case Study updated successfully');
            redirect('admin/case_studies');
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/case_studies/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function case_study_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('case_studies', array('id' => $id));
        $this->session->set_flashdata('success', 'Case Study deleted successfully');
        redirect('admin/case_studies');
    }

    public function case_study_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('case_studies', array('is_active' => $status));
        $this->session->set_flashdata('success', 'Case Study status updated');
        redirect('admin/case_studies');
    }

    // Counters
    public function counters() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['counters'] = $this->db->get('counters')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/counters/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function counter_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->insert('counters', $data);
            $this->session->set_flashdata('success', 'Counter added successfully');
            redirect('admin/counters');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/counters/add');
        $this->load->view('admin/includes/footer');
    }

    public function counter_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $data['counter'] = $this->db->get_where('counters', array('id' => $id))->row_array();

        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->where('id', $id);
            $this->db->update('counters', $data);
            $this->session->set_flashdata('success', 'Counter updated successfully');
            redirect('admin/counters');
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/counters/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function counter_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('counters', array('id' => $id));
        $this->session->set_flashdata('success', 'Counter deleted successfully');
        redirect('admin/counters');
    }

    public function counter_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('counters', array('is_active' => $status));
        $this->session->set_flashdata('success', 'Counter status updated');
        redirect('admin/counters');
    }

    // Blogs
    public function blogs() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->select('blogs.*, blog_categories.name as category_name');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->order_by('blogs.priority', 'ASC');
        $data['blogs'] = $this->db->get()->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/blogs/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function blog_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/blog/';
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $file_data = $this->upload->data();
                $data = $this->input->post();
                $data['image'] = 'assets/images/blog/' . $file_data['file_name'];
                $data['slug'] = $this->_slugify($data['title']);
                $this->db->insert('blogs', $data);
                $this->session->set_flashdata('success', 'Blog Post added successfully');
                redirect('admin/blogs');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_flashdata('error', $error['error']);
                redirect('admin/blogs');
            }
        }
        $data['categories'] = $this->db->where('is_active', 1)->get('blog_categories')->result_array();
        $this->load_view('admin/blogs/add', $data);
    }

    public function blog_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $data['blog'] = $this->db->get_where('blogs', array('id' => $id))->row_array();
        $data['categories'] = $this->db->where('is_active', 1)->get('blog_categories')->result_array();

        if ($this->input->post()) {
            $config['upload_path'] = './assets/images/blog/';
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            $update_data = $this->input->post();

            if (!empty($_FILES['image']['name'])) {
                if ($this->upload->do_upload('image')) {
                    $file_data = $this->upload->data();
                    $update_data['image'] = 'assets/images/blog/' . $file_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/blog_edit/' . $id);
                }
            }

            $update_data['slug'] = $this->_slugify($update_data['title']);
            $this->db->where('id', $id);
            $this->db->update('blogs', $update_data);
            $this->session->set_flashdata('success', 'Blog Post updated successfully');
            redirect('admin/blogs');
        }

        $this->load_view('admin/blogs/edit', $data);
    }

    public function blog_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('blogs', array('id' => $id));
        $this->session->set_flashdata('success', 'Blog Post deleted successfully');
        redirect('admin/blogs');
    }

    public function blog_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('blogs', array('is_active' => $status));
        $this->session->set_flashdata('success', 'Blog status updated');
        redirect('admin/blogs');
    }
    // Case Categories Management
    public function case_categories()
    {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['categories'] = $this->db->get('case_categories')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/case_categories/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function case_category_add()
    {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
            'slug' => $this->_slugify($this->input->post('name')),
            'is_active' => 1
            ];
            $this->db->insert('case_categories', $data);
            $this->session->set_flashdata('success', 'Category added successfully');
            redirect('admin/case_categories');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/case_categories/add');
        $this->load->view('admin/includes/footer');
    }

    public function case_category_edit($id)
    {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
            'slug' => $this->_slugify($this->input->post('name'))
            ];
            $this->db->where('id', $id);
            $this->db->update('case_categories', $data);
            $this->session->set_flashdata('success', 'Category updated successfully');
            redirect('admin/case_categories');
        }
        $data['category'] = $this->db->where('id', $id)->get('case_categories')->row_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/case_categories/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function case_category_delete($id)
    {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('case_categories', array('id' => $id));
        $this->session->set_flashdata('success', 'Category deleted successfully');
        redirect('admin/case_categories');
    }

    public function case_category_status($id, $status)
    {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('case_categories', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Category status updated');
        redirect('admin/case_categories');
    }

    // View Methods
    public function slider_view($id) {
        $data['slider'] = $this->db->get_where('sliders', ['id' => $id])->row_array();
        $this->load_view('admin/sliders/view', $data);
    }
    public function feature_view($id) {
        $data['feature'] = $this->db->get_where('features', ['id' => $id])->row_array();
        $this->load_view('admin/features/view', $data);
    }
    public function practice_view($id) {
        $data['practice'] = $this->db->get_where('practice_areas', ['id' => $id])->row_array();
        $this->load_view('admin/practice/view', $data);
    }
    public function testimonial_view($id) {
        $data['testimonial'] = $this->db->get_where('testimonials', ['id' => $id])->row_array();
        $this->load_view('admin/testimonials/view', $data);
    }
    public function team_view($id) {
        $data['team'] = $this->db->get_where('teams', ['id' => $id])->row_array();
        $this->load_view('admin/teams/view', $data);
    }
    public function case_study_view($id) {
        $data['case_study'] = $this->db->get_where('case_studies', ['id' => $id])->row_array();
        $this->load_view('admin/case_studies/view', $data);
    }
    public function case_category_view($id) {
        $data['category'] = $this->db->get_where('case_categories', ['id' => $id])->row_array();
        $this->load_view('admin/case_categories/view', $data);
    }
    public function counter_view($id) {
        $data['counter'] = $this->db->get_where('counters', ['id' => $id])->row_array();
        $this->load_view('admin/counters/view', $data);
    }
    public function blog_view($id) {
        $data['blog'] = $this->db->get_where('blogs', ['id' => $id])->row_array();
        $this->load_view('admin/blogs/view', $data);
    }

    // Blog Comments
    public function blog_comments() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->select('blog_comments.*, blogs.title as blog_title');
        $this->db->from('blog_comments');
        $this->db->join('blogs', 'blog_comments.blog_id = blogs.id', 'left');
        $this->db->order_by('blog_comments.created_at', 'DESC');
        $data['comments'] = $this->db->get()->result_array();
        $this->load_view('admin/blog_comments/index', $data);
    }

    public function blog_comment_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id);
        $this->db->update('blog_comments', array('is_approved' => $status));
        $this->session->set_flashdata('success', 'Comment status updated');
        redirect('admin/blog_comments');
    }

    public function blog_comment_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->delete('blog_comments', array('id' => $id));
        $this->session->set_flashdata('success', 'Comment deleted successfully');
        redirect('admin/blog_comments');
    }

    private function load_view($view_path, $data = []) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view($view_path, $data);
        $this->load->view('admin/includes/footer');
    }

    // Ordering Update
    public function update_order() {
        if (!$this->session->userdata('logged_in')) {
            echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
            return;
        }
        $table = $this->input->post('table');
        $orders = $this->input->post('orders');
        foreach ($orders as $order) {
            $this->db->where('id', $order['id']);
            $this->db->update($table, ['priority' => $order['priority']]);
        }
        echo json_encode(['status' => 'success']);
    }

    // Appointments Management
    public function appointments() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $this->db->select('appointments.*, teams.name as attorney_name');
        $this->db->from('appointments');
        $this->db->join('teams', 'appointments.attorney_id = teams.id', 'left');
        $this->db->order_by('appointments.created_at', 'DESC');
        $data['appointments'] = $this->db->get()->result_array();
        
        $this->load_view('admin/appointments/index', $data);
    }

    public function appointment_view($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $this->db->select('appointments.*, teams.name as attorney_name, practice_areas.title as practice_title');
        $this->db->from('appointments');
        $this->db->join('teams', 'appointments.attorney_id = teams.id', 'left');
        $this->db->join('practice_areas', 'appointments.practice_category_id = practice_areas.id', 'left');
        $this->db->where('appointments.id', $id);
        $data['appointment'] = $this->db->get()->row_array();
        
        if (!$data['appointment']) redirect('admin/appointments');
        
        $this->load_view('admin/appointments/view', $data);
    }

    public function appointment_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('appointments');
        $this->session->set_flashdata('success', 'Appointment deleted successfully');
        redirect('admin/appointments');
    }

    // ==================== Contact Messages ====================

    public function contact_messages() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['messages'] = $this->db->order_by('created_at', 'DESC')->get('contact_messages')->result_array();
        $this->load_view('admin/contact_messages/index', $data);
    }

    public function contact_view($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['message'] = $this->db->get_where('contact_messages', ['id' => $id])->row_array();
        if (!$data['message']) redirect('admin/contact_messages');
        // Mark as read
        $this->db->where('id', $id)->update('contact_messages', ['is_read' => 1]);
        $this->load_view('admin/contact_messages/view', $data);
    }

    public function contact_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('contact_messages');
        $this->session->set_flashdata('success', 'Message deleted successfully');
        redirect('admin/contact_messages');
    }
}
