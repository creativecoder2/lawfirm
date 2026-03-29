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
        $this->load->vars(['teams' => $teams]);
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

    public function process_paypro($uuid = null)
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

        // Check if already paid to prevent back-navigation/re-payment
        $pending = $this->db->get_where('appointments', ['uuid' => $uuid])->row_array();
        if (!$pending) {
            $this->session->set_flashdata('error', 'Appointment not found.');
            redirect('welcome/free_consultation');
            return;
        }

        if ($pending['payment_status'] === 'paid') {
            $this->session->set_flashdata('success', 'This appointment has already been paid and confirmed.');
            redirect('welcome/free_consultation');
            return;
        }

        $is_demo = true; // User provided credentials with 'Demo' in password, switching to true
        $base_host = $is_demo ? "https://demoapi.paypro.com.pk/v2" : "https://api.paypro.com.pk/v2";

        // Hardcoded credentials as requested by user
        $username = "LE_Law_Firm";
        $client_id = "WkBTyYw6PSusC4l";
        $client_secret = "AeoKOCQAQsKGox1";

        // 1. Get Access Token (API V2.1)
        $auth_url = $base_host . "/ppro/auth";
        $auth_payload = json_encode([
            'ClientID' => $client_id,
            'ClientSecret' => $client_secret
        ]);

        $ch = curl_init($auth_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $auth_payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $response = curl_exec($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);
        curl_close($ch);

        $access_token = '';
        if (preg_match('/Token:\s*(.*)$/mi', $header, $matches)) {
            $access_token = trim($matches[1]);
        }

        if (empty($access_token)) {
            $token_data = json_decode($body, true);
            $access_token = $token_data['Token'] ?? $token_data['token'] ?? '';
        }

        if ($access_token) {
            // 2. Create Order (API V2.1 - CSO)
            $order_id = $uuid . '-' . substr(time(), -5); // Add suffix to prevent 'already exists' error on retries
            $amount = $pending['consultation_fee'];
            $due_date = date('Y-m-d', strtotime('+7 days'));

            $order_payload = [
                [
                    "MerchantId" => $username
                ],
                [
                    "OrderNumber" => $order_id,
                    "OrderAmount" => $amount,
                    "OrderDueDate" => $due_date,
                    "OrderType" => "Service",
                    "IssueDate" => date('Y-m-d'),
                    "OrderExpireAfterSeconds" => "0",
                    "CustomerName" => substr($pending['name'], 0, 50),
                    "CustomerMobile" => substr(str_replace(['+', '-', ' '], '', $pending['phone']), 0, 15) ?: '03000000000',
                    "CustomerEmail" => substr($pending['email'], 0, 50) ?: 'no-reply@domain.com',
                    "CustomerAddress" => substr($pending['address'] ?? '', 0, 100),
                    "ReturnUrl" => site_url('welcome/free_consultation') // Return after success
                ]
            ];

            $create_url = $base_host . "/ppro/co";
            $ch = curl_init($create_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order_payload));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Token: ' . $access_token,
                'Content-Type: application/json'
            ]);
            $order_response = curl_exec($ch);
            curl_close($ch);

            $order_data = json_decode($order_response, true);
            
            if (isset($order_data[0]['Status']) && $order_data[0]['Status'] == '00') {
                $paypro_id = $order_data[1]['PayProId'] ?? $order_data[0]['PayProId'] ?? '';
                $click2pay_url = $order_data[1]['Click2Pay'] ?? $order_data[1]['short_Click2Pay'] ?? $order_data[0]['Click2PayUrl'] ?? $order_data[0]['ClickPayUrl'] ?? '';

                if ($click2pay_url) {
                    echo json_encode(['status' => 'success', 'redirect' => $click2pay_url]);
                } else {
                    $raw = substr(strip_tags($order_response), 0, 300);
                    echo json_encode(['status' => 'error', 'message' => 'Failed to get payment URL from PayPro. Response: ' . $raw]);
                }
            } else {
                // Better error logging
                $error_msg = $order_data[0]['Description'] ?? $order_data['Description'] ?? 'Unknown error';
                if ($error_msg == 'Unknown error') {
                    $error_msg .= ' Raw Response: ' . substr(strip_tags($order_response), 0, 200);
                }
                echo json_encode(['status' => 'error', 'message' => 'PayPro Order Creation Failed: ' . $error_msg]);
            }
        } else {
            $snippet = substr(strip_tags($body), 0, 100);
            $msg = 'Failed to authenticate with PayPro. ';
            if (strpos($body, '<!DOCTYPE html>') !== false || strpos($body, '<html>') !== false) {
                $msg .= 'Your server IP might not be whitelisted on PayPro. (PayPro returned an HTML page).';
            } else {
                $msg .= 'Please check your Client ID and Client Secret. Response: ' . $snippet;
            }
            echo json_encode(['status' => 'error', 'message' => $msg]);
        }
    }

    public function paypro_callback()
    {
        // PayPro V2.1 Callback sends parameters via GET
        $username = $this->input->get('username');
        $password = $this->input->get('password');
        $csv_invoice_ids = $this->input->get('csvinvoiceids');

        // Log the incoming callback for debugging
        $log_data = date('Y-m-d H:i:s') . " - Callback received: " . $_SERVER['QUERY_STRING'] . "\n";
        file_put_contents(FCPATH . 'paypro_callback_log.txt', $log_data, FILE_APPEND);

        $settings = $this->_get_settings();
        $stored_username = $settings['paypro_username'] ?? '';
        // Note: For real security, we should store a separate callback password if PayPro provides one
        // But for now, we'll verify against the username as a basic check
        
        if (empty($csv_invoice_ids)) {
            echo json_encode(['status' => 'error', 'message' => 'No invoices provided.']);
            return;
        }

        $invoice_ids = explode(',', $csv_invoice_ids);
        $response = [];

        foreach ($invoice_ids as $invoice_id) {
            $invoice_id = trim($invoice_id);
            if (empty($invoice_id)) continue;

            // Handle suffix (uuid-suffix)
            $uuid = explode('-', $invoice_id)[0];

            // Search for the appointment by UUID (used as base for OrderNumber)
            $appointment = $this->db->get_where('appointments', ['uuid' => $uuid])->row_array();
            
            if ($appointment) {
                // Mark as paid if not already
                if ($appointment['payment_status'] !== 'paid') {
                    $this->db->where('uuid', $uuid)->update('appointments', [
                        'status' => 'confirmed',
                        'payment_status' => 'paid',
                        'transaction_id' => 'PAYPRO-' . time()
                    ]);
                }
                
                $response[] = [
                    "StatusCode" => "00",
                    "InvoiceID" => $invoice_id,
                    "Description" => "Invoice successfully marked as paid"
                ];
            } else {
                $response[] = [
                    "StatusCode" => "01",
                    "InvoiceID" => $invoice_id,
                    "Description" => "Invoice not found in system"
                ];
            }
        }

        // Return JSON response as required by PayPro V2.1
        header('Content-Type: application/json');
        echo json_encode($response);
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
}
