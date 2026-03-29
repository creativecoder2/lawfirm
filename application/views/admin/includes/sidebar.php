<?php
$segment = $this->uri->segment(2);
$sub_segment = $this->uri->segment(3);

function is_active($current, $targets) {
    if (is_array($targets)) {
        return in_array($current, $targets) ? 'active-item' : '';
    }
    return $current == $targets ? 'active-item' : '';
}

function is_open($current, $targets) {
    return in_array($current, $targets) ? 'active' : '';
}

// Group definitions for easier maintenance
$home_mgmt_segments = ['sliders', 'features', 'testimonials', 'teams', 'case_studies', 'case_categories', 'counters', 'blogs', 'blog_categories', 'blog_comments', 'slider_add', 'slider_edit', 'feature_add', 'feature_edit', 'testimonial_add', 'testimonial_edit', 'team_add', 'team_edit', 'case_study_add', 'case_study_edit', 'case_category_add', 'case_category_edit', 'counter_add', 'counter_edit', 'blog_add', 'blog_edit', 'blog_category_add', 'blog_category_edit', 'case_study_view', 'about_us', 'about_features', 'about_feature_add', 'about_feature_edit'];

// Fetch unread notification counts globally for sidebar and header
$sidebar_ci =& get_instance();
$count_appointments = $sidebar_ci->db->where('is_read', 0)->count_all_results('appointments');
$count_contacts = $sidebar_ci->db->where('is_read', 0)->count_all_results('contact_messages');
$count_subscribers = $sidebar_ci->db->where('is_read', 0)->count_all_results('subscribers');
$total_notifications = $count_appointments + $count_contacts + $count_subscribers;
?>

<div class="sidebar-overlay" onclick="document.querySelector('.admin-sidebar').classList.remove('active'); document.querySelector('.sidebar-overlay').classList.remove('active');"></div>

