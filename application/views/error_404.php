<div class="breadcumb-area breadcumb-3" style="background-image: url(<?= base_url('assets/images/breadcumb/bg.jpg') ?>);">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap">
                    <h2>404 - Page Not Found</h2>
                    <ul>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><span>Error</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="error-404-section py-5 my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="error-content">
                    <h1 style="font-size: 151px; font-weight: 900; color: #d0a15e; line-height: 1; margin-bottom: 20px; opacity: 0.1; position: absolute; left: 50%; transform: translateX(-50%); width: 100%; top: -60px; z-index: -1;">404</h1>
                    <div style="position: relative; z-index: 1;">
                        <i class="fa fa-exclamation-triangle" style="font-size: 80px; color: #d0a15e; margin-bottom: 30px;"></i>
                        <h2 style="font-size: 42px; font-weight: 700; color: #222; margin-bottom: 20px;">Oops! This Case is Closed</h2>
                        <p style="font-size: 18px; color: #666; margin-bottom: 40px; line-height: 1.8;">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Let's get you back on track.</p>
                        
                        <div class="error-actions d-flex justify-content-center gap-3">
                            <a href="<?= base_url() ?>" class="btn btn-primary" style="background: #d0a15e; border-color: #d0a15e; padding: 15px 40px; font-weight: 600; border-radius: 5px; color: #fff; text-decoration: none; margin-right: 15px;">
                                <i class="fa fa-home"></i> Back to Home
                            </a>
                            <a href="<?= site_url('contact') ?>" class="btn btn-outline-dark" style="border: 2px solid #222; padding: 15px 40px; font-weight: 600; border-radius: 5px; color: #222; text-decoration: none;">
                                <i class="fa fa-envelope"></i> Contact Support
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="search-back-box mt-5 p-4" style="background: #fdfaf5; border-radius: 15px; border: 1px dashed #d0a15e;">
                    <h4 style="margin-bottom: 20px; font-weight: 600;">Or try searching for what you need:</h4>
                    <div style="max-width: 500px; margin: 0 auto;">
                         <form action="<?= site_url('welcome/blog_search') ?>" method="GET" style="display: flex;">
                            <input type="text" name="keyword" class="form-control" placeholder="Type keywords..." style="border-radius: 5px 0 0 5px; height: 50px;">
                            <button type="submit" class="btn btn-primary" style="background: #222; border-color: #222; border-radius: 0 5px 5px 0; padding: 0 25px;"><i class="fa fa-search"></i></button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .error-content {
        padding: 50px 0;
        position: relative;
    }
    .gap-3 { gap: 1rem; }
</style>
