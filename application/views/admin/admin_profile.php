<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-circle"></i> Admin Profile
            <small>Manage your account & site logo</small>
        </h1>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Left: Profile & Password -->
            <div class="col-md-7">
                <!-- Profile Info Card -->
                <div class="box box-primary" style="border-top: 3px solid #d0a15e;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-id-card"></i> Account Information</h3>
                    </div>
                    <div class="box-body">
                        <div style="display:flex; align-items:center; gap:20px; padding:15px; background:#fdf8f0; border-radius:8px; margin-bottom:15px;">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($admin_user->username) ?>&background=d0a15e&color=fff&size=80" 
                                 style="border-radius:50%; border:3px solid #d0a15e; width:80px; height:80px;">
                            <div>
                                <h4 style="margin:0; font-weight:700; color:#333;"><?= ucfirst($admin_user->username) ?></h4>
                                <p style="margin:5px 0 0; color:#888;">
                                    <i class="fa fa-envelope"></i> <?= $admin_user->email ?: 'No email set' ?>
                                </p>
                                <small style="color:#aaa;"><i class="fa fa-shield"></i> Administrator</small>
                            </div>
                        </div>

                        <form method="post" action="<?= site_url('admin/update_profile') ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-user"></i> Username</label>
                                        <input type="text" name="username" class="form-control" value="<?= $admin_user->username ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><i class="fa fa-envelope"></i> Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= $admin_user->email ?>" placeholder="admin@example.com">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="background:#d0a15e; border-color:#d0a15e;">
                                <i class="fa fa-save"></i> Update Profile
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Change Password Card -->
                <div class="box box-danger" style="border-top: 3px solid #e74c3c;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-lock"></i> Change Password</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="<?= site_url('admin/change_password') ?>" id="passwordForm">
                            <div class="form-group">
                                <label>Current Password</label>
                                <div style="background:#fdf8f0; border:1px solid #f0e0c8; border-radius:6px; padding:8px 12px; margin-bottom:8px; font-size:13px;">
                                    <i class="fa fa-info-circle" style="color:#d0a15e;"></i>
                                    Your current password: <strong style="font-family:monospace; letter-spacing:1px;"><?= $admin_user->password ?></strong>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="current_password" class="form-control" id="currentPass" required placeholder="Enter current password">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="togglePass('currentPass', this)"><i class="fa fa-eye"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <div class="input-group">
                                    <input type="password" name="new_password" class="form-control" id="newPass" required placeholder="Minimum 6 characters" minlength="6">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="togglePass('newPass', this)"><i class="fa fa-eye"></i></button>
                                    </span>
                                </div>
                                <!-- Password Strength -->
                                <div style="margin-top:8px;">
                                    <div style="height:4px; background:#e0e0e0; border-radius:2px; overflow:hidden;">
                                        <div id="strengthBar" style="height:100%; width:0%; transition:all 0.3s;"></div>
                                    </div>
                                    <small id="strengthText" style="color:#999;">Password strength</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Confirm New Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirm_password" class="form-control" id="confirmPass" required placeholder="Re-enter new password">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" onclick="togglePass('confirmPass', this)"><i class="fa fa-eye"></i></button>
                                    </span>
                                </div>
                                <small id="matchMsg" style="display:none; margin-top:5px;"></small>
                            </div>
                            <button type="submit" class="btn btn-danger" id="changePassBtn">
                                <i class="fa fa-key"></i> Change Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right: Logo Management -->
            <div class="col-md-5">
                <!-- Site Logo -->
                <div class="box box-success" style="border-top: 3px solid #2ecc40;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-image"></i> Site Logo</h3>
                    </div>
                    <div class="box-body text-center">
                        <div style="background:#f9f9f9; border:2px dashed #ddd; border-radius:10px; padding:30px; margin-bottom:15px;">
                            <?php 
                            $current_logo = !empty($settings['site_logo']) ? base_url($settings['site_logo']) : base_url('assets/images/logo/logo-2.png');
                            ?>
                            <img src="<?= $current_logo ?>" id="logoPreview" 
                                 style="max-height:120px; max-width:100%; margin-bottom:10px;">
                            <p style="color:#999; margin:0;"><small>Current Logo</small></p>
                        </div>
                        <form method="post" action="<?= site_url('admin/update_logo') ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="btn btn-default btn-block" style="cursor:pointer; border:1px dashed #bbb; padding:12px;">
                                    <i class="fa fa-cloud-upload"></i> Choose New Logo
                                    <input type="file" name="site_logo" accept="image/*" style="display:none;" onchange="previewLogo(this)">
                                </label>
                                <small class="text-muted">PNG or SVG recommended. Max 2MB.</small>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fa fa-upload"></i> Upload & Save Logo
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Admin Panel / Sidebar Logo -->
                <div class="box box-warning" style="border-top: 3px solid #d0a15e;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-columns"></i> Admin Panel Logo <small>(Sidebar)</small></h3>
                    </div>
                    <div class="box-body text-center">
                        <div style="background:#1a1a2e; border:2px dashed #444; border-radius:10px; padding:25px; margin-bottom:15px;">
                            <?php 
                            $admin_logo = !empty($settings['admin_logo']) ? base_url($settings['admin_logo']) : base_url('assets/images/logo/logo-2.png');
                            ?>
                            <img src="<?= $admin_logo ?>" id="adminLogoPreview" 
                                 style="max-height:80px; max-width:100%; margin-bottom:10px;">
                            <p style="color:#888; margin:0;"><small>This logo appears in the admin sidebar</small></p>
                        </div>
                        <form method="post" action="<?= site_url('admin/update_admin_logo') ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="btn btn-default btn-block" style="cursor:pointer; border:1px dashed #bbb; padding:12px;">
                                    <i class="fa fa-cloud-upload"></i> Choose Admin Logo
                                    <input type="file" name="admin_logo" accept="image/*" style="display:none;" onchange="previewAdminLogo(this)">
                                </label>
                                <small class="text-muted">Light/white logo works best on dark sidebar.</small>
                            </div>
                            <button type="submit" class="btn btn-block" style="background:#d0a15e; border-color:#d0a15e; color:#fff; font-weight:600;">
                                <i class="fa fa-upload"></i> Upload Admin Logo
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Favicon -->
                <div class="box box-info" style="border-top: 3px solid #3498db;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-bookmark"></i> Favicon</h3>
                    </div>
                    <div class="box-body text-center">
                        <div style="background:#f9f9f9; border:2px dashed #ddd; border-radius:10px; padding:20px; margin-bottom:15px;">
                            <?php 
                            $current_favicon = base_url('assets/images/icon.png');
                            ?>
                            <img src="<?= $current_favicon ?>" id="faviconPreview" 
                                 style="max-height:64px; max-width:64px; margin-bottom:10px;">
                            <p style="color:#999; margin:0;"><small>Current Favicon (32x32 or 64x64)</small></p>
                        </div>
                        <form method="post" action="<?= site_url('admin/update_favicon') ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="btn btn-default btn-block" style="cursor:pointer; border:1px dashed #bbb; padding:12px;">
                                    <i class="fa fa-cloud-upload"></i> Choose Favicon
                                    <input type="file" name="favicon" accept="image/png,image/x-icon" style="display:none;" onchange="previewFavicon(this)">
                                </label>
                            </div>
                            <button type="submit" class="btn btn-info btn-block">
                                <i class="fa fa-upload"></i> Upload Favicon
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Toggle password visibility
function togglePass(id, btn) {
    var el = document.getElementById(id);
    if (el.type === 'password') {
        el.type = 'text';
        btn.querySelector('i').className = 'fa fa-eye-slash';
    } else {
        el.type = 'password';
        btn.querySelector('i').className = 'fa fa-eye';
    }
}

