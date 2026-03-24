<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Law Firm</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #1a150e 0%, #2d2318 50%, #1a150e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            margin: 0;
        }
        .login-card {
            background: #fff;
            padding: 45px 40px 35px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 420px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #d0a15e, #e8c88a, #d0a15e);
        }
        .login-card .logo-wrap {
            margin-bottom: 25px;
        }
        .login-card .logo-wrap img {
            max-height: 60px;
            filter: drop-shadow(0 2px 8px rgba(208,161,94,0.3));
        }
        .login-card h2 {
            margin: 0 0 8px;
            color: #1a150e;
            font-weight: 700;
            font-size: 24px;
            letter-spacing: -0.5px;
        }
        .login-card .subtitle {
            color: #999;
            font-size: 13px;
            margin-bottom: 28px;
        }
        .alert {
            font-size: 13px;
            border-radius: 8px;
            padding: 10px 14px;
            margin-bottom: 20px;
            text-align: left;
        }

        /* Input styling */
        .field-group {
            position: relative;
            margin-bottom: 18px;
        }
        .field-group .field-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 14px;
            z-index: 2;
            pointer-events: none;
        }
        .field-group input.field-input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 2px solid #e8e8e8;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #333;
            background: #fafafa;
            outline: none;
            transition: all 0.25s ease;
        }
        .field-group input.field-input:focus {
            border-color: #d0a15e;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(208,161,94,0.12);
        }
        .field-group input.field-input::placeholder {
            color: #bbb;
        }
        .field-group .eye-btn {
            position: absolute;
            right: 4px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #bbb;
            font-size: 15px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .field-group .eye-btn:hover {
            color: #d0a15e;
            background: rgba(208,161,94,0.08);
        }

        /* Remember Me */
        .remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 22px;
        }
        .remember-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #d0a15e;
            cursor: pointer;
            margin: 0;
        }
        .remember-row label {
            margin: 0;
            font-size: 13px;
            color: #777;
            cursor: pointer;
            user-select: none;
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, #d0a15e, #c08e4a);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }
        .btn-login:hover {
            background: linear-gradient(135deg, #c08e4a, #a07838);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(208,161,94,0.35);
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .btn-login i {
            margin-right: 6px;
        }

        .footer-text {
            margin-top: 24px;
            font-size: 12px;
            color: #bbb;
        }

        @media (max-width: 480px) {
            .login-card {
                margin: 15px;
                padding: 35px 25px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-wrap">
            <?php 
            $login_logo = 'assets/images/logo/logo-2.png';
            $ci =& get_instance();
            $logo_row = $ci->db->get_where('settings', ['key_name' => 'admin_logo'])->row();
            if ($logo_row && !empty($logo_row->value)) {
                $login_logo = $logo_row->value;
            }
            ?>
            <img src="<?= base_url($login_logo) ?>" alt="Logo">
        </div>
        <h2>Welcome Back</h2>
        <p class="subtitle">Sign in to your admin panel</p>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/login_post') ?>" method="post">
            <div class="field-group">
                <i class="fa fa-user field-icon"></i>
                <input type="text" name="username" class="field-input" placeholder="Username or Email" required autocomplete="username">
            </div>
            <div class="field-group">
                <i class="fa fa-lock field-icon"></i>
                <input type="password" name="password" id="loginPass" class="field-input" placeholder="Password" required autocomplete="current-password" style="padding-right:48px;">
                <button type="button" class="eye-btn" id="toggleEye">
                    <i class="fa fa-eye" id="eyeIcon"></i>
                </button>
            </div>
            <div class="remember-row">
                <input type="checkbox" name="remember_me" id="rememberMe" value="1">
                <label for="rememberMe">Remember me for 30 days</label>
            </div>
            <button type="submit" class="btn-login"><i class="fa fa-sign-in"></i> Sign In</button>
        </form>
        <p class="footer-text">&copy; <?= date('Y') ?> Legal Eagle Law Firm</p>
    </div>

    <script>
    document.getElementById('toggleEye').addEventListener('click', function() {
        var pass = document.getElementById('loginPass');
        var icon = document.getElementById('eyeIcon');
        if (pass.type === 'password') {
            pass.type = 'text';
            icon.className = 'fa fa-eye-slash';
        } else {
            pass.type = 'password';
            icon.className = 'fa fa-eye';
        }
    });
    </script>
</body>
</html>
