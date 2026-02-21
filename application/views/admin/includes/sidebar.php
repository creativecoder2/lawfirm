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
$home_mgmt_segments = ['sliders', 'features', 'practice', 'testimonials', 'teams', 'case_studies', 'case_categories', 'counters', 'blogs', 'blog_categories', 'blog_comments', 'slider_add', 'slider_edit', 'feature_add', 'feature_edit', 'practice_add', 'practice_edit', 'testimonial_add', 'testimonial_edit', 'team_add', 'team_edit', 'case_study_add', 'case_study_edit', 'case_category_add', 'case_category_edit', 'counter_add', 'counter_edit', 'blog_add', 'blog_edit', 'blog_category_add', 'blog_category_edit', 'case_study_view'];
?>

<div class="sidebar-overlay" onclick="document.querySelector('.admin-sidebar').classList.remove('active'); document.querySelector('.sidebar-overlay').classList.remove('active');"></div>

<nav class="admin-sidebar">
    <div class="sidebar-brand">
        <a href="<?= site_url('admin/dashboard') ?>">
            <img src="<?= base_url('assets/images/logo/logo-2.png') ?>" alt="Logo"> 
        </a>
    </div>
    
    <ul class="nav">
        <li class="nav-item">
            <a href="<?= site_url('admin/dashboard') ?>" class="nav-link <?= is_active($segment, 'dashboard') ?>">
                <i class="fa fa-tachometer"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/settings') ?>" class="nav-link <?= is_active($segment, 'settings') ?>">
                <i class="fa fa-cog"></i> <span>Site Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/menus') ?>" class="nav-link <?= is_active($segment, 'menus') ?>">
                <i class="fa fa-bars"></i> <span>Menu Management</span>
            </a>
        </li>
        <li class="nav-item dropdown <?= is_open($segment, $home_mgmt_segments) ?>">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" onclick="this.parentElement.classList.toggle('active')">
                <i class="fa fa-home"></i> <span>Home Management</span>
            </a>
            <ul class="nav-dropdown">
                <li>
                    <a href="<?= site_url('admin/sliders') ?>" class="nav-link <?= is_active($segment, ['sliders', 'slider_add', 'slider_edit']) ?>">
                        <i class="fa fa-picture-o"></i> Sliders
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/features') ?>" class="nav-link <?= is_active($segment, ['features', 'feature_add', 'feature_edit']) ?>">
                        <i class="fa fa-star"></i> Features
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/practice') ?>" class="nav-link <?= is_active($segment, ['practice', 'practice_add', 'practice_edit']) ?>">
                        <i class="fa fa-balance-scale"></i> Practice Areas
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/testimonials') ?>" class="nav-link <?= is_active($segment, ['testimonials', 'testimonial_add', 'testimonial_edit']) ?>">
                        <i class="fa fa-comments"></i> Testimonials
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/teams') ?>" class="nav-link <?= is_active($segment, ['teams', 'team_add', 'team_edit']) ?>">
                        <i class="fa fa-users"></i> Team Members
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/case_studies') ?>" class="nav-link <?= is_active($segment, ['case_studies', 'case_study_add', 'case_study_edit', 'case_study_view']) ?>">
                        <i class="fa fa-briefcase"></i> Case Studies
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/case_categories') ?>" class="nav-link <?= is_active($segment, ['case_categories', 'case_category_add', 'case_category_edit']) ?>">
                        <i class="fa fa-tags"></i> Case Categories
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/counters') ?>" class="nav-link <?= is_active($segment, ['counters', 'counter_add', 'counter_edit']) ?>">
                        <i class="fa fa-sort-numeric-asc"></i> Counters
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/blogs') ?>" class="nav-link <?= is_active($segment, ['blogs', 'blog_add', 'blog_edit']) ?>">
                        <i class="fa fa-rss"></i> Blog Posts
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/blog_categories') ?>" class="nav-link <?= is_active($segment, ['blog_categories', 'blog_category_add', 'blog_category_edit']) ?>">
                        <i class="fa fa-folder-open"></i> Blog Categories
                    </a>
                </li>
                <li>
                    <a href="<?= site_url('admin/blog_comments') ?>" class="nav-link <?= is_active($segment, ['blog_comments']) ?>">
                        <i class="fa fa-comments-o"></i> Blog Comments
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/social_links') ?>" class="nav-link <?= is_active($segment, 'social_links') ?>">
                <i class="fa fa-share-alt"></i> <span>Social Links</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('admin/subscribers') ?>" class="nav-link <?= is_active($segment, 'subscribers') ?>">
                <i class="fa fa-envelope"></i> <span>Newsletter</span>
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
        <div class="user-menu">
            <span class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin&background=d0a15e&color=fff" class="rounded-circle mr-2"> 
                <?= $this->session->userdata('username'); ?>
            </span>
        </div>
    </header>
    
    <div class="container-fluid p-4">
