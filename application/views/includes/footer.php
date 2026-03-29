<!-- .footer-area start -->
    <div class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-logo">
                            <a href="<?= base_url() ?>">
                                <img src="<?= base_url(isset($settings['site_logo']) ? $settings['site_logo'] : 'assets/images/logo/logo-2.png') ?>" alt="Logo">
                            </a>
                        </div>
                        <p><?= isset($settings['footer_about_text']) ? nl2br($settings['footer_about_text']) : 'Providing exceptional legal services with integrity and dedication.' ?></p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-link">
                            <h3>Quick Link</h3>
                            <ul>
                                <?php if(isset($settings['footer_menus'])): foreach($settings['footer_menus'] as $menu): ?>
                                    <li><a href="<?= (strpos($menu['link'], 'http') === 0) ? $menu['link'] : base_url($menu['link']) ?>"><?= $menu['title'] ?></a></li>
                                <?php endforeach; endif; ?>
                                
                                <?php if(isset($settings['footer_pages'])): foreach($settings['footer_pages'] as $fpage): ?>
                                    <li><a href="<?= site_url('page/'.$fpage['slug']) ?>"><?= $fpage['title'] ?></a></li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-practice bd-0">
                            <h3>Practice Area</h3>
                            <ul>
                                <?php if(isset($settings['footer_practice'])): foreach($settings['footer_practice'] as $fp): ?>
                                    <li><a href="<?= site_url('practice/' . $fp['slug']) ?>"><?= $fp['title'] ?></a></li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="widget newsletter-widget">
                            <div class="widget-title">
                                <h3>Newsletter</h3>
                            </div>
                            <p><?= isset($settings['newsletter_description']) ? $settings['newsletter_description'] : 'Join our newsletter to stay updated with our latest insights and news.' ?></p>
                            <form id="newsletter-form">
                                <div class="input-1">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address *" required>
                                </div>
                                <div class="submit clearfix">
                                    <button type="submit"><i class="fa fa-envelope-o" aria-hidden="true"></i></button>
                                </div>
                                <div id="newsletter-message" style="margin-top: 10px; font-size: 14px;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 col-sm-9 col-12">
                            <span><?= isset($settings['copyright_text']) ? $settings['copyright_text'] : '© '.date('Y').' LEGAL EAGLE Law Firm. All rights reserved' ?></span>
                        </div>
                        <div class="col-lg-6 col-md-4 col-sm-3 col-12">
                            <ul class="d-flex">
                                <?php if(isset($settings['social_links'])): foreach($settings['social_links'] as $sl): ?>
                                    <li><a href="<?= $sl['link'] ?>" target="_blank"><i class="<?= $sl['icon'] ?>" aria-hidden="true"></i></a></li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->

   
   <!-- All JavaScript files
================================================== -->
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <!-- Plugins for this template -->
    <script src="<?= base_url('assets/js/jquery-plugin-collection.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.slicknav.min.js') ?>"></script>
    <!-- Custom script for this template -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      new WOW().init();

      $(document).ready(function() {
          $('#newsletter-form').on('submit', function(e) {
              e.preventDefault();
              var form = $(this);
              var email = form.find('input[name="email"]').val();

              $.ajax({
                  url: '<?= site_url('welcome/subscribe') ?>',
                  type: 'POST',
                  data: {email: email},
                  dataType: 'json',
                  success: function(response) {
                      if (response.status === 'success') {
                          Swal.fire({
                              icon: 'success',
                              title: 'Subscription Successful!',
                              text: response.message,
                              confirmButtonColor: '#c29255'
                          });
                          form.trigger('reset');
                      } else {
                          Swal.fire({
                              icon: 'info',
                              title: 'Notice',
                              text: response.message,
                              confirmButtonColor: '#c29255'
                          });
                      }
                  },
                  error: function() {
                      Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong. Please try again later.',
                      });
                  }
              });
          });
      });
    </script>
    <script>
    function copyToClipboard(text, btn) {
        const el = document.createElement('textarea');
        el.value = text;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        
        const originalHtml = btn.innerHTML;
        const width = btn.offsetWidth;
        btn.style.width = width + 'px';
        btn.innerHTML = '<i class="fa fa-check"></i>';
        btn.classList.add('btn-success');
        
        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.classList.remove('btn-success');
            btn.style.width = '';
        }, 2000);
    }
    </script>

    
    <script src="https://cdn.botpress.cloud/webchat/v3.6/inject.js"></script>
