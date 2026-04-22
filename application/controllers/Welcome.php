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
        
        // Make team data globally available for the footer team section
        $teams = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('teams')->result_array();
        
        // Make practice areas globally available for the chatbot lead form
        $practice_areas = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('practice_areas')->result_array();
        
        $this->load->vars([
            'teams' => $teams,
            'practice_areas' => $practice_areas,
            'practice' => $practice_areas // alias
        ]);
    }

    private function _get_settings() {
        $settings_db = $this->db->get('settings')->result_array();
        $settings = [];
        foreach ($settings_db as $s) {
            $settings[$s['key_name']] = $s['value'];
        }

        // Track site views (once per visitor per day using cookie)
        if (!isset($_COOKIE['site_viewed_today'])) {
            if (isset($settings['site_views'])) {
                $this->db->where('key_name', 'site_views')->set('value', 'value + 1', FALSE)->update('settings');
            } else {
                $this->db->insert('settings', ['key_name' => 'site_views', 'value' => '1']);
                $settings['site_views'] = 1;
            }
            // Set cookie until midnight
            $midnight = strtotime('tomorrow') - time();
            setcookie('site_viewed_today', '1', time() + $midnight, '/');
        }

        // Format Video URL for YouTube support
        if (!empty($settings['video_url'])) {
            $settings['video_url'] = $this->_format_youtube_url($settings['video_url']);
        }

        // Fetch Menus (Header uses all active, Footer will use these too but we'll filter)
        $settings['menus'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('menus')->result_array();
        $settings['footer_menus'] = $this->db->where(['is_active' => 1, 'show_in_footer' => 1])->order_by('priority', 'ASC')->get('menus')->result_array();
        
        // Fetch Practice Areas for footer
        $settings['footer_practice'] = $this->db->where(['is_active' => 1, 'show_in_footer' => 1])->order_by('priority', 'ASC')->limit(6)->get('practice_areas')->result_array();

        // Fetch Custom Pages for Header and Footer
        $settings['header_pages'] = $this->db->where(['is_active' => 1, 'show_in_header' => 1])->order_by('priority', 'ASC')->get('pages')->result_array();
        $settings['footer_pages'] = $this->db->where(['is_active' => 1, 'show_in_footer' => 1])->order_by('priority', 'ASC')->get('pages')->result_array();

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
        $data['videos'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->limit(10)->get('video_gallery')->result_array();

		$this->load->view('includes/header', $data); // Pass data to header if needed (e.g. site title)
		$this->load->view('home', $data);
		$this->load->view('includes/footer', $data); // Pass data to footer if needed
	}

	public function about()
	{
        $data['settings'] = $this->_get_settings();
        $data['about'] = $this->db->get_where('about_us', ['id' => 1])->row_array();
        $data['about_features'] = $this->db->order_by('priority', 'ASC')->get('about_features')->result_array();
        $data['practice_areas'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('practice_areas')->result_array();

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
        $this->db->select('teams.*');
        $this->db->from('teams');
        $this->db->where('slug', $slug);
        $this->db->where('is_active', 1);
        $data['attorney'] = $this->db->get()->row_array();

        if (empty($data['attorney'])) {
            // Try ID if slug fails (for older links)
            if (is_numeric($slug)) {
                $data['attorney'] = $this->db->get_where('teams', ['id' => $slug, 'is_active' => 1])->row_array();
            }
            if (empty($data['attorney'])) redirect('/');
        }

        $data['practice_areas'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('practice_areas')->result_array();

        $this->load->view('includes/header', $data);
        $this->load->view('attorneys_single', $data);
        $this->load->view('includes/footer', $data);
    }

    public function page($slug) {
        $data['settings'] = $this->_get_settings();
        $data['page'] = $this->db->get_where('pages', ['slug' => $slug, 'is_active' => 1])->row_array();
        if (!$data['page']) redirect('welcome');

        // Fetch teams for the "Qualified Attorneys" section as per user requirement
        $data['teams'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('teams')->result_array();

        $this->load->view('includes/header', $data);
        $this->load->view('page', $data);
        $this->load->view('includes/footer', $data);
    }

	public function case_studies()
	{
        $data['settings'] = $this->_get_settings();
        
        // Fetch only 4 case studies initially with category info
        $this->db->select('case_studies.*, case_categories.name as category_name, case_categories.slug as category_slug');
        $this->db->from('case_studies');
        $this->db->join('case_categories', 'case_studies.category_id = case_categories.id', 'left');
        $this->db->where('case_studies.is_active', 1);
        $this->db->order_by('case_studies.id', 'DESC');
        $this->db->limit(4);
        $data['case_studies'] = $this->db->get()->result_array();

        // Check if more cases exist
        $data['has_more'] = ($this->db->where('is_active', 1)->count_all_results('case_studies') > 4);

        // Fetch categories for filtering
        $data['categories'] = $this->db->where('is_active', 1)->get('case_categories')->result_array();

		$this->load->view('includes/header', $data);
		$this->load->view('case_studies', $data);
		$this->load->view('includes/footer', $data);
	}

    public function get_more_cases()
    {
        $offset = $this->input->get('offset', TRUE);
        $limit = 4;

        $this->db->select('case_studies.*, case_categories.name as category_name, case_categories.slug as category_slug');
        $this->db->from('case_studies');
        $this->db->join('case_categories', 'case_studies.category_id = case_categories.id', 'left');
        $this->db->where('case_studies.is_active', 1);
        $this->db->order_by('case_studies.id', 'DESC');
        $this->db->limit($limit, $offset);
        $case_studies = $this->db->get()->result_array();

        if (!empty($case_studies)) {
            $html = $this->load->view('case_studies_partial', ['case_studies' => $case_studies], TRUE);
            
            // Check if even more exist for the next click
            $next_offset = (int)$offset + $limit;
            $more_exist = ($this->db->where('is_active', 1)->count_all_results('case_studies') > $next_offset);
            
            echo json_encode([
                'status' => 'success',
                'html' => $html,
                'has_more' => $more_exist
            ]);
        } else {
            echo json_encode(['status' => 'empty']);
        }
    }

	public function landmark()
	{
        $data['settings'] = $this->_get_settings();
        
        // Fetch all active landmarks
        $data['landmarks'] = $this->db->where('is_active', 1)
                                      ->order_by('title', 'ASC')
                                      ->get('landmarks')
                                      ->result_array();

		$this->load->view('includes/header', $data);
		$this->load->view('landmark', $data);
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

	public function blog($offset = 0)
	{
        $data['settings'] = $this->_get_settings();
        
        // Pagination Config
        $this->load->library('pagination');
        $config['base_url'] = site_url('blog');
        $config['total_rows'] = $this->db->where('is_active', 1)->count_all_results('blogs');
        $config['per_page'] = 6;
        $config['uri_segment'] = 2;
        
        // Styling pagination (aligned with your template)
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li><span class="active">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        // Fetch blogs with categories and limit
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->where('blogs.is_active', 1);
        $this->db->order_by('blogs.priority', 'ASC');
        $this->db->limit($config['per_page'], $offset);
        $data['blogs'] = $this->db->get()->result_array();

        // Sidebar data
        $data['categories'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('blog_categories')->result_array();
        $data['recent_cases'] = $this->db->limit(3)->order_by('id', 'DESC')->get('case_studies')->result_array();
        $data['all_tags'] = $this->_get_all_tags();

		$this->load->view('includes/header', $data);
		$this->load->view('blog', $data);
		$this->load->view('includes/footer', $data);
	}

	public function blog_category($slug = null, $offset = 0)
	{
        if (!$slug) redirect('blog');

        $data['settings'] = $this->_get_settings();
        
        // Pagination Config
        $this->load->library('pagination');
        $config['base_url'] = site_url('blog/category/'.$slug);
        
        // Count total rows for this category
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id');
        $this->db->where('blog_categories.slug', $slug);
        $this->db->where('blogs.is_active', 1);
        $config['total_rows'] = $this->db->count_all_results('blogs');
        
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;
        
        // Styling pagination
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li><span class="active">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        // Fetch blogs in this category
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->where('blog_categories.slug', $slug);
        $this->db->where('blogs.is_active', 1);
        $this->db->order_by('blogs.priority', 'ASC');
        $this->db->limit($config['per_page'], $offset);
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

    public function blog_tag($tag = null, $offset = 0)
    {
        if (!$tag) redirect('blog');
        $tag = urldecode($tag);

        $data['settings'] = $this->_get_settings();
        $data['filter_tag'] = $tag;
        
        // Pagination Config
        $this->load->library('pagination');
        $config['base_url'] = site_url('blog/tag/'.urlencode($tag));
        
        // Count total rows for this tag
        $this->db->like('blogs.tags', $tag);
        $this->db->where('blogs.is_active', 1);
        $config['total_rows'] = $this->db->count_all_results('blogs');
        
        $config['per_page'] = 6;
        $config['uri_segment'] = 4;
        
        // Styling pagination
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li><span class="active">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '<i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i>';
        
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        // Fetch blogs matching tag
        $this->db->select('blogs.*, blog_categories.name as category_name, blog_categories.slug as category_slug');
        $this->db->from('blogs');
        $this->db->join('blog_categories', 'blogs.category_id = blog_categories.id', 'left');
        $this->db->like('blogs.tags', $tag);
        $this->db->where('blogs.is_active', 1);
        $this->db->order_by('blogs.priority', 'ASC');
        $this->db->limit($config['per_page'], $offset);
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

    public function free_consultation()
    {
        $data['settings'] = $this->_get_settings();
        $data['practice_areas'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('practice_areas')->result_array();
        
        // Form pre-fill data (Used for "Change" on checkout)
        $data['prefill'] = $this->session->userdata('last_appointment_data');

        $this->load->view('includes/header', $data);
        $this->load->view('free_consultation', $data);
        $this->load->view('includes/footer', $data);
    }

    public function gallery($id = null, $offset = 0) {
        // Updated Gallery View - Force Refresh
        $limit = 12;
        if($id) {
            // If direct link, show that video first. No pagination logic needed for single view.
            $this->db->order_by("id = $id DESC, priority ASC", '', FALSE);
            $data['videos'] = $this->db->where('is_active', 1)->get('video_gallery')->result_array();
            $data['active_video_id'] = $id;
        } else {
            $this->db->where('is_active', 1);
            $this->db->order_by('priority', 'ASC');
            $this->db->limit($limit, $offset);
            $data['videos'] = $this->db->get('video_gallery')->result_array();
        }
        // SEO overrides for specific video if shared
        $data['active_video'] = null;
        if($id) {
            foreach($data['videos'] as $v) {
                if($v['id'] == $id) {
                    $data['active_video'] = $v;
                    break;
                }
            }
        }
        
        $data['settings'] = $this->_get_settings();
        $this->load->view('includes/header', $data);
        $this->load->view('gallery', $data);
        $this->load->view('includes/footer', $data);
    }

    // AJAX endpoint to track views/shares
    public function track_video_action() {
        $id = $this->input->post('id');
        $type = $this->input->post('type'); // 'view' or 'share'
        
        if($id && ($type == 'view' || $type == 'share')) {
            $column = ($type == 'view') ? 'views' : 'shares';
            $this->db->set($column, $column . ' + 1', FALSE);
            $this->db->where('id', $id);
            $this->db->update('video_gallery');
            
            $new_count = $this->db->select($column)->get_where('video_gallery', ['id' => $id])->row()->$column;
            echo json_encode(['status' => 'success', 'count' => $new_count]);
        }
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

    public function chatbot_lead_submit()
    {
        // Allow BOTH AJAX and direct POS (though AJAX is intended)
        if ($this->input->is_ajax_request() || $this->input->post()) {
            $name    = trim($this->input->post('name'));
            $phone   = trim($this->input->post('phone'));
            $cat_id  = $this->input->post('category_id');
            $city    = trim($this->input->post('city'));

            if (empty($name) || empty($phone) || empty($cat_id) || empty($city)) {
                echo json_encode(['status' => 'error', 'message' => 'Please fill all required fields.']);
                return;
            }

            $insert_data = [
                'name'        => $name,
                'phone'       => $phone,
                'category_id' => $cat_id,
                'city'        => $city,
                'is_read'     => 0
            ];
            
            if ($this->db->insert('chatbot_leads', $insert_data)) {
                // Store lead data in session for chat logging
                $this->session->set_userdata('chat_user_name', $name);
                $this->session->set_userdata('chat_user_phone', $phone);
                
                echo json_encode(['status' => 'success', 'message' => 'Details saved. You can now start chatting!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to save details. Please try again.']);
            }
        }
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
            $consultation_fee = 0;
            $category_name = 'Free Consultation';
            if (!empty($data['practice_category_id'])) {
                $pa = $this->db->get_where('practice_areas', ['id' => $data['practice_category_id']])->row_array();
                if ($pa) {
                    $consultation_fee = $pa['consultation_fee'] ?? 0;
                    $category_name = $pa['title'] ?? 'General';
                }
            }

            if ($consultation_fee > 0) {
                // PAID: Store in session only, NO DB entry yet
                $uuid = bin2hex(random_bytes(8));
                $this->session->set_userdata('pending_appointment', [
                    'uuid'                 => $uuid,
                    'attorney_id'          => $data['attorney_id'] ?? NULL,
                    'name'                 => $data['name'],
                    'email'                => $data['email'] ?? NULL,
                    'phone'                => $data['phone'] ?? NULL,
                    'address'              => $data['address'] ?? NULL,
                    'note'                 => $data['note'] ?? NULL,
                    'practice_category_id' => $data['practice_category_id'],
                    'payment_method'       => $data['payment_method'] ?? NULL,
                    'consultation_fee'     => $consultation_fee,
                    'category_name'        => $category_name,
                ]);
                // Also save for "Change" pre-fill
                $this->session->set_userdata('last_appointment_data', $data);

                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Redirecting to payment...',
                    'redirect' => site_url('checkout/'.$uuid)
                ]);
            } else {
                // FREE: Insert directly to DB
                $insert_data = [
                    'uuid'                 => bin2hex(random_bytes(8)),
                    'attorney_id'          => $data['attorney_id'] ?? NULL,
                    'name'                 => $data['name'],
                    'email'                => $data['email'] ?? NULL,
                    'phone'                => $data['phone'] ?? NULL,
                    'address'              => $data['address'] ?? NULL,
                    'note'                 => $data['note'] ?? NULL,
                    'practice_category_id' => !empty($data['practice_category_id']) ? $data['practice_category_id'] : NULL,
                    'payment_method'       => NULL,
                    'consultation_fee'     => 0,
                    'status'               => 'pending',
                    'payment_status'       => 'free'
                ];
                $this->db->insert('appointments', $insert_data);
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Your appointment has been submitted. Our team will contact you shortly.'
                ]);
            }
        }
    }

    public function checkout($uuid = null)
    {
        if (!$uuid) redirect('welcome/free_consultation');
        
        // Read from session
        $pending = $this->session->userdata('pending_appointment');
        if (!$pending || $pending['uuid'] !== $uuid) {
            redirect('welcome/free_consultation');
        }

        $data['settings'] = $this->_get_settings();
        $data['appointment'] = $pending;

        $this->load->view('includes/header', $data);
        $this->load->view('checkout', $data);
        $this->load->view('includes/footer', $data);
    }

    public function process_payfast($uuid = null)
    {
        if (!$uuid) {
            echo json_encode(['status' => 'error', 'message' => 'Missing appointment ID']);
            return;
        }

        $pending = $this->session->userdata('pending_appointment');
        if (!$pending || $pending['uuid'] !== $uuid) {
            echo json_encode(['status' => 'error', 'message' => 'Session expired or invalid.']);
            return;
        }

        // Check if already paid
        $actual_app = $this->db->get_where('appointments', ['uuid' => $uuid])->row_array();
        if ($actual_app && $actual_app['payment_status'] === 'paid') {
            echo json_encode(['status' => 'error', 'message' => 'This appointment is already paid.']);
            return;
        }

        $this->load->library('payfast');
        
        // 1. Get Token (New flow requires amount and basket_id)
        $token_res = $this->payfast->get_token($appointment['consultation_fee'], $appointment['uuid'], 'PKR');
        if (!isset($token_res['token'])) {
            $msg = $token_res['message'] ?? $token_res['error'] ?? 'Unknown authentication error';
            echo json_encode(['status' => 'error', 'message' => 'Failed to authenticate with PayFast: ' . $msg]);
            return;
        }
        $token = $token_res['token'];

        // 2. Initiate Transaction
        // For simplicity, we are using the basic initiation. 
        // In a real scenario, you might need customer validation or 3DS handling.
        $txn_res = $this->payfast->initiate_transaction($token, $pending);

        if (isset($txn_res['code']) && $txn_res['code'] == '00') {
            // Success or 3DS Redirection
            if (isset($txn_res['data_3ds_html']) && !empty($txn_res['data_3ds_html'])) {
                echo json_encode(['status' => '3ds', 'html' => $txn_res['data_3ds_html']]);
            } else {
                // Direct success (rare for cards, but possible for some instruments)
                $this->db->where('uuid', $uuid)->update('appointments', [
                    'status' => 'confirmed',
                    'payment_status' => 'paid',
                    'transaction_id' => $txn_res['transaction_id'] ?? 'PF-' . time()
                ]);
                echo json_encode(['status' => 'success', 'message' => 'Payment successful!']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'PayFast Transaction Failed: ' . ($txn_res['message'] ?? 'Error code ' . ($txn_res['code'] ?? 'unknown'))]);
        }
    }

    public function payfast_callback()
    {
        $this->load->library('payfast');
        $token_res = $this->payfast->get_token();
        $token = $token_res['token'] ?? '';

        $basket_id = $this->input->get('basket_id');
        $transaction_id = $this->input->get('transaction_id');

        if ($basket_id && $transaction_id) {
            $status = $this->payfast->get_transaction_status($token, $transaction_id);
            if (isset($status['code']) && $status['code'] == '00') {
                $this->db->where('uuid', $basket_id)->update('appointments', [
                    'status' => 'confirmed',
                    'payment_status' => 'paid',
                    'transaction_id' => $transaction_id
                ]);
                redirect('welcome/free_consultation?status=success');
            } else {
                redirect('welcome/free_consultation?status=failed');
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

    private function _get_embed_url($url) {
        if (empty($url)) return '';

        // YouTube
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return "https://www.youtube.com/embed/" . $match[1];
        }

        // Vimeo
        if (preg_match('%vimeo\.com/(?:channels/(?:\w+/)?|groups/([^/]*)/videos/|album/(\d+)/video/|video/|)(\d+)(?:$|/|\?)%i', $url, $match)) {
            return "https://player.vimeo.com/video/" . $match[3];
        }

        return $url;
    }
    public function ajax_search()
    {
        $keyword = $this->input->get('keyword');
        if (empty($keyword) || strlen($keyword) < 2) {
            echo json_encode([]);
            return;
        }

        $results = [];

        // Search Blogs
        $blogs = $this->db->select('title, slug, image, "Blog Post" as type')
            ->from('blogs')
            ->group_start()
            ->like('title', $keyword)
            ->or_like('description', $keyword)
            ->group_end()
            ->where('is_active', 1)
            ->limit(4)
            ->get()->result_array();
        
        foreach ($blogs as $b) {
            $results[] = [
                'title' => $b['title'],
                'url' => site_url('blog_detail/' . $b['slug']),
                'image' => base_url($b['image']),
                'type' => $b['type']
            ];
        }

        // Search Practices
        $practices = $this->db->select('title, slug, image, "Practice Area" as type')
            ->from('practice_areas')
            ->group_start()
            ->like('title', $keyword)
            ->or_like('description', $keyword)
            ->group_end()
            ->where('is_active', 1)
            ->limit(4)
            ->get()->result_array();

        foreach ($practices as $p) {
            $results[] = [
                'title' => $p['title'],
                'url' => site_url('practice/' . $p['slug']),
                'image' => base_url($p['image']),
                'type' => $p['type']
            ];
        }

        // Search Case Studies
        $cases = $this->db->select('title, slug, image, "Case Study" as type')
            ->from('case_studies')
            ->group_start()
            ->like('title', $keyword)
            ->or_like('description', $keyword)
            ->group_end()
            ->where('is_active', 1)
            ->limit(4)
            ->get()->result_array();

        foreach ($cases as $c) {
            $results[] = [
                'title' => $c['title'],
                'url' => site_url('case_studies_details/' . $c['slug']),
                'image' => base_url($c['image']),
                'type' => $c['type']
            ];
        }

        // Search Landmarks (PDFs)
        $landmarks = $this->db->select('title, pdf, "Landmark Case" as type')
            ->from('landmarks')
            ->like('title', $keyword)
            ->where('is_active', 1)
            ->limit(4)
            ->get()->result_array();

        foreach ($landmarks as $l) {
            $results[] = [
                'title' => $l['title'],
                'url' => base_url($l['pdf']),
                'image' => 'https://cdn-icons-png.flaticon.com/512/337/337946.png', // Generic PDF icon
                'type' => $l['type']
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($results);
    }

    public function resolve_slug($slug)
    {
        $slug = trim($slug, '/');
        $data['settings'] = $this->_get_settings();
        
        // Map common slugs to internal methods (matches our DB migration and routes)
        $system_mappings = [
            'about-us'      => 'about',
            'practices-area' => 'practice',
            'cases'         => 'case_studies',
            'blog'          => 'blog',
            'contact-us'    => 'contact',
            'landmark'      => 'landmark',
            'free-consultation' => 'free_consultation',
            'gallery'       => 'gallery'
        ];

        if (array_key_exists($slug, $system_mappings)) {
            $method = $system_mappings[$slug];
            $this->$method();
            return;
        }

        // If not system, check custom pages
        $page = $this->db->get_where('pages', ['slug' => $slug, 'is_active' => 1])->row_array();
        if ($page) {
            $data['page'] = $page;
            // Fetch teams for the showcase
            $data['teams'] = $this->db->where('is_active', 1)->order_by('priority', 'ASC')->get('teams')->result_array();
            
            $this->load->view('includes/header', $data);
            $this->load->view('page', $data);
            $this->load->view('includes/footer', $data);
            return;
        }

        // If nothing found, show 404
        $this->error_404();
    }

    public function error_404()
    {
        $data['settings'] = $this->_get_settings();
        $this->output->set_status_header('404');
        $this->load->view('includes/header', $data);
        $this->load->view('error_404', $data);
        $this->load->view('includes/footer', $data);
    }
    public function load_more_videos($offset = 12) {
        $limit = 12;
        $this->db->where('is_active', 1);
        $this->db->order_by('priority', 'ASC');
        $this->db->limit($limit, $offset);
        $videos = $this->db->get('video_gallery')->result_array();
        
        echo json_encode(['status' => 'success', 'videos' => $videos]);
    }

    public function chat_query()
    {
        $message = $this->input->post('message', true);
        if (!$message) {
            echo json_encode(['status' => 'error', 'message' => 'Message field is empty.']);
            return;
        }

        // --- CONFIG (DYNAMIC FROM ADMIN PANEL) ---
        $settings = $this->_get_settings();
        $api_key = isset($settings['gemini_api_key']) ? $settings['gemini_api_key'] : "AIzaSyA0nNPUotNOBmGWmhYeOIObqAjfLBnINj8";
        $api_url = isset($settings['gemini_api_url']) ? $settings['gemini_api_url'] : "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent";
        
        $url = $api_url . "?key=" . $api_key;

        $system_instruction = "You are a Senior Legal Researcher for 'Legal Eagle Law Firm'.
    - The user ONLY wants **Specific Judgments and Citations** (SCMR, PLD, P Cr. L J, CLC, etc.).
    - **SKIP Overviews** and general summaries.
    - For any Section asked (e.g., 489-F, 420, 302 PPC), list 5-10 Relevant Judgments.
    - For each Judgment, provide:
        - **Citation** (e.g., 2021 SCMR 1)
        - **The Ratio / Key Ruling** (What the court decided)
    - Provide the content of the judgments directly in the chat.
    - Be professional, precise, and result-oriented.


    LEAD ATTORNEY PROFILE:
    - Full Name: Maaz Ahmed Warriach (Advocate High Court - AHC).
    - Role: Founder & Lead Counsel of Legal Eagle Law Firm.
    - Expertise: Strategic Litigation in Criminal Law, Tax Law, and Corporate Affairs.
    - Professional Presence:
        - Lahore High Court: Representing clients in Constitutional Writs, Bail Petitions, and Appellate Advocacy.
        - District & Sessions Courts: Leading criminal defense trials and complex civil litigation.
        - Federal Agencies: Expert representation in FIA (Cybercrime, Money Laundering, PECA 2016) and Anti-Corruption dossiers.
        - Taxation Forums: Active practitioner before the Federal Board of Revenue (FBR), Federal Tax Ombudsman (FTO), and Appellate Tribunals (IR).
    - Professional Philosophy: Focused on high-stakes advocacy, legal integrity, and result-oriented client solutions.

    ADDITIONAL FIRM KNOWLEDGE (FROM ADMIN):
    ";
        
        $custom_knowledge = $this->db->get_where('chatbot_knowledge', ['is_active' => 1])->result_array();
        foreach ($custom_knowledge as $ck) {
            $system_instruction .= "- " . $ck['topic'] . ": " . $ck['content'];
            if (!empty($ck['link_url'])) {
                $system_instruction .= " (Link: " . $ck['link_url'] . ")";
            }
            $system_instruction .= "\n";
        }

        $system_instruction .= "
    LEGAL EAGLE LAW FIRM INFORMATION & NAVIGATION:
    - Lead Attorney: Maaz Ahmed Warriach AHC.
    - Services (Practice Areas): Family Law, Business Law, Criminal Law, Real Estate Law, Education Law, Personal Injury, and Tax Law.
    - Case Studies (/case_studies): Detailed proof of our legal victories and the results we achieve for clients.
    - Landmark Cases (/landmark): Access to significant legal precedence and our firm's high-profile achievements.
    - Blog/News (/blog): Latest legal insights, advice, and news updates on Pakistani Law.
    - Gallery (/gallery): Visual documentation of our law firm's activities and events.
    - About Us (/about-us): Learn about our history, values, and client-focused mission.
    - Contact Us (/contact-us): Get our exact office location, view the map, and send an inquiry.
    - Facebook Page: https://web.facebook.com/profile.php?id=61586375175630
    - Instagram Profile: https://www.instagram.com/legal_eaglelawfirm/
    - Location: Office no 3 2nd floor, Kareem chamber, Mozang Chungi, Lahore, 54000.
    - Phone & WhatsApp: +92 3390108134.
    - Hours: Mon-Thu 8 AM - 9 PM, Fri 2 PM - 6 PM, Sat 8 AM - 9:30 PM.
    - Online Appointment: Available 24/7 on the website.
    - Firm Persona: Professional, reliable, knowledgeable, and client-focused.

    VERIFIED PAKISTAN LEGAL & JUDICIAL DATABASES:
    1. Pakistan Code (Federal Laws): pakistancode.gov.pk - Central repository of all Federal Laws of Pakistan.
    2. Supreme Court of Pakistan (Judgments): https://www.supremecourt.gov.pk/
    3. Punjab Laws Online (Provincial Statutes): punjablaws.gov.pk - Comprehensive database of Punjab's provincial laws.
    4. Lahore High Court (LHC) Judgments: https://data.lhc.gov.pk/reported_judgments/judgments_approved_for_reporting
    5. LHC Case Management: https://data.lhc.gov.pk/case_management/last_hearing_status - Real-time case tracking for District & Sessions courts.
    6. Sindh High Court (SHC) Decisions: https://sindhhighcourt.gov.pk/
    7. Peshawar High Court (PHC) Reported Cases: peshawarhighcourt.gov.pk/reported_judgments
    8. Islamabad High Court (IHC) Judgments: ihc.gov.pk/judgments
    9. Pakistan Law Site: pakistanlawsite.com - Premium database for PLD, SCMR, CLC, PCrLJ, and other law reports.
    10. FIA Official Laws & Acts: fia.gov.pk/laws
    11. Cybercrime Law (PECA 2016): https://www.nccia.gov.pk/
    12. FBR Statutes: fbr.gov.pk/statutes - Income Tax and Sales Tax laws and regulations.
    13. Customs Act 1969 & Rules: fbr.gov.pk/customs-act
    14. SECP Laws: secp.gov.pk/laws - Company and corporate law framework of Pakistan.
    15. National Assembly of Pakistan: na.gov.pk/en/acts-tenure.php - Access to Acts passed by the National Assembly.
    16. The Gazette of Pakistan: https://www.dgip.gov.pk/home/
    17. Federal Tax Ombudsman (FTO) Decisions: fto.gov.pk/decisions
    18. Election Commission of Pakistan (ECP) Laws: ecp.gov.pk/laws
    19. Federal Service Tribunal (FST): fst.gov.pk
    20. Punjab Environmental Protection Tribunal: https://epd.punjab.gov.pk/

    INSTRUCTIONS:
    - First explain the specific service/procedure, then provide the link.
    - **LANGUAGE POLICY**: Respond in simple English or **Roman Urdu ONLY** (e.g., using English alphabets like 'Aap kaise hain?'). 
    - **CRITICAL**: DO NOT use Hindi script (Devanagari) or Urdu script (Alif Bay Pay). Only use English letters for both English and Roman Urdu responses.
    - Maintain a professional human persona.
    - If a user asks about general legal advice, provide information based on these resources and suggest booking a consultation with our firm for specific legal representation.";

        $data = [
            "system_instruction" => [
                "parts" => [
                    ["text" => $system_instruction]
                ]
            ],
            "contents" => [
                ["role" => "user", "parts" => [["text" => $message]]]
            ],
            "generationConfig" => [
                "temperature" => 0.7,
                "maxOutputTokens" => 1000,
            ]
        ];

        $response = false;
        $http_code = 0;

        if (extension_loaded('curl')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Localhost ke liye
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);

            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        } elseif (ini_get('allow_url_fopen')) {
            // Fallback strategy when cURL is not available
            $options = [
                'http' => [
                    'header'  => "Content-type: application/json\r\n",
                    'method'  => 'POST',
                    'content' => json_encode($data),
                    'ignore_errors' => true,
                    'timeout' => 20
                ],
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ];
            $context  = stream_context_create($options);
            $response = @file_get_contents($url, false, $context);
            
            if ($response !== false) {
                if (isset($http_response_header) && preg_match('{HTTP\/\S*\s(\d{3})}', $http_response_header[0], $match)) {
                    $http_code = (int)$match[1];
                }
            }
        }

        if ($http_code == 200 && $response) {
            $res_obj = json_decode($response, true);
            if (isset($res_obj['candidates'][0]['content']['parts'][0]['text'])) {
                $ai_text = $res_obj['candidates'][0]['content']['parts'][0]['text'];

                // Dynamic Links based on response content
                $links_found = [];
                if (stripos($ai_text, 'pakistancode.gov.pk') !== false) $links_found[] = ['title' => 'Pakistan Code', 'url' => 'https://pakistancode.gov.pk'];
                if (stripos($ai_text, 'supremecourt.gov.pk') !== false) $links_found[] = ['title' => 'Supreme Court', 'url' => 'https://www.supremecourt.gov.pk/'];
                if (stripos($ai_text, 'punjablaws.gov.pk') !== false) $links_found[] = ['title' => 'Punjab Laws', 'url' => 'https://punjablaws.gov.pk'];
                if (stripos($ai_text, 'lhc.gov.pk') !== false) $links_found[] = ['title' => 'LHC Decisions', 'url' => 'https://data.lhc.gov.pk/reported_judgments/judgments_approved_for_reporting'];
                if (stripos($ai_text, 'sindhhighcourt.gov.pk') !== false) $links_found[] = ['title' => 'SHC Decisions', 'url' => 'https://sindhhighcourt.gov.pk/'];
                if (stripos($ai_text, 'ihc.gov.pk') !== false) $links_found[] = ['title' => 'IHC Judgments', 'url' => 'http://ihc.gov.pk/judgments'];
                if (stripos($ai_text, 'fia.gov.pk') !== false) $links_found[] = ['title' => 'FIA Laws', 'url' => 'https://fia.gov.pk/laws'];
                if (stripos($ai_text, 'fbr.gov.pk') !== false) $links_found[] = ['title' => 'FBR Statutes', 'url' => 'https://fbr.gov.pk/statutes'];
                if (stripos($ai_text, 'secp.gov.pk') !== false) $links_found[] = ['title' => 'SECP Laws', 'url' => 'https://secp.gov.pk/laws'];
                if (stripos($ai_text, 'pakistanlawsite.com') !== false) $links_found[] = ['title' => 'Pakistan Law Site', 'url' => 'https://pakistanlawsite.com'];
                
                // Internal Firm Links
                if (stripos($ai_text, 'About Us') !== false || stripos($ai_text, 'Legal Eagle') !== false) $links_found[] = ['title' => 'About Our Firm', 'url' => site_url('about-us')];
                if (stripos($ai_text, 'Attorney') !== false || stripos($ai_text, 'Team') !== false || stripos($ai_text, 'Maaz') !== false || stripos($ai_text, 'AHC') !== false) $links_found[] = ['title' => 'Maaz Ahmed Warriach AHC', 'url' => site_url('attorney/maaz-ahmed-warriach-ahc')];
                if (stripos($ai_text, 'Services') !== false || stripos($ai_text, 'Practice') !== false) $links_found[] = ['title' => 'View Services', 'url' => site_url('practices-area')];
                if (stripos($ai_text, 'Case Studies') !== false || stripos($ai_text, 'Victories') !== false || stripos($ai_text, 'Success') !== false) $links_found[] = ['title' => 'Our Case Victories', 'url' => site_url('case_studies')];
                if (stripos($ai_text, 'Blog') !== false || stripos($ai_text, 'Article') !== false || stripos($ai_text, 'Insight') !== false) $links_found[] = ['title' => 'Legal Blog & News', 'url' => site_url('blog')];
                if (stripos($ai_text, 'Landmark') !== false || stripos($ai_text, 'Precedents') !== false) $links_found[] = ['title' => 'Landmark Judgments', 'url' => site_url('landmark')];
                if (stripos($ai_text, 'Gallery') !== false || stripos($ai_text, 'Photos') !== false || stripos($ai_text, 'Visual') !== false) $links_found[] = ['title' => 'View Firm Gallery', 'url' => site_url('gallery')];
                if (stripos($ai_text, 'Contact Us') !== false || stripos($ai_text, 'Map') !== false) $links_found[] = ['title' => 'Contact & Location', 'url' => site_url('contact-us')];
                if (stripos($ai_text, 'Facebook') !== false || stripos($ai_text, 'Social') !== false || stripos($ai_text, 'Follow') !== false) $links_found[] = ['title' => 'Official Facebook Page', 'url' => 'https://web.facebook.com/profile.php?id=61586375175630'];
                if (stripos($ai_text, 'Instagram') !== false || stripos($ai_text, 'Insta') !== false) $links_found[] = ['title' => 'Official Instagram', 'url' => 'https://www.instagram.com/legal_eaglelawfirm/'];
                
                // Custom Knowledge Links
                foreach ($custom_knowledge as $ck) {
                    if (!empty($ck['link_title']) && !empty($ck['link_url'])) {
                        if (stripos($ai_text, $ck['link_title']) !== false || stripos($ai_text, $ck['topic']) !== false) {
                            // Avoid duplicates
                             $exists = false;
                             foreach($links_found as $lf) { if($lf['url'] == $ck['link_url']) $exists = true; }
                             if(!$exists) $links_found[] = ['title' => $ck['link_title'], 'url' => $ck['link_url']];
                        }
                    }
                }
                
                if (preg_match('/appointment|consult|meet/i', $ai_text)) $links_found[] = ['title' => 'Book Appointment', 'url' => site_url('free-consultation')];

                // Log the Interaction
                $this->db->insert('chatbot_logs', [
                    'session_id' => session_id(),
                    'user_name' => $this->session->userdata('chat_user_name'),
                    'user_phone' => $this->session->userdata('chat_user_phone'),
                    'message' => $message,
                    'response' => $ai_text,
                    'links_json' => json_encode($links_found),
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                echo json_encode([
                    'status' => 'success',
                    'message' => $ai_text,
                    'links' => $links_found
                ]);
                exit;
            }
        }

        // Manual Logic Fallback
        $this->_manual_chat_logic($message);
    }

    private function _manual_chat_logic($message)
    {
        $msg = strtolower($message);
        $response = "";
        $links = [];

        // Detailed Fallback for Firm Information (Identity & Staff)
        if (preg_match('/who|attorney|lawyer|maaz|ahc|team|boss|profile/i', $msg)) {
            $response = "**Maaz Ahmed Warriach (Advocate High Court - AHC)** is the Lead Counsel and Founder of Legal Eagle Law Firm. \n\nHe is a highly respected legal professional specializing in **Criminal Defense (FIA, PECA, Anti-Corruption)**, **Taxation (FBR, FTO)**, and **Corporate Litigation**. \n\nMaaz Ahmed Warriach is active in: \n- **Lahore High Court** (Appellate Advocacy & Writs) \n- **District & Sessions Courts** (Trials) \n- **Specialized Tribunals** (FBR, FIA, Anti-Corruption)";
            $links[] = ['title' => 'View Profile: Maaz Ahmed Warriach', 'url' => site_url('attorney/maaz-ahmed-warriach-ahc')];
            $links[] = ['title' => 'About Us', 'url' => site_url('about-us')];
        }

        // Detailed Fallback for Success Stories & Case Proof
        else if (preg_match('/proof|success|victory|win|case study|results/i', $msg)) {
            $response = "We have a strong track record of success. You can view our **Case Studies** to see detailed reports of our legal victories and the results we have achieved for our clients.";
            $links[] = ['title' => 'Our Case Victories', 'url' => site_url('case_studies')];
            $links[] = ['title' => 'Landmark Judgments', 'url' => site_url('landmark')];
        }

        // Detailed Fallback for Articles & News
        else if (preg_match('/article|blog|news|advice|insight|legal info/i', $msg)) {
            $response = "Stay updated with the latest in Pakistani Law. Our **Legal Blog** provides insights, news, and professional advice on various legal matters including tax updates and criminal procedures.";
            $links[] = ['title' => 'Read Our Blog', 'url' => site_url('blog')];
        }

        // Detailed Fallback for Address & Contact
        else if (preg_match('/address|location|where|phone|contact|email|whatsapp|map|facebook|instagram|social|follow|insta/i', $msg)) {
            $response = "We are located at **Office no 3, 2nd Floor, Kareem Chamber, Mozang Chungi, Lahore**. \n- **Phone/WhatsApp**: +923390108134 \n- **Email**: legallaw669@gmail.com \n- **Facebook**: web.facebook.com/profile.php?id=61586375175630 \n- **Instagram**: instagram.com/legal_eaglelawfirm/";
            $links[] = ['title' => 'Official Instagram', 'url' => 'https://www.instagram.com/legal_eaglelawfirm/'];
            $links[] = ['title' => 'Official Facebook Page', 'url' => 'https://web.facebook.com/profile.php?id=61586375175630'];
            $links[] = ['title' => 'Contact & Map', 'url' => site_url('contact-us')];
            $links[] = ['title' => 'Book Appointment', 'url' => site_url('free-consultation')];
        }

        // Detailed Fallback for Services
        else if (preg_match('/service|work|provide|practice|expert/i', $msg)) {
            $response = "Legal Eagle Law Firm provides expert legal services in: \n1. **Criminal Law** \n2. **Tax Law** \n3. **Family & Civil Law** \n4. **Business & Corporate** \n5. **Real Estate** \n6. **Personal Injury**";
            $links[] = ['title' => 'View All Services', 'url' => site_url('practices-area')];
        }

        // Detailed Fallback for Gallery & Visuals
        else if (preg_match('/photo|image|gallery|video|see firm/i', $msg)) {
            $response = "You can take a visual journey through our firm's activities and events by visiting our **Official Gallery**.";
            $links[] = ['title' => 'View Firm Gallery', 'url' => site_url('gallery')];
        }

        // Detailed Fallback for Laws & Acts
        else if (preg_match('/law|act|statute|ordinance|code/i', $msg)) {
            $response = "You can access legal databases across Pakistan. For Federal Laws, check **Pakistan Code**. For provincial legislation, use **Punjab Laws Online**. If you need corporate laws, the **SECP** portal is the primary source. Tax-related statutes are maintained by the **FBR**.";
            $links[] = ['title' => 'Pakistan Code', 'url' => 'https://pakistancode.gov.pk'];
            $links[] = ['title' => 'Punjab Laws', 'url' => 'https://punjablaws.gov.pk'];
            $links[] = ['title' => 'FBR Statutes', 'url' => 'https://fbr.gov.pk/statutes'];
        }

        // Detailed Fallback for 489-F (Dishonoring of Cheque)
        else if (preg_match('/489\s*f|cheque bounce|check bounce|dishonor|489f/i', $msg)) {
            $response = "**Section 489-F PPC: Landmark Judgments & Citations**\n\n" .
                        "1. **2021 SCMR 1**: SC ruled that **Dishonest Intent** (Mala Fide) is a mandatory requirement for conviction. Absence of intent makes it a civil matter.\n" .
                        "2. **2019 SCMR 144**: SC ruled that post-arrest bail should be granted in cases where the debt is disputed or the cheque was for guarantee.\n" .
                        "3. **PLD 2008 SC 12**: SC clarified that 489-F is for criminal deterrence against dishonesty, not just debt recovery.\n" .
                        "4. **2020 PCrLJ 555**: LHC held that if a cheque is issued as 'Security' and not for 'Repayment of Loan', 489-F does not apply.";
            $links[] = ['title' => 'LHC Decisions (489-F)', 'url' => 'https://data.lhc.gov.pk/reported_judgments/judgments_approved_for_reporting'];
            $links[] = ['title' => 'Supreme Court Cases', 'url' => 'https://www.supremecourt.gov.pk/'];
            $links[] = ['title' => 'Book Free Consultation', 'url' => site_url('free-consultation')];
        }

        // Detailed Fallback for 420 (Fraud)
        else if (preg_match('/420|fraud|cheating|jaal sazi/i', $msg)) {
            $response = "**Section 420 PPC: Landmark Judgments & Citations**\n\n" .
                        "1. **2017 SCMR 1492**: SC ruled that if the matter is purely a **Civil Dispute** arising from a contract, criminal proceedings under 420/406 should be stayed.\n" .
                        "2. **PLD 2005 SC 570**: SC clarified that deception and fraudulent inducement are mandatory for 420.\n" .
                        "3. **2022 SCMR 1**: SC held that 420 does not apply if the property was not delivered due to deception.";
            $links[] = ['title' => 'LHC Decisions (420)', 'url' => 'https://data.lhc.gov.pk/reported_judgments/judgments_approved_for_reporting'];
            $links[] = ['title' => 'Book Free Consultation', 'url' => site_url('free-consultation')];
        }

        // Detailed Fallback for 302 (Murder/Homicide)
        else if (preg_match('/302|murder|qatl|homicide/i', $msg)) {
            $response = "**Section 302 of the Pakistan Penal Code (PPC)** deals with **Punishment of Qatl-i-Amd (Murder)**.\n\n" .
                        "**Key Details:**\n" .
                        "- **Punishment:** Death, or imprisonment for life as ta'zir.\n" .
                        "- **Legal Context:** Trials for 302 are high-stakes and require expert criminal defense.\n\n" .
                        "**Maaz Ahmed Warriach AHC** is a renowned Criminal Defense specialist for such cases.";
            $links[] = ['title' => 'Supreme Court (302) Cases', 'url' => 'https://www.supremecourt.gov.pk/'];
            $links[] = ['title' => 'Book Legal Consultation', 'url' => site_url('free-consultation')];
        }

        // Detailed Fallback for Court Judgments
        else if (preg_match('/judgment|decision|case|ruling/i', $msg)) {
            $response = "Reported judgments and decisions can be found on the official websites of the respective courts. The **Supreme Court of Pakistan**, **Lahore High Court**, and **Sindh High Court** maintain searchable databases for judgments approved for reporting.";
            $links[] = ['title' => 'Supreme Court Judgments', 'url' => 'https://www.supremecourt.gov.pk/'];
            $links[] = ['title' => 'LHC Reported Cases', 'url' => 'https://data.lhc.gov.pk/reported_judgments/judgments_approved_for_reporting'];
            $links[] = ['title' => 'SHC Decisions', 'url' => 'https://sindhhighcourt.gov.pk/'];
        }

        // Detailed Fallback for Specialized Tribunals/Agencies
        else if (preg_match('/fia|cybercrime|fbr|secp|fto|fst/i', $msg)) {
            $response = "For matters related to the FIA, FBR, or SECP, you can visit their official legal sections. Information on Cybercrime laws (PECA) is also available through the NCCIA portal.";
            $links[] = ['title' => 'FIA Laws', 'url' => 'https://fia.gov.pk/laws'];
            $links[] = ['title' => 'SECP Laws', 'url' => 'https://secp.gov.pk/laws'];
            $links[] = ['title' => 'Cybercrime Law', 'url' => 'https://www.nccia.gov.pk/'];
        }

        // Detailed Fallback for Appointments
        else if (preg_match('/appointment|meet|consult|book/i', $msg)) {
            $response = "To discuss your legal matter with our experts, please fill out the **Online Consultation Form** on our website. You can select your practice area (Criminal, Civil, Family, etc.) and pick a preferred time for a professional legal review.";
            $links[] = ['title' => 'Book Appointment', 'url' => site_url('free-consultation')];
        }

        // Greetings
        else if (preg_match('/hi|hello|salam|hey/i', $msg)) {
            $response = "Hello! I am your Legal AI Assistant at **Legal Eagle Law Firm**. I can help you find information about Pakistani laws, court judgments, and specialized legal databases. How can I assist you today?";
        } else {
            $response = "I am trained to help you with: \n- **Federal & Provincial Laws**\n- **Court Judgments** (SC, LHC, SHC, IHC, PHC)\n- **Specialized Statutes** (FBR, FIA, SECP)\n- **Booking Appointments**\n\nPlease let me know which area you are interested in!";
            $links[] = ['title' => 'Visit Pakistan Code', 'url' => 'https://pakistancode.gov.pk'];
        }

        // Log the Manual Interaction
        $this->db->insert('chatbot_logs', [
            'session_id' => session_id(),
            'user_name' => $this->session->userdata('chat_user_name'),
            'user_phone' => $this->session->userdata('chat_user_phone'),
            'message' => $message,
            'response' => $response,
            'links_json' => json_encode($links),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        echo json_encode(['status' => 'success', 'message' => $response, 'links' => $links]);
        exit;
    }
}
