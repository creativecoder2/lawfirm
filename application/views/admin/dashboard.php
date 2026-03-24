<div class="content-header">
    <h1>
        Dashboard
        <small>Welcome back, <?= $this->session->userdata('username') ?>! Here's your overview.</small>
    </h1>
</div>

<!-- Row 1: Primary Stat Cards -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card" style="border-left: 4px solid #d0a15e;">
            <div class="card-icon" style="background:rgba(208,161,94,0.12); color:#d0a15e;"><i class="fa fa-eye"></i></div>
            <div class="card-info">
                <h3><?= number_format($site_views) ?></h3>
                <p>Site Views</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card" style="border-left: 4px solid #2ecc71;">
            <div class="card-icon" style="background:rgba(46,204,113,0.12); color:#2ecc71;"><i class="fa fa-calendar-check-o"></i></div>
            <div class="card-info">
                <h3><?= $total_appointments ?></h3>
                <p>Appointments</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card" style="border-left: 4px solid #3498db;">
            <div class="card-icon" style="background:rgba(52,152,219,0.12); color:#3498db;"><i class="fa fa-envelope"></i></div>
            <div class="card-info">
                <h3><?= $total_contacts ?></h3>
                <p>Contact Messages</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card" style="border-left: 4px solid #e74c3c;">
            <div class="card-icon" style="background:rgba(231,76,60,0.12); color:#e74c3c;"><i class="fa fa-dollar"></i></div>
            <div class="card-info">
                <h3>$<?= number_format($total_revenue, 2) ?></h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>
</div>

<!-- Row 2: Secondary Stat Cards -->
<div class="row">
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="dashboard-card mini-card" style="border-left:3px solid #9b59b6;">
            <div class="card-info">
                <h3><?= $total_blogs ?></h3>
                <p><i class="fa fa-rss"></i> Blog Posts</p>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="dashboard-card mini-card" style="border-left:3px solid #1abc9c;">
            <div class="card-info">
                <h3><?= $total_comments ?></h3>
                <p><i class="fa fa-comments"></i> Comments</p>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="dashboard-card mini-card" style="border-left:3px solid #e67e22;">
            <div class="card-info">
                <h3><?= $total_cases ?></h3>
                <p><i class="fa fa-briefcase"></i> Cases</p>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="dashboard-card mini-card" style="border-left:3px solid #2980b9;">
            <div class="card-info">
                <h3><?= $total_landmarks ?></h3>
                <p><i class="fa fa-map-marker"></i> Landmarks</p>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="dashboard-card mini-card" style="border-left:3px solid #16a085;">
            <div class="card-info">
                <h3><?= $total_team ?></h3>
                <p><i class="fa fa-users"></i> Team</p>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-sm-6">
        <div class="dashboard-card mini-card" style="border-left:3px solid #f39c12;">
            <div class="card-info">
                <h3><?= $total_practice ?></h3>
                <p><i class="fa fa-balance-scale"></i> Practices</p>
            </div>
        </div>
    </div>
</div>

<!-- Revenue Trend Chart -->
<div class="row" style="margin-top:10px;">
    <div class="col-lg-12">
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-dollar" style="color:#e74c3c;"></i> Revenue Trend (Last 6 Months)</h3>
            </div>
            <div class="box-body" style="padding:20px;">
                <canvas id="revenueChart" height="70"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Row 3: Charts -->
