<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
    }

    private function _get_settings() {
        $settings_db = $this->db->get('settings')->result_array();
        $settings = [];
        foreach ($settings_db as $s) {
            $settings[$s['key_name']] = $s['value'];
        }

        // Format Video URL for YouTube support
        if (!empty($settings['video_url'])) {
            $settings['video_url'] = $this->_format_youtube_url($settings['video_url']);
        }

        // Fetch Menus
        $settings['menus'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('menus')->result_array();
        
        // Fetch Practice Areas for footer
        $settings['footer_practice'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->limit(5)->get('practice_areas')->result_array();

        // Fetch Social Links
        $settings['social_links'] = $this->db->order_by('priority', 'ASC')->get('social_links')->result_array();

        return $settings;
    }

    private function _format_youtube_url($url) {
        if (!$url) return '';
        
        $youtube_id = '';
        
        // Match standard watch URL or embed URL or short URL
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $url, $match)) {
            $youtube_id = $match[1];
        }
        
        if ($youtube_id) {
            return 'https://www.youtube.com/embed/' . $youtube_id . '?autoplay=1';
        }
        
        return $url;
    }

	public function index()
	{
        // Fetch Settings
        $data['settings'] = $this->_get_settings();

        // Fetch other sections
        $data['sliders'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('sliders')->result_array();
        $data['features'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('features')->result_array();
        $data['practice'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('practice_areas')->result_array();
        $data['practice_areas'] = $data['practice']; // alias for the consultation form dropdown
        $data['testimonials'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('testimonials')->result_array();
        $data['teams'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('teams')->result_array();
        $data['case_studies'] = $this->db->select('case_studies.*, case_categories.slug as category_slug, case_categories.name as category_name')
            ->from('case_studies')
            ->join('case_categories', 'case_studies.category_id = case_categories.id', 'left')
            ->where('case_studies.is_active', 1)
            ->order_by('case_studies.priority', 'ASC')
            ->get()->result_array();
        $data['case_categories'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('case_categories')->result_array();
        $data['counters'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('counters')->result_array();
        $data['blogs'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('blogs')->result_array();

		$this->load->view('includes/header', $data); // Pass data to header if needed (e.g. site title)
		$this->load->view('home', $data);
		$this->load->view('includes/footer', $data); // Pass data to footer if needed
	}

	public function about()
	{
        $data['settings'] = $this->_get_settings();
        $data['about'] = $this->db->get_where('about_us', ['id' => 1])->row_array();
        $data['about_features'] = $this->db->order_by('priority', 'ASC')->get('about_features')->result_array();

		$this->load->view('includes/header', $data);
		$this->load->view('about', $data);
		$this->load->view('includes/footer', $data);
	}

	public function practice($slug = null)
	{
        $data['settings'] = $this->_get_settings();
        
        // Fetch all active practice areas for the sidebar/list
        $data['all_practices'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('practice_areas')->result_array();

        if ($slug) {
            // Fetch specific practice area by slug
            $data['practice'] = $this->db->get_where('practice_areas', ['slug' => $slug, 'is_active' => 1])->row_array();
            if (empty($data['practice'])) redirect('practice');
        } else {
            // Default to the first practice area if no slug is provided
            if (!empty($data['all_practices'])) {
                $data['practice'] = $data['all_practices'][0];
            } else {
                $data['practice'] = null;
            }
        }

        // If AJAX request, return only the content partial
        if ($this->input->is_ajax_request()) {
            $this->load->view('practice_content_partial', $data);
            return;
        }

        // Fetch teams for the "Qualified Attorneys" section
        $data['teams'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('teams')->result_array();

		$this->load->view('includes/header', $data);
		$this->load->view('practice', $data);
		$this->load->view('includes/footer', $data);
	}

    public function attorney($slug)
    {
        $data['settings'] = $this->_get_settings();
        $data['attorney'] = $this->db->get_where('teams', ['slug' => $slug, 'is_active' => 1])->row_array();
        
        if (empty($data['attorney'])) {
            // Try ID if slug fails (for older links)
            if (is_numeric($slug)) {
                $data['attorney'] = $this->db->get_where('teams', ['id' => $slug, 'is_active' => 1])->row_array();
            }
            if (empty($data['attorney'])) redirect('/');
        }

        $this->load->view('includes/header', $data);
        $this->load->view('attorneys_single', $data);
        $this->load->view('includes/footer', $data);
    }

	public function case_studies()
	{
        $data['settings'] = $this->_get_settings();
        
        // Fetch all case studies with category info
        $this->db->select('case_studies.*, case_categories.name as category_name, case_categories.slug as category_slug');
        $this->db->from('case_studies');
        $this->db->join('case_categories', 'case_studies.category_id = case_categories.id', 'left');
        $this->db->where('case_studies.is_active', 1);
        $this->db->order_by('case_studies.id', 'DESC');
        $data['case_studies'] = $this->db->get()->result_array();

        // Fetch categories for filtering
        $data['categories'] = $this->db->where('is_active', 1)->get('case_categories')->result_array();

		$this->load->view('includes/header', $data);
		$this->load->view('case_studies', $data);
		$this->load->view('includes/footer', $data);
	}

	public function case_studies_details($slug)
	{
        $data['settings'] = $this->_get_settings();
		// Fetch specific case study with category name
        $this->db->select('case_studies.*, case_categories.name as category_name, case_categories.slug as category_slug');
        $this->db->from('case_studies');
        $this->db->join('case_categories', 'case_studies.category_id = case_categories.id', 'left');
        $this->db->where('case_studies.slug', $slug);
        $data['case_study'] = $this->db->get()->row_array();

        if (empty($data['case_study'])) {
            redirect('welcome');
        }

        // Fetch all categories for sidebar
        $data['categories'] = $this->db->where('is_active', 1)->get('case_categories')->result_array();

        // Fetch recent cases for sidebar
        $data['recent_cases'] = $this->db->select('case_studies.*, case_categories.name as category_name')
            ->from('case_studies')
            ->join('case_categories', 'case_studies.category_id = case_categories.id', 'left')
            ->where('case_studies.is_active', 1)
            ->order_by('case_studies.id', 'DESC')
            ->limit(3)
            ->get()->result_array();

        // Fetch related cases (same category, exclude current)
        $data['related_cases'] = $this->db->select('case_studies.*, case_categories.name as category_name')
            ->from('case_studies')
            ->join('case_categories', 'case_studies.category_id = case_categories.id', 'left')
            ->where('case_studies.is_active', 1)
            ->where('case_studies.category_id', $data['case_study']['category_id'])
            ->where('case_studies.id !=', $data['case_study']['id'])
            ->limit(2)
            ->get()->result_array();

		$this->load->view('includes/header', $data);
		$this->load->view('case_studies_details', $data);
		$this->load->view('includes/footer', $data);
	}

	public function blog()
	{
        $data['settings'] = $this->_get_settings();
        
        // Fetch all blogs with categories
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->where('blogs.is_active', 1);
        $this->db->order_by('blogs.priority', 'ASC');
        $data['blogs'] = $this->db->get()->result_array();

        // Sidebar data
        $data['categories'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('blog_categories')->result_array();
        $data['recent_cases'] = $this->db->limit(3)->order_by('id', 'DESC')->get('case_studies')->result_array();
        $data['all_tags'] = $this->_get_all_tags();

		$this->load->view('includes/header', $data);
		$this->load->view('blog', $data);
		$this->load->view('includes/footer', $data);
	}

	public function blog_category($slug = null)
	{
        if (!$slug) redirect('blog');

        $data['settings'] = $this->_get_settings();
        
        // Fetch blogs in this category
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->where('blog_categories.slug', $slug);
        $this->db->where('blogs.is_active', 1);
        $this->db->order_by('blogs.priority', 'ASC');
        $data['blogs'] = $this->db->get()->result_array();

        // Sidebar data
        $data['categories'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('blog_categories')->result_array();
        $data['recent_cases'] = $this->db->limit(3)->order_by('id', 'DESC')->get('case_studies')->result_array();
        $data['all_tags'] = $this->_get_all_tags();

		$this->load->view('includes/header', $data);
		$this->load->view('blog', $data);
		$this->load->view('includes/footer', $data);
	}

    public function blog_detail($slug = null)
    {
        if (!$slug) redirect('blog');

        $data['settings'] = $this->_get_settings();
        
        // Fetch specific blog with category
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->where('blogs.slug', $slug);
        $data['blog'] = $this->db->get()->row_array();

        if (empty($data['blog'])) {
            redirect('blog');
        }

        // Fetch comments
        $blog_id = $data['blog']['id'];
        $user_session_id = $this->session->userdata('session_id') ?? session_id();
        
        // Get all approved comments + unapproved comments from this session
        $this->db->group_start()
                 ->where('is_approved', 1)
                 ->or_where('session_id', $user_session_id)
                 ->group_end();
        $this->db->where('blog_id', $blog_id);
        $this->db->order_by('created_at', 'ASC');
        $all_comments = $this->db->get('blog_comments')->result_array();
        
        $data['comments'] = $this->_build_comment_tree($all_comments);
        $data['comment_count'] = count(array_filter($all_comments, function($c) { return $c['is_approved'] == 1; }));

        // Sidebar data
        $data['categories'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('blog_categories')->result_array();
        $data['recent_blogs'] = $this->db->where('id !=', $data['blog']['id'])->limit(3)->order_by('id', 'DESC')->get('blogs')->result_array();
        
        // Global tags for the widget
        $data['all_tags'] = $this->_get_all_tags();

        $this->load->view('includes/header', $data);
        $this->load->view('blog_detail', $data);
        $this->load->view('includes/footer', $data);
    }

    public function blog_search()
    {
        $keyword = $this->input->get('keyword');
        if (!$keyword) redirect('blog');

        $data['settings'] = $this->_get_settings();
        $data['search_keyword'] = $keyword;
        
        // Fetch blogs matching keyword
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->group_start();
        $this->db->like('blogs.title', $keyword);
        $this->db->or_like('blogs.description', $keyword);
        $this->db->group_end();
        $this->db->where('blogs.is_active', 1);
        $this->db->order_by('blogs.priority', 'ASC');
        $data['blogs'] = $this->db->get()->result_array();

        // Sidebar data
        $data['categories'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('blog_categories')->result_array();
        $data['recent_cases'] = $this->db->limit(3)->order_by('id', 'DESC')->get('case_studies')->result_array();
        $data['all_tags'] = $this->_get_all_tags();

        $this->load->view('includes/header', $data);
        $this->load->view('blog', $data);
        $this->load->view('includes/footer', $data);
    }

    public function blog_tag($tag = null)
    {
        if (!$tag) redirect('blog');
        $tag = urldecode($tag);

        $data['settings'] = $this->_get_settings();
        $data['filter_tag'] = $tag;
        
        // Fetch blogs matching tag
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->like('blogs.tags', $tag);
        $this->db->where('blogs.is_active', 1);
        $this->db->order_by('blogs.priority', 'ASC');
        $data['blogs'] = $this->db->get()->result_array();

        // Sidebar data
        $data['categories'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('blog_categories')->result_array();
        $data['recent_cases'] = $this->db->limit(3)->order_by('id', 'DESC')->get('case_studies')->result_array();
        $data['all_tags'] = $this->_get_all_tags();

        $this->load->view('includes/header', $data);
        $this->load->view('blog', $data);
        $this->load->view('includes/footer', $data);
    }

    private function _get_all_tags() {
        $this->db->select('tags');
        $this->db->where('is_active', 1);
        $blogs = $this->db->get('blogs')->result_array();
        
        $all_tags = [];
        foreach($blogs as $b) {
            if(!empty($b['tags'])) {
                $tags = explode(',', $b['tags']);
                foreach($tags as $t) {
                    $trimmed = trim($t);
                    if(!empty($trimmed)) {
                        $all_tags[] = $trimmed;
                    }
                }
            }
        }
        
        $unique_tags = array_unique($all_tags);
        sort($unique_tags);
        return $unique_tags;
    }

    private function _build_comment_tree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->_build_comment_tree($elements, $element['id']);
                if ($children) {
                    $element['replies'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function add_blog_comment() {
        if ($this->input->post()) {
            $data = [
                'blog_id' => $this->input->post('blog_id'),
                'parent_id' => $this->input->post('parent_id') ?? 0,
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'website' => $this->input->post('website'),
                'comment' => $this->input->post('comment'),
                'session_id' => $this->session->userdata('session_id') ?? session_id(),
                'is_approved' => 0
            ];
            
            if ($this->db->insert('blog_comments', $data)) {
                echo json_encode(['status' => 'success', 'message' => 'Your comment has been submitted and is waiting for approval.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to submit comment. Please try again.']);
            }
        }
    }

	public function contact()
	{
        $data['settings'] = $this->_get_settings();
		$this->load->view('includes/header', $data);
		$this->load->view('contact', $data);
		$this->load->view('includes/footer', $data);
	}

    public function contact_submit()
    {
        if (!$this->input->is_ajax_request()) {
            redirect('contact');
        }

        $name    = trim($this->input->post('name'));
        $email   = trim($this->input->post('email'));
        $phone   = trim($this->input->post('phone'));
        $address = trim($this->input->post('address'));
        $message = trim($this->input->post('message'));

        if (empty($name) || empty($email) || empty($message)) {
            echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields.']);
            return;
        }

        $this->db->insert('contact_messages', [
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'address' => $address,
            'message' => $message,
        ]);

        echo json_encode(['status' => 'success', 'message' => 'Your message has been sent! We will contact you shortly.']);
    }

    public function submit_appointment()
    {
        if ($this->input->is_ajax_request() || $this->input->post()) {
            $data = $this->input->post();
            
            // Basic validation
            if (empty($data['name']) || empty($data['phone'])) {
                echo json_encode(['status' => 'error', 'message' => 'Please fill Name and Phone fields.']);
                return;
            }

            // Lookup consultation fee from practice_areas if category is given
            $consultation_fee = null;
            if (!empty($data['practice_category_id'])) {
                $pa = $this->db->get_where('practice_areas', ['id' => $data['practice_category_id']])->row_array();
                if ($pa) $consultation_fee = $pa['consultation_fee'] ?? null;
            }

            $insert_data = [
                'attorney_id'          => $data['attorney_id'] ?? NULL,
                'name'                 => $data['name'],
                'email'                => $data['email'] ?? NULL,
                'phone'                => $data['phone'] ?? NULL,
                'address'              => $data['address'] ?? NULL,
                'note'                 => $data['note'] ?? NULL,
                'practice_category_id' => !empty($data['practice_category_id']) ? $data['practice_category_id'] : NULL,
                'payment_method'       => $data['payment_method'] ?? NULL,
                'consultation_fee'     => $consultation_fee,
                'status'               => 'pending'
            ];

            if ($this->db->insert('appointments', $insert_data)) {
                echo json_encode(['status' => 'success', 'message' => 'Your appointment request has been submitted successfully!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Something went wrong. Please try again later.']);
            }
        }
    }

    public function subscribe() {
        if ($this->input->post('email')) {
            $email = $this->input->post('email');
            
            // Check if already subscribed
            $exists = $this->db->get_where('subscribers', ['email' => $email])->row_array();
            if (!$exists) {
                $this->db->insert('subscribers', ['email' => $email]);
                echo json_encode(['status' => 'success', 'message' => 'Thank you for subscribing to our newsletter!']);
            } else {
                echo json_encode(['status' => 'exists', 'message' => 'You are already in our list!']);
            }
        }
    }

	public function attorneys_single()
	{
        // Deprecated: redirect to home or first attorney
        redirect('/');
	}
}
