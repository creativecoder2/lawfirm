<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/icon.png') ?>">
    <!-- Page Title -->
    <title>Kazi – Lawyers Attorneys and Law Firm HTML Template </title>
    <!-- Icon fonts -->
    <link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/flaticon.css') ?>" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Plugins for this template -->
    <link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/owl.carousel.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/odometer-theme-default.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/slick.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/slick-theme.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/slicknav.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/jquery.fancybox.css') ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/responsive.css') ?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- start preloader -->
        <div class="preloader">
            <div class="lds-ripple">
                <div></div>
                <div></div>
            </div>
        </div>
    <!-- end preloader -->
    <!-- header-area start -->
    <header>
        <div class="header-top-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-12 col-lg-9">
                        <ul class="d-flex account_login-area">
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i><?= isset($settings['office_hours']) ? $settings['office_hours'] : 'Mon - Thurs : 08.00 am - 09.00 pm' ?></li>
                            <li><i class="fa fa-map-marker"></i><?= isset($settings['contact_address']) ? $settings['contact_address'] : 'Office no 3 2nd floor, Kareem chamber, road, Mozang Chungi, Lahore, 54000' ?></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="btn-style"><a href="<?= (uri_string() == '' || uri_string() == 'home') ? '#consultation-form' : site_url('contact') ?>" <?= (uri_string() == '' || uri_string() == 'home') ? 'onclick="event.preventDefault(); document.getElementById(\'consultation-form\').scrollIntoView({behavior:\'smooth\'});"' : '' ?>>Free Consultation</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-style-1" id="sticky-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-8 col-t">
                        <div class="logo">
                            <a href="<?= base_url() ?>">
                                <img src="<?= base_url(isset($settings['site_logo']) ? $settings['site_logo'] : 'assets/images/logo/logo-2.png') ?>" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-block col-m">
                        <div class="main-menu">
                            <nav class="nav_mobile_menu">
                                <ul>
                                    <?php if(isset($settings['menus'])): foreach($settings['menus'] as $menu): ?>
                                        <li class="<?= (current_url() == base_url($menu['link']) || current_url() == site_url($menu['link'])) ? 'active' : '' ?>">
                                            <a href="<?= (strpos($menu['link'], 'http') === 0) ? $menu['link'] : base_url($menu['link']) ?>"><?= $menu['title'] ?></a>
                                        </li>
                                    <?php endforeach; endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-3 col-sm-3 col-3 search col-t">
                        <ul>
                            <li><a href="javascript:void(0);"><i class="fa fa-search"></i></a>
                                <ul>
                                    <li>
                                        <form action="">
                                            <input type="text" placeholder="search here..">
                                            <button><i class="fa fa-search"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 d-block d-lg-none">
                        <div class="mobile_menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area end -->



