<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/icon.png') ?>">

    <?php
    // === SEO Meta Tags ===
    $seo_title       = $settings['seo_meta_title'] ?? '';
    $seo_desc        = $settings['seo_meta_description'] ?? '';
    $seo_keywords    = $settings['seo_meta_keywords'] ?? '';
    $seo_robots      = $settings['seo_robots'] ?? 'index, follow';
    $seo_canonical   = $settings['seo_canonical_url'] ?? '';
    $seo_og_title    = $settings['seo_og_title'] ?? '';
    $seo_og_desc     = $settings['seo_og_description'] ?? '';
    $seo_og_image    = $settings['seo_og_image'] ?? '';
    $seo_fb_app      = $settings['seo_fb_app_id'] ?? '';
    $seo_twitter     = $settings['seo_twitter_handle'] ?? '';
    $seo_gverify     = $settings['seo_google_verification'] ?? '';
    $seo_bverify     = $settings['seo_bing_verification'] ?? '';
    $seo_ga          = $settings['seo_google_analytics'] ?? '';
    $seo_gtm         = $settings['seo_gtm_id'] ?? '';
    $seo_fb_pixel    = $settings['seo_fb_pixel'] ?? '';
    $seo_custom_head = $settings['seo_custom_head'] ?? '';

    // Dynamic overrides for specific pages
    $page_title = isset($active_video['title']) ? $active_video['title'] . ' | ' : (isset($blog['title']) ? $blog['title'] . ' | ' : (isset($practice['title']) ? $practice['title'] . ' | ' : ''));
    $site_name  = $settings['site_title'] ?? 'Legal Eagle Law Firm';
    $final_title = $page_title . ($seo_title ?: $site_name);

    $final_desc = isset($blog['description']) ? strip_tags(substr($blog['description'], 0, 160)) : ($seo_desc ?: 'Premium legal services by Legal Eagle Law Firm.');

    $final_og_title = $seo_og_title ?: $final_title;
    $final_og_desc  = $seo_og_desc ?: $final_desc;
    $final_og_image = $seo_og_image ? base_url($seo_og_image) : (isset($blog['image']) ? base_url($blog['image']) : (isset($settings['site_logo']) ? base_url($settings['site_logo']) : base_url('assets/images/logo/logo-2.png')));
    ?>

    <!-- Page Title -->
    <title><?= htmlspecialchars($final_title) ?></title>

    <!-- SEO Meta -->
    <meta name="description" content="<?= htmlspecialchars($final_desc) ?>">
    <?php if($seo_keywords): ?><meta name="keywords" content="<?= htmlspecialchars($seo_keywords) ?>"><?php endif; ?>
    <meta name="robots" content="<?= htmlspecialchars($seo_robots) ?>">
    <?php if($seo_canonical): ?><link rel="canonical" href="<?= htmlspecialchars($seo_canonical) ?>"><?php endif; ?>

    <!-- Verification -->
    <?php if($seo_gverify): ?><meta name="google-site-verification" content="<?= htmlspecialchars($seo_gverify) ?>"><?php endif; ?>
    <?php if($seo_bverify): ?><meta name="msvalidate.01" content="<?= htmlspecialchars($seo_bverify) ?>"><?php endif; ?>

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($final_og_title) ?>" />
    <meta property="og:description" content="<?= htmlspecialchars($final_og_desc) ?>" />
    <meta property="og:image" content="<?= $final_og_image ?>" />
    <meta property="og:url" content="<?= current_url() ?>" />
    <meta property="og:type" content="<?= isset($active_video) ? 'video.other' : 'website' ?>" />
    <?php if(isset($active_video)): ?>
    <meta property="og:video" content="<?= base_url($active_video['video_path']) ?>" />
    <meta property="og:video:type" content="video/mp4" />
    <?php endif; ?>
    <meta property="og:site_name" content="<?= htmlspecialchars($site_name) ?>" />
    <?php if($seo_fb_app): ?><meta property="fb:app_id" content="<?= htmlspecialchars($seo_fb_app) ?>" /><?php endif; ?>

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <?php if($seo_twitter): ?><meta name="twitter:site" content="<?= htmlspecialchars($seo_twitter) ?>"><?php endif; ?>
    <meta name="twitter:title" content="<?= htmlspecialchars($final_og_title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($final_og_desc) ?>">
    <meta name="twitter:image" content="<?= $final_og_image ?>">

    <!-- Schema / JSON-LD -->
    <?php
    $schema_name = $settings['seo_schema_name'] ?? '';
    if($schema_name):
        $schema_type = $settings['seo_schema_type'] ?? 'LegalService';
    ?>
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "<?= $schema_type ?>",
        "name": "<?= htmlspecialchars($schema_name) ?>",
        "url": "<?= base_url() ?>",
        "logo": "<?= $final_og_image ?>",
        <?php if(!empty($settings['seo_schema_phone'])): ?>"telephone": "<?= htmlspecialchars($settings['seo_schema_phone']) ?>",<?php endif; ?>
        <?php if(!empty($settings['seo_schema_address'])): ?>
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "<?= htmlspecialchars($settings['seo_schema_address']) ?>",
            "addressLocality": "<?= htmlspecialchars($settings['seo_schema_city'] ?? '') ?>",
            "addressRegion": "<?= htmlspecialchars($settings['seo_schema_state'] ?? '') ?>",
            "addressCountry": "<?= htmlspecialchars($settings['seo_schema_country'] ?? '') ?>"
        },
        <?php endif; ?>
        "sameAs": []
    }
    </script>
    <?php endif; ?>

    <!-- Google Tag Manager -->
    <?php if($seo_gtm): ?>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?= $seo_gtm ?>');</script>
    <?php endif; ?>

    <!-- Google Analytics -->
    <?php if($seo_ga): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?= $seo_ga ?>"></script>
    <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= $seo_ga ?>');</script>
    <?php endif; ?>

    <!-- Facebook Pixel -->
    <?php if($seo_fb_pixel): ?>
    <script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');fbq('init','<?= $seo_fb_pixel ?>');fbq('track','PageView');</script>
    <?php endif; ?>

    <!-- Custom Head Code -->
    <?= $seo_custom_head ?>
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
    <link href="<?= base_url('assets/css/style.css?v=1.1') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/responsive.css?v=1.1') ?>" rel="stylesheet">
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
    <header id="sticky-header">
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
                        <div class="btn-style"><a href="<?= site_url('free-consultation') ?>">Free Consultation</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-style-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-6">
                        <div class="logo">
                            <a href="<?= base_url() ?>">
                                <img src="<?= base_url(isset($settings['site_logo']) ? $settings['site_logo'] : 'assets/images/logo/logo-2.png') ?>" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-block">
                        <div class="main-menu">
                            <nav class="nav_mobile_menu">
                                <ul>
                                    <?php if(isset($settings['menus'])): foreach($settings['menus'] as $menu): ?>
                                        <li class="<?= (current_url() == base_url($menu['link']) || current_url() == site_url($menu['link'])) ? 'active' : '' ?>">
                                            <a href="<?= (strpos($menu['link'], 'http') === 0) ? $menu['link'] : base_url($menu['link']) ?>"><?= $menu['title'] ?></a>
                                        </li>
                                    <?php endforeach; endif; ?>
                                    
                                    <?php if(isset($settings['header_pages'])): foreach($settings['header_pages'] as $hpage): ?>
                                        <li class="<?= (current_url() == site_url('page/'.$hpage['slug'])) ? 'active' : '' ?>">
                                            <a href="<?= site_url('page/'.$hpage['slug']) ?>"><?= $hpage['title'] ?></a>
                                        </li>
                                    <?php endforeach; endif; ?>
                                    <li class="<?= ($this->uri->segment(1) == 'gallery') ? 'active' : '' ?>">
                                        <a href="<?= site_url('gallery') ?>">Gallery</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-1 col-md-9 col-6 search">
                            <div class="search-btn mr-3">
                                <ul>
                                    <li><a href="javascript:void(0);" class="search-overlay-trigger"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </div>
                            <div class="mobile_menu d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Full Screen Search Overlay -->
    <div class="search-overlay">
        <div class="search-overlay-close">
            <span class="close-icon">&times;</span>
        </div>
        <div class="search-overlay-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="search-form-wrapper">
                            <form action="<?= site_url('welcome/blog_search') ?>" method="GET" class="search-form">
                                <input type="text" id="overlay_search_input" name="keyword" placeholder="Search Blogs, Practices, Case Studies, Landmarks..." autocomplete="off">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <div class="search-results-wrapper">
                                <div id="overlay_search_results" class="search-results-list"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-area end -->