<div class="row" style="margin-top:10px;">
    <div class="col-lg-8">
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-line-chart" style="color:#d0a15e;"></i> Appointments & Contacts (Last 6 Months)</h3>
            </div>
            <div class="box-body" style="padding:20px;">
                <canvas id="mainChart" height="110"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-pie-chart" style="color:#d0a15e;"></i> Revenue by Channel</h3>
            </div>
            <div class="box-body" style="padding:20px;">
                <?php if(!empty($payment_channels)): ?>
                <canvas id="paymentChart" height="200"></canvas>
                <?php else: ?>
                <div class="text-center" style="padding:40px 0; color:#ccc;">
                    <i class="fa fa-pie-chart" style="font-size:40px;"></i>
                    <p style="margin-top:10px;">No payment data yet</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- Payment Channel Breakdown -->
        <?php if(!empty($payment_channels)): ?>
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-credit-card" style="color:#d0a15e;"></i> Payment Breakdown</h3>
            </div>
            <div class="box-body" style="padding:0;">
                <table class="table table-striped" style="margin:0;">
                    <thead><tr><th>Channel</th><th class="text-center">Count</th><th class="text-right">Amount</th></tr></thead>
                    <tbody>
                    <?php foreach($payment_channels as $ch): ?>
                    <tr>
                        <td>
                            <?php 
                            $method = strtolower($ch['payment_method'] ?? 'other');
                            $icons = ['easypaisa'=>'fa-mobile','jazzcash'=>'fa-mobile','paypal'=>'fa-paypal','stripe'=>'fa-cc-stripe','bank'=>'fa-university','manual'=>'fa-money'];
                            $colors = ['easypaisa'=>'#2ecc71','jazzcash'=>'#e74c3c','paypal'=>'#003087','stripe'=>'#6772e5','bank'=>'#3498db','manual'=>'#f39c12'];
                            $icon = $icons[$method] ?? 'fa-money';
                            $color = $colors[$method] ?? '#999';
                            ?>
                            <i class="fa <?= $icon ?>" style="color:<?= $color ?>; width:20px;"></i>
                            <strong><?= ucfirst($ch['payment_method'] ?? 'Other') ?></strong>
                        </td>
                        <td class="text-center"><span class="label label-default"><?= $ch['cnt'] ?></span></td>
                        <td class="text-right"><strong>$<?= number_format($ch['total'], 2) ?></strong></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Row 4: Recent Tables -->
<div class="row">
    <!-- Recent Appointments -->
    <div class="col-lg-6">
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-calendar" style="color:#2ecc71;"></i> Recent Appointments</h3>
                <a href="<?= site_url('admin/appointments') ?>" class="pull-right" style="color:#d0a15e; font-size:12px; margin-top:3px;">View All →</a>
            </div>
            <div class="box-body" style="padding:0;">
                <?php if(!empty($recent_appointments)): ?>
                <table class="table" style="margin:0;">
                    <thead><tr><th>Name</th><th>Email</th><th>Status</th></tr></thead>
                    <tbody>
                    <?php foreach($recent_appointments as $apt): ?>
                    <tr>
                        <td><strong><?= $apt['name'] ?? '-' ?></strong></td>
                        <td style="color:#888; font-size:12px;"><?= $apt['email'] ?? '-' ?></td>
                        <td>
                            <?php 
                            $st = strtolower($apt['payment_status'] ?? 'pending');
                            $badge = $st == 'paid' ? 'success' : ($st == 'failed' ? 'danger' : 'warning');
                            ?>
                            <span class="label label-<?= $badge ?>"><?= ucfirst($st) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-center text-muted" style="padding:30px;">No appointments yet</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Contact Messages -->
    <div class="col-lg-6">
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-envelope" style="color:#3498db;"></i> Recent Contact Messages</h3>
                <a href="<?= site_url('admin/contact_messages') ?>" class="pull-right" style="color:#d0a15e; font-size:12px; margin-top:3px;">View All →</a>
            </div>
            <div class="box-body" style="padding:0;">
                <?php if(!empty($recent_contacts)): ?>
                <table class="table" style="margin:0;">
                    <thead><tr><th>Name</th><th>Subject</th><th>Date</th></tr></thead>
                    <tbody>
                    <?php foreach($recent_contacts as $ct): ?>
                    <tr>
                        <td><strong><?= $ct['name'] ?? '-' ?></strong></td>
                        <td style="color:#888; font-size:12px;"><?= isset($ct['subject']) ? substr($ct['subject'], 0, 30) : (isset($ct['message']) ? substr($ct['message'], 0, 30).'...' : '-') ?></td>
                        <td style="font-size:12px; color:#aaa;"><?= isset($ct['created_at']) ? date('M d', strtotime($ct['created_at'])) : '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-center text-muted" style="padding:30px;">No messages yet</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Row 5: Recent Blog Comments -->