<script src="https://files.bpcontent.cloud/2026/03/04/02/20260304021837-5AACSBUV.js" defer></script>
    <style>
    /* Move Botpress chat widget to left side */
    #bp-web-widget-container {
        left: 16px !important;
        right: auto !important;
    }
    #bp-web-widget-container iframe {
        left: 16px !important;
        right: auto !important;
    }
    </style>
    
    <style>
    /* Full Screen Search Overlay */
    .search-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(26, 21, 14, 0.98);
        backdrop-filter: blur(10px);
        z-index: 99999;
        display: none;
        opacity: 0;
        transition: opacity 0.4s ease;
        overflow-y: auto;
    }
    .search-overlay.active {
        display: block;
        opacity: 1;
    }
    .search-overlay-close {
        position: absolute;
        top: 30px;
        right: 40px;
        cursor: pointer;
        z-index: 100000;
        transition: transform 0.3s;
    }
    .search-overlay-close:hover {
        transform: rotate(90deg);
    }
    .close-icon {
        font-size: 60px;
        color: #d0a15e;
        line-height: 1;
        font-weight: 300;
    }
    .search-overlay-content {
        margin-top: 15vh;
        padding-bottom: 50px;
    }
    .search-form-wrapper {
        position: relative;
    }
    .search-form {
        position: relative;
        border-bottom: 2px solid rgba(208, 161, 94, 0.3);
        margin-bottom: 40px;
    }
    .search-form input {
        width: 100%;
        background: transparent;
        border: none;
        color: #fff;
        font-size: 40px;
        padding: 20px 60px 20px 0;
        font-weight: 300;
        outline: none !important;
    }
    .search-form input::placeholder {
        color: rgba(255,255,255,0.2);
    }
    .search-form button {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #d0a15e;
        font-size: 30px;
        cursor: pointer;
    }
    .search-results-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .overlay-search-item {
        background: rgba(255,255,255,0.03);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        padding: 15px;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        text-decoration: none !important;
    }
    .overlay-search-item:hover {
        background: rgba(208, 161, 94, 0.1);
        border-color: #d0a15e;
        transform: translateY(-5px);
    }
    .overlay-search-item img {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        margin-right: 20px;
    }
    .overlay-search-info span {
        font-size: 10px;
        color: #d0a15e;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        display: block;
        margin-bottom: 5px;
    }
    .overlay-search-info h4 {
        margin: 0;
        font-size: 16px;
        color: #fff;
        font-weight: 500;
        line-height: 1.4;
    }
    .overlay-no-results {
        text-align: center;
        color: rgba(255,255,255,0.4);
        font-size: 20px;
        width: 100%;
        padding: 40px;
    }
    .overlay-loading {
        text-align: center;
        width: 100%;
        padding: 40px;
        color: #d0a15e;
    }
    </style>

    <script>
    $(document).ready(function() {
        const overlay = $('.search-overlay');
        const trigger = $('.search-overlay-trigger');
        const close = $('.search-overlay-close');
        const input = $('#overlay_search_input');
        const results = $('#overlay_search_results');
        let searchTimer;

        trigger.on('click', function() {
            overlay.addClass('active').fadeIn(300);
            setTimeout(() => input.focus(), 350);
            $('body').css('overflow', 'hidden');
        });

        close.on('click', function() {
            overlay.fadeOut(300, function() {
                $(this).removeClass('active');
                $('body').css('overflow', 'auto');
                input.val('');
                results.empty();
            });
        });

        input.on('input', function() {
            clearTimeout(searchTimer);
            const keyword = $(this).val().trim();

            if (keyword.length < 2) {
                results.empty();
                return;
            }

            results.html('<div class="overlay-loading"><i class="fa fa-spinner fa-spin fa-3x"></i></div>');

            searchTimer = setTimeout(function() {
                $.ajax({
                    url: '<?= site_url("welcome/ajax_search") ?>',
                    type: 'GET',
                    data: { keyword: keyword },
                    dataType: 'json',
                    success: function(data) {
                        results.empty();
                        if (data.length > 0) {
                            data.forEach(item => {
                                results.append(`
                                    <a href="${item.url}" class="overlay-search-item">
                                        <img src="${item.image}" alt="">
                                        <div class="overlay-search-info">
                                            <span>${item.type}</span>
                                            <h4>${item.title}</h4>
                                        </div>
                                    </a>
                                `);
                            });
                        } else {
                            results.html('<div class="overlay-no-results">No matches found for "' + keyword + '"</div>');
                        }
                    }
                });
            }, 200);
        });

        // Close on escape key
        $(document).keyup(function(e) {
            if (e.key === "Escape") close.click();
        });
    });
    </script>

<?php
// Custom Footer Code from SEO Settings
$seo_custom_footer = $settings['seo_custom_footer'] ?? '';
$seo_gtm_footer = $settings['seo_gtm_id'] ?? '';
if($seo_custom_footer) echo $seo_custom_footer;
if($seo_gtm_footer): ?>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $seo_gtm_footer ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<?php endif; ?>

</body>

</html>