<nav class="admin-sidebar">
    <div class="sidebar-brand">
        <a href="<?= site_url('admin/dashboard') ?>">
            <?php 
            $admin_logo_path = 'assets/images/logo/logo-2.png';
            $logo_setting = $this->db->get_where('settings', ['key_name' => 'admin_logo'])->row();
            if ($logo_setting && !empty($logo_setting->value)) {
                $admin_logo_path = $logo_setting->value;
            }
            ?>
            <img src="<?= base_url($admin_logo_path) ?>" alt="Logo"> 
        </a>
    </div>
    
    <ul class="nav">
        <li class="nav-item">
            <a href="<?= site_url('admin/dashboard') ?>" class="nav-link <?= is_active($segment, 'dashboard') ?>">
                <i class="fa fa-tachometer"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/appointments') ?>" class="nav-link <?= is_active($segment, ['appointments', 'appointment_view']) ?>" style="display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa fa-calendar"></i> Appointments</span>
                <span class="badge badge-danger sidebar-count-appointments" style="<?= $count_appointments > 0 ? '' : 'display: none;' ?>"><?= $count_appointments ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/contact_messages') ?>" class="nav-link <?= is_active($segment, ['contact_messages', 'contact_view']) ?>" style="display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa fa-envelope"></i> Contact Messages</span>
                <span class="badge badge-danger sidebar-count-contacts" style="<?= $count_contacts > 0 ? '' : 'display: none;' ?>"><?= $count_contacts ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/settings') ?>" class="nav-link <?= is_active($segment, 'settings') ?>">
                <i class="fa fa-cog"></i> <span>Site Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/seo_settings') ?>" class="nav-link <?= is_active($segment, 'seo_settings') ?>">
                <i class="fa fa-search"></i> <span>SEO Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/gallery') ?>" class="nav-link <?= is_active($segment, 'gallery') ?>">
                <i class="fa fa-video-camera"></i> <span>Video Gallery</span>
            </a>
        </li>
        <li class="nav-item dropdown <?= is_open($segment, ['about_us', 'about_features', 'about_feature_add', 'about_feature_edit']) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-info-circle"></i> <span>About Us Mgmt</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/about_us') ?>" class="nav-link <?= is_active($segment, 'about_us') ?>">
                        <i class="fa fa-edit"></i> Edit Content
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/about_features') ?>" class="nav-link <?= is_active($segment, ['about_features', 'about_feature_add', 'about_feature_edit']) ?>">
                        <i class="fa fa-list"></i> Features Section
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown <?= is_open($segment, ['practice', 'practice_add', 'practice_edit']) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-balance-scale"></i> <span>Practice Areas</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/practice') ?>" class="nav-link <?= is_active($segment, 'practice') ?>">
                        <i class="fa fa-list"></i> All Areas
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/practice_add') ?>" class="nav-link <?= is_active($segment, 'practice_add') ?>">
                        <i class="fa fa-plus"></i> Add New Area
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown <?= is_open($segment, ['teams', 'team_add', 'team_edit']) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-users"></i> <span>Attorneys/Team</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/teams') ?>" class="nav-link <?= is_active($segment, ['teams', 'team_add', 'team_edit']) ?>">
                        <i class="fa fa-list"></i> All Members
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/team_add') ?>" class="nav-link <?= is_active($segment, 'team_add') ?>">
                        <i class="fa fa-plus"></i> Add New Member
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown <?= is_open($segment, array_diff($home_mgmt_segments, ['teams', 'team_add', 'team_edit'])) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-home"></i> <span>Home Management</span>
            </a>
            <ul class="nav-dropdown">
                <!-- <li>
                    <a href="<?= site_url('admin/sliders') ?>" class="nav-link <?= is_active($segment, ['sliders', 'slider_add', 'slider_edit']) ?>">
                        <i class="fa fa-picture-o"></i> Sliders
                    </a>
                </li> -->
                <li>
                    <a href="<?= site_url('admin/features') ?>" class="nav-link <?= is_active($segment, ['features', 'feature_add', 'feature_edit']) ?>">
                        <i class="fa fa-th-large"></i> Home Action Cards
                    </a>
                </li>


                <li>
                    <a href="<?= site_url('admin/counters') ?>" class="nav-link <?= is_active($segment, ['counters', 'counter_add', 'counter_edit']) ?>">
                        <i class="fa fa-sort-numeric-asc"></i> Counters
                    </a>
                </li>
            </ul>
        </li>
        <!-- Case Studies -->
        <li class="nav-item dropdown <?= is_open($segment, ['case_studies', 'case_study_add', 'case_study_edit', 'case_study_view', 'case_categories', 'case_category_add', 'case_category_edit']) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-briefcase"></i> <span>Case Studies</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/case_studies') ?>" class="nav-link <?= is_active($segment, ['case_studies', 'case_study_edit', 'case_study_view']) ?>">
                        <i class="fa fa-list"></i> All Cases
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/case_study_add') ?>" class="nav-link <?= is_active($segment, 'case_study_add') ?>">
                        <i class="fa fa-plus"></i> Add New Case
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/case_categories') ?>" class="nav-link <?= is_active($segment, ['case_categories', 'case_category_add', 'case_category_edit']) ?>">
                        <i class="fa fa-tags"></i> Categories
                    </a>
                </li>
            </ul>
       
        <!-- Landmarks -->
        <li class="nav-item dropdown <?= is_open($segment, ['landmarks', 'landmark_add', 'landmark_edit']) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-briefcase"></i> <span>Landmarks</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/landmarks') ?>" class="nav-link <?= is_active($segment, 'landmarks') ?>">
                        <i class="fa fa-list"></i> All Landmarks
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/landmark_add') ?>" class="nav-link <?= is_active($segment, 'landmark_add') ?>">
                        <i class="fa fa-plus"></i> Add New Landmark
                    </a>
                </li>
            </ul>
        </li>
        <!-- Testimonials -->
        <li class="nav-item dropdown <?= is_open($segment, ['testimonials', 'testimonial_add', 'testimonial_edit']) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-quote-left"></i> <span>Testimonials</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/testimonials') ?>" class="nav-link <?= is_active($segment, ['testimonials', 'testimonial_edit']) ?>">
                        <i class="fa fa-list"></i> All Testimonials
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/testimonial_add') ?>" class="nav-link <?= is_active($segment, 'testimonial_add') ?>">
                        <i class="fa fa-plus"></i> Add New
                    </a>
                </li>
            </ul>
        </li>
        <!-- Blog Management -->
        <li class="nav-item dropdown <?= is_open($segment, ['blogs', 'blog_add', 'blog_edit', 'blog_categories', 'blog_category_add', 'blog_category_edit', 'blog_comments']) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-rss"></i> <span>Blog Management</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/blogs') ?>" class="nav-link <?= is_active($segment, ['blogs', 'blog_add', 'blog_edit']) ?>">
                        <i class="fa fa-list"></i> All Posts
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/blog_add') ?>" class="nav-link <?= is_active($segment, 'blog_add') ?>">
                        <i class="fa fa-plus"></i> Add New Post
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/blog_categories') ?>" class="nav-link <?= is_active($segment, ['blog_categories', 'blog_category_add', 'blog_category_edit']) ?>">
                        <i class="fa fa-folder-open"></i> Categories
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/blog_comments') ?>" class="nav-link <?= is_active($segment, ['blog_comments']) ?>">
                        <i class="fa fa-comments-o"></i> Comments
                    </a>
                </li>
            </ul>
        </li>
         <li class="nav-item">
            <a href="<?= site_url('admin/menus') ?>" class="nav-link <?= is_active($segment, ['menus', 'menu_add', 'menu_edit']) ?>">
                <i class="fa fa-bars"></i> <span>Menu Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/pages') ?>" class="nav-link <?= is_active($segment, ['pages', 'page_add', 'page_edit']) ?>">
                <i class="fa fa-file-text"></i> <span>Pages Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/social_links') ?>" class="nav-link <?= is_active($segment, 'social_links') ?>">
                <i class="fa fa-share-alt"></i> <span>Social Links</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/subscribers') ?>" class="nav-link <?= is_active($segment, 'subscribers') ?>" style="display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa fa-envelope"></i> Newsletter</span>
                <span class="badge badge-danger sidebar-count-subscribers" style="<?= $count_subscribers > 0 ? '' : 'display: none;' ?>"><?= $count_subscribers ?></span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/admin_profile') ?>" class="nav-link <?= is_active($segment, 'admin_profile') ?>">
                <i class="fa fa-cog"></i> <span>Admin Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/logout') ?>" class="nav-link">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
            </a>
        </li>
    </ul>