<div class="row">
    <div class="col-lg-8">
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-comments" style="color:#9b59b6;"></i> Recent Blog Comments</h3>
                <a href="<?= site_url('admin/blog_comments') ?>" class="pull-right" style="color:#d0a15e; font-size:12px; margin-top:3px;">View All →</a>
            </div>
            <div class="box-body" style="padding:0;">
                <?php if(!empty($recent_comments)): ?>
                <table class="table" style="margin:0;">
                    <thead><tr><th>Author</th><th>Comment</th><th>Date</th></tr></thead>
                    <tbody>
                    <?php foreach($recent_comments as $cm): ?>
                    <tr>
                        <td><strong><?= $cm['name'] ?? $cm['author'] ?? '-' ?></strong></td>
                        <td style="color:#666; font-size:12px;"><?= substr($cm['comment'] ?? $cm['content'] ?? '-', 0, 50) ?>...</td>
                        <td style="font-size:12px; color:#aaa;"><?= isset($cm['created_at']) ? date('M d', strtotime($cm['created_at'])) : '-' ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p class="text-center text-muted" style="padding:30px;">No comments yet</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="box" style="border-radius:10px; overflow:hidden;">
            <div class="box-header with-border" style="background:#fafafa;">
                <h3 class="box-title"><i class="fa fa-bolt" style="color:#f39c12;"></i> Quick Actions</h3>
            </div>
            <div class="box-body">
                <a href="<?= site_url('admin/blog_add') ?>" class="btn btn-block" style="background:#9b59b6; color:#fff; margin-bottom:8px; border-radius:6px;"><i class="fa fa-plus"></i> New Blog Post</a>
                <a href="<?= site_url('admin/case_study_add') ?>" class="btn btn-block" style="background:#3498db; color:#fff; margin-bottom:8px; border-radius:6px;"><i class="fa fa-plus"></i> Add Case Study</a>
                <a href="<?= site_url('admin/team_add') ?>" class="btn btn-block" style="background:#2ecc71; color:#fff; margin-bottom:8px; border-radius:6px;"><i class="fa fa-plus"></i> Add Team Member</a>
                <a href="<?= site_url('admin/landmark_add') ?>" class="btn btn-block" style="background:#e67e22; color:#fff; margin-bottom:8px; border-radius:6px;"><i class="fa fa-plus"></i> Add Landmark</a>
                <a href="<?= site_url('admin/seo_settings') ?>" class="btn btn-block" style="background:#1abc9c; color:#fff; margin-bottom:8px; border-radius:6px;"><i class="fa fa-search"></i> SEO Settings</a>
                <a href="<?= site_url('admin/settings') ?>" class="btn btn-block" style="background:#d0a15e; color:#fff; border-radius:6px;"><i class="fa fa-cog"></i> Site Settings</a>
            </div>
        </div>
    </div>
</div>

