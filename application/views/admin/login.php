<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Law Firm</title>
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-box {
            background: #fff;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            border-top: 5px solid #d0a15e; /* Gold color */
        }
        .login-box h2 {
            margin-bottom: 20px;
            color: #231b0e; /* Dark color */
            font-family: 'Josefin Sans', sans-serif;
        }
        .btn-theme {
            background-color: #d0a15e;
            color: #fff;
            border: none;
            width: 100%;
            padding: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-theme:hover {
            background-color: #9e7044;
            color: #fff;
        }
        .form-control:focus {
            border-color: #d0a15e;
            box-shadow: 0 0 0 0.2rem rgba(208, 161, 94, 0.25);
        }
        .alert {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="<?= base_url('assets/images/logo/logo-2.png') ?>" alt="Logo" style="max-height: 50px; margin-bottom: 20px;">
        <h2>Admin Login</h2>
        
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('admin/login_post') ?>" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-theme">Login</button>
        </form>
    </div>
</body>
</html>