// Password strength meter
document.getElementById('newPass').addEventListener('input', function() {
    var val = this.value;
    var bar = document.getElementById('strengthBar');
    var txt = document.getElementById('strengthText');
    var score = 0;
    if (val.length >= 6) score++;
    if (val.length >= 10) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    var levels = [
        { w: '20%', c: '#e74c3c', t: 'Very Weak' },
        { w: '40%', c: '#e67e22', t: 'Weak' },
        { w: '60%', c: '#f1c40f', t: 'Fair' },
        { w: '80%', c: '#2ecc71', t: 'Strong' },
        { w: '100%', c: '#27ae60', t: 'Very Strong' }
    ];
    var l = levels[Math.min(score, 4)];
    bar.style.width = val ? l.w : '0%';
    bar.style.background = val ? l.c : '#e0e0e0';
    txt.textContent = val ? l.t : 'Password strength';
    txt.style.color = val ? l.c : '#999';
});

// Confirm password match
document.getElementById('confirmPass').addEventListener('input', function() {
    var msg = document.getElementById('matchMsg');
    var newP = document.getElementById('newPass').value;
    msg.style.display = 'block';
    if (this.value === newP) {
        msg.innerHTML = '<i class="fa fa-check"></i> Passwords match';
        msg.style.color = '#2ecc71';
    } else {
        msg.innerHTML = '<i class="fa fa-times"></i> Passwords do not match';
        msg.style.color = '#e74c3c';
    }
});

// Form validation
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    var newP = document.getElementById('newPass').value;
    var confP = document.getElementById('confirmPass').value;
    if (newP !== confP) {
        e.preventDefault();
        alert('New password and Confirm password do not match!');
    }
});

// Logo preview
function previewLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { document.getElementById('logoPreview').src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
    }
}
function previewFavicon(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { document.getElementById('faviconPreview').src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
    }
}
function previewAdminLogo(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { document.getElementById('adminLogoPreview').src = e.target.result; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
