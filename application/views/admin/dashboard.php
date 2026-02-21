<div class="content-header">
    <h1>
        Dashboard
        <small>Welcome back! Here's what's happening today.</small>
    </h1>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card">
            <div class="card-icon"><i class="fa fa-file-text"></i></div>
            <div class="card-info">
                <h3>12</h3>
                <p>Blog Posts</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card">
            <div class="card-icon"><i class="fa fa-briefcase"></i></div>
            <div class="card-info">
                <h3>25</h3>
                <p>Active Cases</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card">
            <div class="card-icon"><i class="fa fa-balance-scale"></i></div>
            <div class="card-info">
                <h3>8</h3>
                <p>Practice Areas</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="dashboard-card">
            <div class="card-icon"><i class="fa fa-users"></i></div>
            <div class="card-info">
                <h3>15</h3>
                <p>Team Members</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Recent System Activity</h3>
            </div>
            <div class="box-body">
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/3248/3248065.png" alt="Empty" style="width: 80px; opacity: 0.3; margin-bottom: 20px;">
                    <p class="text-muted">No recent activity logs found. Your system is running smoothly.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quick Shortcuts</h3>
            </div>
            <div class="box-body">
                <div class="d-flex flex-column gap-2">
                    <a href="<?= base_url('admin/blog_add') ?>" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> New Blog Post</a>
                    <a href="<?= base_url('admin/case_study_add') ?>" class="btn btn-info btn-block"><i class="fa fa-plus"></i> Add Case Study</a>
                    <a href="<?= base_url('admin/settings') ?>" class="btn btn-warning btn-block"><i class="fa fa-cog"></i> Site Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
