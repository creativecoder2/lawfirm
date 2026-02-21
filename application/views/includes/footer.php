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
                                <?php if(isset($settings['menus'])): foreach($settings['menus'] as $menu): ?>
                                    <li><a href="<?= (strpos($menu['link'], 'http') === 0) ? $menu['link'] : base_url($menu['link']) ?>"><?= $menu['title'] ?></a></li>
                                <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="footer-practice bd-0">
                            <h3>Practice Area</h3>
                            <ul>
                                <?php if(isset($settings['footer_practice'])): foreach($settings['footer_practice'] as $fp): ?>
                                    <li><a href="<?= site_url('practice') ?>"><?= $fp['title'] ?></a></li>
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
                            <span>Privacy Policy | <?= isset($settings['copyright_text']) ? $settings['copyright_text'] : '© '.date('Y').' LEGAL EAGLE Law Firm. All rights reserved' ?></span>
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
</body>

</html>