</nav>

<div class="admin-content">
    <header class="admin-header">
        <div class="header-left">
            <button class="mobile-toggle" onclick="document.querySelector('.admin-sidebar').classList.toggle('active'); document.querySelector('.sidebar-overlay').classList.toggle('active');">
                <i class="fa fa-bars"></i>
            </button>
            <h4 class="page-title"><?= ucfirst(str_replace('_', ' ', $segment)) ?></h4>
        </div>
<?php
        // Fetch detailed items
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

        // Sort by time DESC
        usort($notif_list, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });
        $notif_list = array_slice($notif_list, 0, 7); // Show top 7
        ?>
        <div class="user-menu" style="display: flex; align-items: center; gap: 20px;">
            
            <!-- Notifications Dropdown -->
            <div class="dropdown" style="position: relative;">
                <a href="#" class="dropdown-toggle text-dark" onclick="$(this).next('.dropdown-menu').toggle(); return false;" style="text-decoration: none; position: relative;">
                    <i class="fa fa-bell-o" style="font-size: 20px;"></i>
                    <?php if($total_notifications > 0): ?>
                        <span class="badge badge-danger" style="position: absolute; top: -8px; right: -10px; background: #e74c3c; color: white; border-radius: 50%; padding: 3px 6px; font-size: 10px;"><?= $total_notifications ?></span>
                    <?php endif; ?>
                </a>
                <ul class="dropdown-menu shadow-sm border-0" id="notif-dropdown" style="width: 300px; border-radius: 8px; margin-top: 10px; padding: 0; position: absolute; right: -10px; left: auto; top: 100%; z-index: 1000; display: none;">
                    <li style="padding: 10px 15px; background: #fafafa; border-bottom: 1px solid #eee; font-weight: bold; border-radius: 8px 8px 0 0; display:flex; justify-content:space-between; align-items:center;">
                        Notifications <span class="badge badge-primary"><?= $total_notifications ?> unread</span>
                    </li>
                    <div style="max-height: 300px; overflow-y: auto;">
                        <?php if(count($notif_list) > 0): ?>
                            <?php foreach($notif_list as $n): ?>
                            <li>
                                <a href="<?= $n['link'] ?>" style="padding: 10px 15px; display: flex; align-items: flex-start; gap: 10px; border-bottom: 1px solid #eee; color: #333; text-decoration: none;">
                                    <div style="width: 35px; height: 35px; border-radius: 50%; background: <?= $n['color'] ?>20; color: <?= $n['color'] ?>; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa <?= $n['icon'] ?>"></i>
                                    </div>
                                    <div style="flex-grow: 1; overflow: hidden;">
                                        <h6 style="margin: 0; font-size: 13px; font-weight: 600;"><?= $n['title'] ?></h6>
                                        <p style="margin: 0; font-size: 12px; color: #777; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis; white-space: normal;"><?= $n['msg'] ?></p>
                                        <small style="font-size: 10px; color: #aaa;"><?= date('d M, h:i A', strtotime($n['time'])) ?></small>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li style="padding: 20px; text-align: center; color: #aaa; font-size: 13px;">No new notifications</li>
                        <?php endif; ?>
                    </div>
                </ul>
            </div>

            <span class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin&background=d0a15e&color=fff" class="rounded-circle mr-2" style="width:30px; height:30px;"> 
                <?= $this->session->userdata('username'); ?>
            </span>
        </div>
    </header>
    
    <div class="container-fluid p-4">