<!-- Row 6: Horizontal Sliders (Blogs & Cases) -->
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
.dash-slider-box { border-radius:10px; overflow:hidden; margin-bottom: 20px; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.dash-slider-header { background:#fafafa; padding: 15px 20px; border-bottom: 1px solid #f4f4f4; display: flex; justify-content: space-between; align-items: center; }
.dash-slider-header h3 { margin: 0; font-size: 16px; font-weight: 600; }
.swiper-slide { height: auto; display: flex; }
.slider-card { 
    display: flex; flex-direction: column; width: 100%; 
    border: 1px solid #eee; border-radius: 8px; overflow: hidden; 
    transition: all 0.3s ease; text-decoration: none !important; color: #333;
}
.slider-card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-color: #d0a15e; }
.slider-img { width: 100%; height: 140px; object-fit: cover; border-bottom: 1px solid #eee; }
.slider-content { padding: 12px 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
.slider-title { font-weight: 600; font-size: 14px; margin: 0 0 5px 0; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.slider-meta { font-size: 11px; color: #888; margin: 0; }
.swiper-button-next, .swiper-button-prev { color: #d0a15e !important; transform: scale(0.6); }
.swiper-pagination-bullet-active { background: #d0a15e !important; }
</style>

<div class="row mt-3">
    <!-- Blogs Slider -->
    <div class="col-lg-6">
        <div class="dash-slider-box">
            <div class="dash-slider-header">
                <h3><i class="fa fa-rss" style="color:#d0a15e;"></i> Recent Blog Posts</h3>
                <a href="<?= site_url('admin/blogs') ?>" style="color:#d0a15e; font-size:12px;">View All →</a>
            </div>
            <div class="box-body" style="padding: 15px 20px 30px;">
                <?php if(!empty($slider_blogs)): ?>
                <div class="swiper dash-blogs-swiper" style="padding-bottom: 30px;">
                    <div class="swiper-wrapper">
                        <?php foreach($slider_blogs as $blog): ?>
                        <div class="swiper-slide">
                            <a href="<?= site_url('blog_detail/' . $blog['slug']) ?>" target="_blank" class="slider-card" style="border-left: 3px solid #d0a15e; position: relative;">
                                <?php if($blog['is_active'] == 1): ?>
                                    <span style="position:absolute; top:8px; right:8px; background:#2ecc71; color:#fff; font-size:10px; padding:2px 6px; border-radius:12px; font-weight:bold; z-index:10;">Active</span>
                                <?php else: ?>
                                    <span style="position:absolute; top:8px; right:8px; background:#e74c3c; color:#fff; font-size:10px; padding:2px 6px; border-radius:12px; font-weight:bold; z-index:10;">Inactive</span>
                                <?php endif; ?>
                                <?php $img = !empty($blog['image']) ? base_url($blog['image']) : base_url('assets/images/placeholder.jpg'); ?>
                                <img src="<?= $img ?>" class="slider-img" alt="Blog Image">
                                <div class="slider-content">
                                    <h4 class="slider-title"><?= $blog['title'] ?></h4>
                                    <p class="slider-meta">
                                        <i class="fa fa-folder-open-o"></i> <?= !empty($blog['category_name']) ? $blog['category_name'] : 'General' ?> &nbsp;|&nbsp;
                                        <i class="fa fa-calendar"></i> <?= !empty($blog['date_published']) ? date('M d, Y', strtotime($blog['date_published'])) : 'Unknown Date' ?>
                                    </p>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev" style="margin-top:-15px;"></div>
                    <div class="swiper-button-next" style="margin-top:-15px;"></div>
                </div>
                <?php else: ?>
                <p class="text-center text-muted" style="padding:20px;">No blog posts found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Case Studies Slider -->
    <div class="col-lg-6">
        <div class="dash-slider-box">
            <div class="dash-slider-header">
                <h3><i class="fa fa-briefcase" style="color:#3498db;"></i> Recent Case Studies</h3>
                <a href="<?= site_url('admin/case_studies') ?>" style="color:#3498db; font-size:12px;">View All →</a>
            </div>
            <div class="box-body" style="padding: 15px 20px 30px;">
                <?php if(!empty($slider_cases)): ?>
                <div class="swiper dash-cases-swiper" style="padding-bottom: 30px;">
                    <div class="swiper-wrapper">
                        <?php foreach($slider_cases as $case): ?>
                        <div class="swiper-slide">
                            <a href="<?= site_url('case_studies_details/' . $case['slug']) ?>" target="_blank" class="slider-card" style="border-left: 3px solid #3498db; position: relative;">
                                <?php if($case['is_active'] == 1): ?>
                                    <span style="position:absolute; top:8px; right:8px; background:#2ecc71; color:#fff; font-size:10px; padding:2px 6px; border-radius:12px; font-weight:bold; z-index:10;">Active</span>
                                <?php else: ?>
                                    <span style="position:absolute; top:8px; right:8px; background:#e74c3c; color:#fff; font-size:10px; padding:2px 6px; border-radius:12px; font-weight:bold; z-index:10;">Inactive</span>
                                <?php endif; ?>
                                <?php $img = !empty($case['image']) ? base_url($case['image']) : base_url('assets/images/placeholder.jpg'); ?>
                                <img src="<?= $img ?>" class="slider-img" alt="Case Image">
                                <div class="slider-content">
                                    <h4 class="slider-title"><?= $case['title'] ?></h4>
                                    <p class="slider-meta"><i class="fa fa-folder-open-o"></i> <?= !empty($case['category_name']) ? $case['category_name'] : 'General' ?></p>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev" style="margin-top:-15px;"></div>
                    <div class="swiper-button-next" style="margin-top:-15px;"></div>
                </div>
                <?php else: ?>
                <p class="text-center text-muted" style="padding:20px;">No case studies found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Blogs Swiper
    new Swiper('.dash-blogs-swiper', {
        slidesPerView: 1, spaceBetween: 15,
        navigation: { nextEl: '.dash-blogs-swiper .swiper-button-next', prevEl: '.dash-blogs-swiper .swiper-button-prev' },
        pagination: { el: '.dash-blogs-swiper .swiper-pagination', clickable: true },
        breakpoints: { 640: { slidesPerView: 2, spaceBetween: 20 } }
    });
    // Cases Swiper
    new Swiper('.dash-cases-swiper', {
        slidesPerView: 1, spaceBetween: 15,
        navigation: { nextEl: '.dash-cases-swiper .swiper-button-next', prevEl: '.dash-cases-swiper .swiper-button-prev' },
        pagination: { el: '.dash-cases-swiper .swiper-pagination', clickable: true },
        breakpoints: { 640: { slidesPerView: 2, spaceBetween: 20 } }
    });
});
</script>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Bar Chart: Revenue Trend
    var revCtx = document.getElementById('revenueChart');
    if (revCtx) {
        new Chart(revCtx, {
            type: 'bar',
            data: {
                labels: <?= $chart_labels ?>,
                datasets: [{
                    label: 'Revenue ($)',
                    data: <?= $chart_revenue ?? '[]' ?>,
                    backgroundColor: 'rgba(231,76,60,0.85)',
                    borderColor: '#c0392b',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { callbacks: { label: function(c) { return '$' + c.raw; } } }
                },
                scales: {
                    y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // Line Chart: Appointments & Contacts
    var ctx = document.getElementById('mainChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= $chart_labels ?>,
                datasets: [
                    {
                        label: 'Appointments',
                        data: <?= $chart_appointments ?>,
                        borderColor: '#2ecc71',
                        backgroundColor: 'rgba(46,204,113,0.08)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#2ecc71',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Contacts',
                        data: <?= $chart_contacts ?>,
                        borderColor: '#3498db',
                        backgroundColor: 'rgba(52,152,219,0.08)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#3498db',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top', labels: { usePointStyle: true, padding: 20 } }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.04)' } },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // Pie Chart: Payment Channels
    <?php if(!empty($payment_channels)): ?>
    var pie = document.getElementById('paymentChart');
    if (pie) {
        var channelColors = {
            'easypaisa': '#2ecc71', 'jazzcash': '#e74c3c', 'paypal': '#003087',
            'stripe': '#6772e5', 'bank': '#3498db', 'manual': '#f39c12'
        };
        var labels = <?= json_encode(array_map(function($c){ return ucfirst($c['payment_method'] ?? 'Other'); }, $payment_channels)) ?>;
        var amounts = <?= json_encode(array_map(function($c){ return (float)$c['total']; }, $payment_channels)) ?>;
        var colors = <?= json_encode(array_map(function($c) {
            $m = strtolower($c['payment_method'] ?? 'other');
            $map = ['easypaisa'=>'#2ecc71','jazzcash'=>'#e74c3c','paypal'=>'#003087','stripe'=>'#6772e5','bank'=>'#3498db','manual'=>'#f39c12'];
            return $map[$m] ?? '#95a5a6';
        }, $payment_channels)) ?>;
        
        new Chart(pie, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: amounts,
                    backgroundColor: colors,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 12, font: { size: 11 } } }
                },
                cutout: '65%'
            }
        });
    }
    <?php endif; ?>
});
</script>

<style>
.mini-card {
    padding: 15px 18px !important;
}
.mini-card .card-info h3 {
    font-size: 22px !important;
    margin-bottom: 2px !important;
}
.mini-card .card-info p {
    font-size: 11px !important;
    color: #999 !important;
}
.dashboard-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}
</style>
