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

        // Check Remember Me cookie
        $remember_cookie = $this->input->cookie('remember_admin');
        if ($remember_cookie) {
            $parts = explode('|', $remember_cookie);
            if (count($parts) == 2) {
                $user = $this->db->get_where('users', ['id' => $parts[0]])->row();
                if ($user && md5($user->password . $user->username) === $parts[1]) {
                    $this->session->set_userdata([
                        'user_id' => $user->id,
                        'username' => $user->username,
                        'email' => $user->email,
                        'logged_in' => TRUE
                    ]);
                    redirect('admin/dashboard');
                }
            }
        }

        $this->load->view('admin/login');
    }

    public function login_post() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember_me');

        $user = $this->Auth_model->validate_user($username, $password);

        if ($user) {
            $session_data = array(
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'logged_in' => TRUE
            );
            $this->session->set_userdata($session_data);

            // Remember Me: set a long-lived cookie
            if ($remember) {
                $cookie = array(
                    'name'   => 'remember_admin',
                    'value'  => $user->id . '|' . md5($user->password . $user->username),
                    'expire' => 86400 * 30, // 30 days
                    'path'   => '/',
                );
                $this->input->set_cookie($cookie);
            }

            redirect('admin/dashboard');
        } else {
            $this->session->set_flashdata('error', 'Invalid Username/Email or Password');
            redirect('admin/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        // Clear remember me cookie
        $this->load->helper('cookie');
        delete_cookie('remember_admin');
        redirect('admin/login');
    }

    public function dashboard() {
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }

        // === Stat Cards ===
        $data['total_blogs'] = $this->db->count_all_results('blogs');
        $data['total_cases'] = $this->db->count_all_results('case_studies');
        $data['total_practice'] = $this->db->count_all_results('practice_areas');
        $data['total_team'] = $this->db->count_all_results('teams');
        $data['total_appointments'] = $this->db->count_all_results('appointments');
        $data['total_contacts'] = $this->db->count_all_results('contact_messages');
        $data['total_landmarks'] = $this->db->count_all_results('landmarks');
        $data['total_testimonials'] = $this->db->count_all_results('testimonials');

        // Blog comments
        $data['total_comments'] = $this->db->count_all_results('blog_comments');

        // === Payments ===
        $this->db->select_sum('consultation_fee');
        $this->db->where('payment_status', 'paid');
        $total_pay = $this->db->get('appointments')->row();
        $data['total_revenue'] = $total_pay->consultation_fee ?: 0;

        // Payments by channel
        $this->db->select('payment_method, COUNT(*) as cnt, SUM(consultation_fee) as total');
        $this->db->where('payment_status', 'paid');
        $this->db->group_by('payment_method');
        $data['payment_channels'] = $this->db->get('appointments')->result_array();

        // === Monthly data for charts (last 6 months) ===
        $months_labels = [];
        $appointments_data = [];
        $contacts_data = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = date('Y-m', strtotime("-$i months"));
            $months_labels[] = date('M Y', strtotime("-$i months"));

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $m);
            $appointments_data[] = $this->db->count_all_results('appointments');

            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $m);
            $contacts_data[] = $this->db->count_all_results('contact_messages');

            $this->db->select_sum('consultation_fee');
            $this->db->where('payment_status', 'paid');
            $this->db->where("DATE_FORMAT(created_at, '%Y-%m') =", $m);
            $rev = $this->db->get('appointments')->row();
            $revenue_data[] = $rev->consultation_fee ? (float)$rev->consultation_fee : 0;
        }
        $data['chart_labels'] = json_encode($months_labels);
        $data['chart_appointments'] = json_encode($appointments_data);
        $data['chart_contacts'] = json_encode($contacts_data);
        $data['chart_revenue'] = json_encode($revenue_data);

        // === Recent Appointments ===
        $data['recent_appointments'] = $this->db->order_by('id', 'DESC')->limit(5)->get('appointments')->result_array();

        // === Recent Contact Messages ===
        $data['recent_contacts'] = $this->db->order_by('id', 'DESC')->limit(5)->get('contact_messages')->result_array();

        // === Recent Blog Comments ===
        $data['recent_comments'] = $this->db->order_by('id', 'DESC')->limit(5)->get('blog_comments')->result_array();

        // === Recent Blogs for Slider ===
        $this->db->select('blogs.*, blog_categories.name as category_name');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->order_by('blogs.id', 'DESC');
        $this->db->limit(8);
        $data['slider_blogs'] = $this->db->get()->result_array();

        // === Recent Case Studies for Slider ===
        $this->db->select('case_studies.*, case_categories.name as category_name');
        $this->db->from('case_studies');
        $this->db->join('case_categories', 'case_studies.category_id = case_categories.id', 'left');
        $this->db->order_by('case_studies.id', 'DESC');
        $this->db->limit(8);
        $data['slider_cases'] = $this->db->get()->result_array();


        // Site views (from settings, tracking counter)
        $view_row = $this->db->get_where('settings', ['key_name' => 'site_views'])->row();
        $data['site_views'] = $view_row ? (int)$view_row->value : 0;

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/dashboard', $data);
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

            // Handle Video Upload
            if (!empty($_FILES['video_file']['name'])) {
                $v_config['upload_path']   = './assets/videos/settings/';
                $v_config['allowed_types'] = 'mp4|webm|ogg';
                $v_config['max_size']      = 20480; // 20MB
                $v_config['encrypt_name']  = TRUE;

                if (!is_dir($v_config['upload_path'])) {
                    mkdir($v_config['upload_path'], 0777, TRUE);
                }

                $this->load->library('upload', $v_config);
                $this->upload->initialize($v_config);

                if ($this->upload->do_upload('video_file')) {
                    $uploadData = $this->upload->data();
                    $data['video_file'] = 'assets/videos/settings/' . $uploadData['file_name'];
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
            $data['link'] = ($data['title'] == 'Home') ? '' : $this->_slugify($data['title']);
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
            $data['link'] = ($data['title'] == 'Home') ? '' : $this->_slugify($data['title']);
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

    public function menu_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('menus', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Menu status updated');
        redirect('admin/menus');
    }

    public function menu_footer_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('menus', ['show_in_footer' => $status]);
        $this->session->set_flashdata('success', 'Footer visibility updated');
        redirect('admin/menus');
    }

    public function practice_footer_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('practice_areas', ['show_in_footer' => $status]);
        $this->session->set_flashdata('success', 'Footer visibility updated');
        redirect('admin/practice');
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

            // Handle Video Upload
            if (!empty($_FILES['video_file']['name'])) {
                $v_config['upload_path']   = './assets/videos/about/';
                $v_config['allowed_types'] = 'mp4|webm|ogg';
                $v_config['max_size']      = 20480; // 20MB
                $v_config['encrypt_name']  = TRUE;

                if (!is_dir($v_config['upload_path'])) {
                    mkdir($v_config['upload_path'], 0777, TRUE);
                }

                $this->upload->initialize($v_config);
                if ($this->upload->do_upload('video_file')) {
                    $uploadData = $this->upload->data();
                    $data['video_file'] = 'assets/videos/about/' . $uploadData['file_name'];
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
        
        // Mark as read
        $this->db->update('subscribers', ['is_read' => 1]);

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
            $data = $this->input->post();
            $data['slug'] = $this->_slugify($data['title']);

            // Handle Image Upload
            $config['upload_path'] = './assets/images/case_studies/';
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!empty($_FILES['image']['name'])) {
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $file_data = $this->upload->data();
                    $data['image'] = 'assets/images/case_studies/' . $file_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Image Error: ' . $this->upload->display_errors());
                    redirect('admin/case_study_add');
                }
            }


            $this->db->insert('case_studies', $data);
            $this->session->set_flashdata('success', 'Case Study added successfully');
            redirect('admin/case_studies');
        }
        $data['categories'] = $this->db->where('is_active', 1)->get('case_categories')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/case_studies/add', $data);
        $this->load->view('admin/includes/footer');
    }

    public function case_study_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $case_study = $this->db->get_where('case_studies', array('id' => $id))->row_array();
        $data['case_study'] = $case_study;
        $data['categories'] = $this->db->where('is_active', 1)->get('case_categories')->result_array();

        if ($this->input->post()) {
            $update_data = $this->input->post();
            $update_data['slug'] = $this->_slugify($update_data['title']);

            // Handle Image Upload
            $config['upload_path'] = './assets/images/case_studies/';
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);

            if (!empty($_FILES['image']['name'])) {
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image')) {
                    $file_data = $this->upload->data();
                    $update_data['image'] = 'assets/images/case_studies/' . $file_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'Image Error: ' . $this->upload->display_errors());
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

    // Mark single notification as read and redirect
    public function mark_read($type, $id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if ($type === 'appointment') {
            $this->db->where('id', $id)->update('appointments', ['is_read' => 1]);
            redirect('admin/appointment_view/'.$id);
        } elseif ($type === 'contact') {
            $this->db->where('id', $id)->update('contact_messages', ['is_read' => 1]);
            redirect('admin/contact_view/'.$id);
        } elseif ($type === 'subscriber') {
            $this->db->where('id', $id)->update('subscribers', ['is_read' => 1]);
            redirect('admin/subscribers');
        } else {
            redirect('admin/dashboard');
        }
    }

    // AJAX Endpoint for real-time notifications
    public function ajax_get_notifications() {
        if (!$this->session->userdata('logged_in')) return;
        
        $count_appointments = $this->db->where('is_read', 0)->count_all_results('appointments');
        $count_contacts = $this->db->where('is_read', 0)->count_all_results('contact_messages');
        $count_subscribers = $this->db->where('is_read', 0)->count_all_results('subscribers');
        $total_notifications = $count_appointments + $count_contacts + $count_subscribers;

        $pending_appointments = $this->db->where('is_read', 0)->order_by('created_at', 'DESC')->limit(5)->get('appointments')->result_array();
        $recent_contacts = $this->db->where('is_read', 0)->order_by('created_at', 'DESC')->limit(5)->get('contact_messages')->result_array();
        $recent_subscribers = $this->db->where('is_read', 0)->order_by('id', 'DESC')->limit(5)->get('subscribers')->result_array();
        
        $notif_list = [];
        foreach($pending_appointments as $a) {
            $notif_list[] = [
                'title' => 'New Appointment',
                'msg' => $a['name'] . ' booked an appointment.',
                'link' => site_url('admin/mark_read/appointment/'.$a['id']),
                'icon' => 'fa-calendar',
                'color' => '#3498db',
                'time' => $a['created_at']
            ];
        }
        foreach($recent_contacts as $c) {
            $notif_list[] = [
                'title' => 'New Message',
                'msg' => 'Message from ' . $c['name'],
                'link' => site_url('admin/mark_read/contact/'.$c['id']),
                'icon' => 'fa-envelope',
                'color' => '#2ecc71',
                'time' => $c['created_at']
            ];
        }
        foreach($recent_subscribers as $s) {
            $notif_list[] = [
                'title' => 'New Subscriber',
                'msg' => $s['email'] . ' subscribed.',
                'link' => site_url('admin/mark_read/subscriber/'.$s['id']),
                'icon' => 'fa-users',
                'color' => '#f39c12',
                'time' => isset($s['created_at']) ? $s['created_at'] : date('Y-m-d H:i:s')
            ];
        }

        usort($notif_list, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        $notif_list = array_slice($notif_list, 0, 7);

        $html = '<li style="padding: 10px 15px; background: #fafafa; border-bottom: 1px solid #eee; font-weight: bold; border-radius: 8px 8px 0 0; display:flex; justify-content:space-between; align-items:center;">
                    Notifications <span class="badge badge-primary">'.$total_notifications.' unread</span>
                </li>
                <div style="max-height: 300px; overflow-y: auto;">';
                
        if(count($notif_list) > 0) {
            foreach($notif_list as $n) {
                $time_str = date('d M, h:i A', strtotime($n['time']));
                $html .= '<li>
                            <a href="'.$n['link'].'" style="padding: 10px 15px; display: flex; align-items: flex-start; gap: 10px; border-bottom: 1px solid #eee; color: #333; text-decoration: none;">
                                <div style="width: 35px; height: 35px; border-radius: 50%; background: '.$n['color'].'20; color: '.$n['color'].'; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa '.$n['icon'].'"></i>
                                </div>
                                <div style="flex-grow: 1; overflow: hidden;">
                                    <h6 style="margin: 0; font-size: 13px; font-weight: 600;">'.$n['title'].'</h6>
                                    <p style="margin: 0; font-size: 12px; color: #777; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal;">'.$n['msg'].'</p>
                                    <small style="font-size: 10px; color: #aaa;">'.$time_str.'</small>
                                </div>
                            </a>
                        </li>';
            }
        } else {
            $html .= '<li style="padding: 20px; text-align: center; color: #aaa; font-size: 13px;">No new notifications</li>';
        }
        $html .= '</div>';

        echo json_encode([
            'total' => $total_notifications,
            'appointments' => $count_appointments,
            'contacts' => $count_contacts,
            'subscribers' => $count_subscribers,
            'html' => $html
        ]);
    }

    // Appointments Management
    public function appointments() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        // Mark as read
        $this->db->update('appointments', ['is_read' => 1]);

        $this->db->select('appointments.*, teams.name as attorney_name, practice_areas.title as practice_title');
        $this->db->from('appointments');
        $this->db->join('teams', 'appointments.attorney_id = teams.id', 'left');
        $this->db->join('practice_areas', 'appointments.practice_category_id = practice_areas.id', 'left');
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
        
        // Mark as read
        $this->db->update('contact_messages', ['is_read' => 1]);

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

    // ==================== Landmark Management ====================

    public function landmarks() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['landmarks'] = $this->db->order_by('id', 'DESC')->get('landmarks')->result_array();
        $this->load_view('admin/landmarks/index', $data);
    }

    public function landmark_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if ($this->input->post()) {
            $data = $this->input->post();
            
            // Handle PDF Upload
            if (!empty($_FILES['pdf']['name'])) {
                $config['upload_path'] = './assets/pdfs/landmarks/';
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, true);
                }
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('pdf')) {
                    $pdf_data = $this->upload->data();
                    $data['pdf'] = 'assets/pdfs/landmarks/' . $pdf_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'PDF Error: ' . $this->upload->display_errors());
                    redirect('admin/landmark_add');
                }
            }

            $this->db->insert('landmarks', $data);
            $this->session->set_flashdata('success', 'Landmark added successfully');
            redirect('admin/landmarks');
        }
        $this->load_view('admin/landmarks/add');
    }

    public function landmark_bulk_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if (!empty($_FILES['pdfs']['name'][0])) {
            $count = count($_FILES['pdfs']['name']);
            $titles = $this->input->post('titles');
            $success_count = 0;
            $error_count = 0;

            $config['upload_path'] = './assets/pdfs/landmarks/';
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }
            $config['allowed_types'] = 'pdf';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);

            for ($i = 0; $i < $count; $i++) {
                $_FILES['pdf']['name'] = $_FILES['pdfs']['name'][$i];
                $_FILES['pdf']['type'] = $_FILES['pdfs']['type'][$i];
                $_FILES['pdf']['tmp_name'] = $_FILES['pdfs']['tmp_name'][$i];
                $_FILES['pdf']['error'] = $_FILES['pdfs']['error'][$i];
                $_FILES['pdf']['size'] = $_FILES['pdfs']['size'][$i];

                $this->upload->initialize($config);
                if ($this->upload->do_upload('pdf')) {
                    $pdf_data = $this->upload->data();
                    
                    // Use custom title if provided, otherwise filename
                    $title = (!empty($titles[$i])) ? $titles[$i] : pathinfo($_FILES['pdf']['name'], PATHINFO_FILENAME);
                    
                    $insert_data = [
                        'title' => $title,
                        'pdf' => 'assets/pdfs/landmarks/' . $pdf_data['file_name'],
                        'is_active' => 1
                    ];
                    $this->db->insert('landmarks', $insert_data);
                    $success_count++;
                } else {
                    $error_count++;
                }
            }

            $this->session->set_flashdata('success', "$success_count PDFs uploaded successfully. " . ($error_count > 0 ? "$error_count failed." : ""));
            redirect('admin/landmarks');
        } else {
            $this->session->set_flashdata('error', 'Please select at least one PDF file.');
            redirect('admin/landmark_add');
        }
    }

    public function landmark_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        if ($this->input->post()) {
            $update_data = $this->input->post();

            if (!empty($_FILES['pdf']['name'])) {
                $config['upload_path'] = './assets/pdfs/landmarks/';
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, true);
                }
                $config['allowed_types'] = 'pdf';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('pdf')) {
                    $pdf_data = $this->upload->data();
                    $update_data['pdf'] = 'assets/pdfs/landmarks/' . $pdf_data['file_name'];
                } else {
                    $this->session->set_flashdata('error', 'PDF Error: ' . $this->upload->display_errors());
                    redirect('admin/landmark_edit/' . $id);
                }
            }

            $this->db->where('id', $id)->update('landmarks', $update_data);
            $this->session->set_flashdata('success', 'Landmark updated successfully');
            redirect('admin/landmarks');
        }

        $data['landmark'] = $this->db->get_where('landmarks', ['id' => $id])->row_array();
        if (!$data['landmark']) redirect('admin/landmarks');
        $this->load_view('admin/landmarks/edit', $data);
    }

    public function landmark_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('landmarks');
        $this->session->set_flashdata('success', 'Landmark deleted successfully');
        redirect('admin/landmarks');
    }

    public function landmark_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('landmarks', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Status updated successfully');
        redirect('admin/landmarks');
    }

    // Custom Pages Management
    public function pages() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['pages'] = $this->db->order_by('priority', 'ASC')->get('pages')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/pages/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function page_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            // Generate slug if empty
            if (empty($data['slug'])) {
                $data['slug'] = strtolower(url_title($data['title']));
            }
            $this->db->insert('pages', $data);
            $this->session->set_flashdata('success', 'Page created successfully');
            redirect('admin/pages');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/pages/add');
        $this->load->view('admin/includes/footer');
    }

    public function page_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            // Update slug if empty
            if (empty($data['slug'])) {
                $data['slug'] = strtolower(url_title($data['title']));
            }
            $this->db->where('id', $id)->update('pages', $data);
            $this->session->set_flashdata('success', 'Page updated successfully');
            redirect('admin/pages');
        }
        $data['page'] = $this->db->get_where('pages', ['id' => $id])->row_array();
        if (!$data['page']) redirect('admin/pages');
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/pages/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function page_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('pages', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Page status updated');
        redirect('admin/pages');
    }

    public function page_header_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('pages', ['show_in_header' => $status]);
        $this->session->set_flashdata('success', 'Header visibility updated');
        redirect('admin/pages');
    }

    public function page_footer_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('pages', ['show_in_footer' => $status]);
        $this->session->set_flashdata('success', 'Footer visibility updated');
        redirect('admin/pages');
    }

    public function page_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('pages');
        $this->session->set_flashdata('success', 'Page deleted successfully');
        redirect('admin/pages');
    }

    // ========== SEO Settings ==========
    public function seo_settings() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        // Load all SEO settings from DB
        $seo_rows = $this->db->like('key_name', 'seo_', 'after')->get('settings')->result_array();
        $data['seo'] = [];
        foreach ($seo_rows as $row) {
            $data['seo'][$row['key_name']] = $row['value'];
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/seo_settings', $data);
        $this->load->view('admin/includes/footer');
    }

    public function seo_settings_save() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $fields = [
            'seo_meta_title', 'seo_meta_description', 'seo_meta_keywords',
            'seo_canonical_url', 'seo_og_title', 'seo_og_description',
            'seo_fb_app_id', 'seo_twitter_handle',
            'seo_schema_name', 'seo_schema_type', 'seo_schema_phone',
            'seo_schema_address', 'seo_schema_city', 'seo_schema_state', 'seo_schema_country',
            'seo_robots', 'seo_google_verification', 'seo_bing_verification',
            'seo_google_analytics', 'seo_gtm_id', 'seo_fb_pixel',
            'seo_custom_head', 'seo_custom_footer'
        ];

        foreach ($fields as $field) {
            $value = $this->input->post($field) ?? '';
            $this->db->replace('settings', ['key_name' => $field, 'value' => $value]);
        }

        // Handle OG Image upload
        if (!empty($_FILES['seo_og_image']['name'])) {
            $config['upload_path'] = './uploads/seo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
            $config['max_size'] = 2048;
            $config['file_name'] = 'og_image_' . time();
            
            if (!is_dir('./uploads/seo/')) {
                mkdir('./uploads/seo/', 0755, true);
            }
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('seo_og_image')) {
                $upload_data = $this->upload->data();
                $og_path = 'uploads/seo/' . $upload_data['file_name'];
                $this->db->replace('settings', ['key_name' => 'seo_og_image', 'value' => $og_path]);
            }
        }

        $this->session->set_flashdata('success', 'SEO Settings saved successfully!');
        redirect('admin/seo_settings');
    }

    // ========== Admin Profile ==========
    public function admin_profile() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $user_id = $this->session->userdata('user_id');
        $data['admin_user'] = $this->db->get_where('users', ['id' => $user_id])->row();
        
        // Load settings for logo display
        $settings_db = $this->db->get('settings')->result_array();
        $data['settings'] = [];
        foreach ($settings_db as $s) {
            $data['settings'][$s['key_name']] = $s['value'];
        }

        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar', $data);
        $this->load->view('admin/admin_profile', $data);
        $this->load->view('admin/includes/footer');
    }

    public function update_profile() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $user_id = $this->session->userdata('user_id');
        $username = $this->input->post('username');
        $email = $this->input->post('email');

        $this->db->where('id', $user_id)->update('users', [
            'username' => $username,
            'email' => $email
        ]);

        // Update session
        $this->session->set_userdata('username', $username);
        $this->session->set_userdata('email', $email);

        $this->session->set_flashdata('success', 'Profile updated successfully!');
        redirect('admin/admin_profile');
    }

    public function change_password() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        $user_id = $this->session->userdata('user_id');
        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        // Verify current password
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        if (!$user || $user->password !== $current_password) {
            $this->session->set_flashdata('error', 'Current password is incorrect!');
            redirect('admin/admin_profile');
            return;
        }

        // Validate new password
        if (strlen($new_password) < 6) {
            $this->session->set_flashdata('error', 'New password must be at least 6 characters!');
            redirect('admin/admin_profile');
            return;
        }

        if ($new_password !== $confirm_password) {
            $this->session->set_flashdata('error', 'New password and confirm password do not match!');
            redirect('admin/admin_profile');
            return;
        }

        // Update password
        $this->db->where('id', $user_id)->update('users', ['password' => $new_password]);
        $this->session->set_flashdata('success', 'Password changed successfully!');
        redirect('admin/admin_profile');
    }

    public function update_logo() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');

        if (!empty($_FILES['site_logo']['name'])) {
            $config['upload_path'] = './assets/images/logo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|svg|webp';
            $config['max_size'] = 2048;
            $config['file_name'] = 'logo-2';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('site_logo')) {
                $upload_data = $this->upload->data();
                $logo_path = 'assets/images/logo/' . $upload_data['file_name'];
                $this->db->replace('settings', ['key_name' => 'site_logo', 'value' => $logo_path]);
                $this->session->set_flashdata('success', 'Logo updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Upload failed: ' . $this->upload->display_errors('', ''));
            }
        } else {
            $this->session->set_flashdata('error', 'Please select a logo file!');
        }
        redirect('admin/admin_profile');
    }

    public function update_favicon() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');

        if (!empty($_FILES['favicon']['name'])) {
            $config['upload_path'] = './assets/images/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|ico';
            $config['max_size'] = 512;
            $config['file_name'] = 'icon.png';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('favicon')) {
                $this->session->set_flashdata('success', 'Favicon updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Upload failed: ' . $this->upload->display_errors('', ''));
            }
        } else {
            $this->session->set_flashdata('error', 'Please select a favicon file!');
        }
        redirect('admin/admin_profile');
    }

    public function update_admin_logo() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');

        if (!empty($_FILES['admin_logo']['name'])) {
            $config['upload_path'] = './assets/images/logo/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|svg|webp';
            $config['max_size'] = 2048;
            $config['file_name'] = 'admin_logo_' . time();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('admin_logo')) {
                $upload_data = $this->upload->data();
                $logo_path = 'assets/images/logo/' . $upload_data['file_name'];
                $this->db->replace('settings', ['key_name' => 'admin_logo', 'value' => $logo_path]);
                $this->session->set_flashdata('success', 'Admin Panel logo updated successfully!');
            } else {
                $this->session->set_flashdata('error', 'Upload failed: ' . $this->upload->display_errors('', ''));
            }
        } else {
            $this->session->set_flashdata('error', 'Please select a logo file!');
        }
        redirect('admin/admin_profile');
    }

    // Video Gallery
    public function gallery() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $data['videos'] = $this->db->order_by('priority', 'ASC')->get('video_gallery')->result_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/gallery/index', $data);
        $this->load->view('admin/includes/footer');
    }

    public function gallery_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'priority' => (int)$this->input->post('priority'),
                'is_active' => (int)$this->input->post('is_active'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path'] = './assets/videos/gallery/';
                $config['allowed_types'] = 'mp4|webm|ogg';
                $config['max_size'] = 51200; // 50MB
                $config['encrypt_name'] = TRUE;

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                // Handle Thumbnail Upload
                if (!empty($_FILES['thumbnail']['name'])) {
                    $thumb_config['upload_path'] = './assets/videos/gallery/thumbnails/';
                    $thumb_config['allowed_types'] = 'jpg|jpeg|png|webp';
                    $thumb_config['encrypt_name'] = TRUE;
                    if (!is_dir($thumb_config['upload_path'])) mkdir($thumb_config['upload_path'], 0777, TRUE);
                    
                    $this->load->library('upload', $thumb_config, 'thumb_upload');
                    if ($this->thumb_upload->do_upload('thumbnail')) {
                        $thumbData = $this->thumb_upload->data();
                        $data['thumbnail'] = 'assets/videos/gallery/thumbnails/' . $thumbData['file_name'];
                    }
                }

                // Handle Captured Thumbnail (Base64)
                if (!empty($this->input->post('captured_thumb'))) {
                    $base64_string = $this->input->post('captured_thumb');
                    $data_parts = explode(',', $base64_string);
                    if (count($data_parts) > 1) {
                        $image_data = base64_decode($data_parts[1]);
                        $path = './assets/videos/gallery/thumbnails/';
                        if (!is_dir($path)) mkdir($path, 0777, TRUE);
                        
                        $filename = 'thumb_' . time() . '_' . uniqid() . '.jpg';
                        file_put_contents($path . $filename, $image_data);
                        $data['thumbnail'] = 'assets/videos/gallery/thumbnails/' . $filename;
                    }
                    unset($data['captured_thumb']);
                }

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('video')) {
                    $uploadData = $this->upload->data();
                    $data['video_path'] = 'assets/videos/gallery/' . $uploadData['file_name'];
                    
                    $this->db->insert('video_gallery', $data);
                    $this->session->set_flashdata('success', 'Video added to gallery successfully');
                    redirect('admin/gallery');
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                }
            } else {
                $this->session->set_flashdata('error', 'Please select a video file');
            }
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/gallery/add');
        $this->load->view('admin/includes/footer');
    }

    public function gallery_bulk_add() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post('submit')) {
            $titles = $this->input->post('title');
            $descriptions = $this->input->post('description');
            $priorities = $this->input->post('priority');
            
            $count = count($titles);
            $success_count = 0;
            
            $this->load->library('upload');
            
            for ($i = 0; $i < $count; $i++) {
                if (!empty($_FILES['video']['name'][$i])) {
                    $_FILES['temp_video']['name'] = $_FILES['video']['name'][$i];
                    $_FILES['temp_video']['type'] = $_FILES['video']['type'][$i];
                    $_FILES['temp_video']['tmp_name'] = $_FILES['video']['tmp_name'][$i];
                    $_FILES['temp_video']['error'] = $_FILES['video']['error'][$i];
                    $_FILES['temp_video']['size'] = $_FILES['video']['size'][$i];
                    
                    $config['upload_path'] = './assets/videos/gallery/';
                    $config['allowed_types'] = 'mp4|webm|ogg';
                    $config['encrypt_name'] = TRUE;
                    if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                    
                    $this->upload->initialize($config);
                    
                    if ($this->upload->do_upload('temp_video')) {
                        $uploadData = $this->upload->data();
                        $data = [
                            'title' => $titles[$i],
                            'description' => $descriptions[$i],
                            'priority' => (int)$priorities[$i],
                            'video_path' => 'assets/videos/gallery/' . $uploadData['file_name'],
                            'is_active' => 1,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('video_gallery', $data);
                        $success_count++;
                    }
                }
            }
            $this->session->set_flashdata('success', $success_count . ' videos uploaded successfully');
            redirect('admin/gallery');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/gallery/bulk_add');
        $this->load->view('admin/includes/footer');
    }

    public function gallery_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'priority' => (int)$this->input->post('priority'),
                'is_active' => (int)$this->input->post('is_active'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            if (!empty($_FILES['video']['name'])) {
                $config['upload_path'] = './assets/videos/gallery/';
                $config['allowed_types'] = 'mp4|webm|ogg';
                $config['max_size'] = 51200;
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('video')) {
                    $uploadData = $this->upload->data();
                    $data['video_path'] = 'assets/videos/gallery/' . $uploadData['file_name'];
                }
            }

            // Handle Thumbnail Upload
            if (!empty($_FILES['thumbnail']['name'])) {
                $thumb_config['upload_path'] = './assets/videos/gallery/thumbnails/';
                $thumb_config['allowed_types'] = 'jpg|jpeg|png|webp';
                $thumb_config['encrypt_name'] = TRUE;
                if (!is_dir($thumb_config['upload_path'])) mkdir($thumb_config['upload_path'], 0777, TRUE);
                
                $this->load->library('upload', $thumb_config, 'thumb_upload');
                if ($this->thumb_upload->do_upload('thumbnail')) {
                    $thumbData = $this->thumb_upload->data();
                    $data['thumbnail'] = 'assets/videos/gallery/thumbnails/' . $thumbData['file_name'];
                }
            }

            // Handle Captured Thumbnail (Base64)
            if (!empty($this->input->post('captured_thumb'))) {
                $base64_string = $this->input->post('captured_thumb');
                $data_parts = explode(',', $base64_string);
                if (count($data_parts) > 1) {
                    $image_data = base64_decode($data_parts[1]);
                    $path = './assets/videos/gallery/thumbnails/';
                    if (!is_dir($path)) mkdir($path, 0777, TRUE);
                    
                    $filename = 'thumb_' . time() . '_' . uniqid() . '.jpg';
                    file_put_contents($path . $filename, $image_data);
                    $data['thumbnail'] = 'assets/videos/gallery/thumbnails/' . $filename;
                }
                unset($data['captured_thumb']); // Don't save raw base64 to DB
            }

            $this->db->where('id', $id)->update('video_gallery', $data);
            $this->session->set_flashdata('success', 'Video updated successfully');
            redirect('admin/gallery');
        }
        $data['video'] = $this->db->get_where('video_gallery', ['id' => $id])->row_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/gallery/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function gallery_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('video_gallery');
        $this->session->set_flashdata('success', 'Video deleted successfully');
        redirect('admin/gallery');
    }

    public function gallery_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('video_gallery', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Video status updated');
        redirect('admin/gallery');
    }

    // Home Action Cards (Features)
    public function features() {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        
        // Auto-migrate if column missing
        if (!$this->db->field_exists('link', 'features')) {
            $this->load->dbforge();
            $fields = array('link' => array('type' => 'VARCHAR', 'constraint' => '255', 'default' => '#', 'after' => 'title'));
            $this->dbforge->add_column('features', $fields);
        }

        $data['features'] = $this->db->order_by('priority', 'ASC')->get('features')->result_array();
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
            $this->session->set_flashdata('success', 'Action Card added successfully');
            redirect('admin/features');
        }
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/features/add');
        $this->load->view('admin/includes/footer');
    }

    public function feature_edit($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        if ($this->input->post()) {
            $data = $this->input->post();
            $this->db->where('id', $id)->update('features', $data);
            $this->session->set_flashdata('success', 'Action Card updated successfully');
            redirect('admin/features');
        }
        $data['feature'] = $this->db->get_where('features', ['id' => $id])->row_array();
        $this->load->view('admin/includes/header');
        $this->load->view('admin/includes/sidebar');
        $this->load->view('admin/features/edit', $data);
        $this->load->view('admin/includes/footer');
    }

    public function feature_delete($id) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->delete('features');
        $this->session->set_flashdata('success', 'Action Card deleted successfully');
        redirect('admin/features');
    }

    public function feature_status($id, $status) {
        if (!$this->session->userdata('logged_in')) redirect('admin/login');
        $this->db->where('id', $id)->update('features', ['is_active' => $status]);
        $this->session->set_flashdata('success', 'Status updated');
        redirect('admin/features');
    }
}
