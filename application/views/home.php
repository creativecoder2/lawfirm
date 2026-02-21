    <!-- start of hero -->
    <section class="hero hero-slider-wrapper hero-style-1">
        <div class="hero-slider">
            <?php if(!empty($sliders)): foreach($sliders as $slider): ?>
            <div class="slide">
                <img src="<?= base_url($slider['image']) ?>" alt class="slider-bg">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-8 slide-caption">
                            <h2><?= $slider['title'] ?></h2>
                            <p><?= $slider['subtitle'] ?></p>
                            <div class="btns">
                                <div class="btn-style"><a href="<?= !empty($slider['button_link']) ? (strpos($slider['button_link'], 'http') === 0 ? $slider['button_link'] : site_url($slider['button_link'])) : '#' ?>"><?= !empty($slider['button_text']) ? $slider['button_text'] : 'Contact us now' ?></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </section>
    <!-- end of hero slider -->

    <!--features start -->
    <div class="features-area ">
        <div class="container">
            <div class="row">
                <?php if(!empty($features)): foreach($features as $feature): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-p">
                    <div class="features-item-2">
                        <div class="features-icon">
                            <i class="<?= $feature['icon'] ?>"></i>
                        </div>
                        <div class="features-content">
                            <p><?= $feature['subtitle'] ?></p>
                            <h3><?= $feature['title'] ?></h3>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
    <!--features-features end -->
    <!-- about-area start-->
    <div class="about-style-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-12 col-m">
                    <div class="about-img">
                       <img src="<?= base_url(isset($settings['about_image']) ? $settings['about_image'] : 'assets/images/about/img-2.png') ?>" alt=""> 
                    </div>
                    <div class="video-btn">
                        <ul>
                            <li><a href="<?= isset($settings['video_url']) ? $settings['video_url'] : 'https://www.youtube.com/embed/uQBL7pSAXR8?autoplay=1' ?>" class="video-btn" data-type="iframe">
                            <i class="fi flaticon-play-button"></i>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-content">
                        <div class="section-title">
                            <h2><?= isset($settings['about_title']) ? $settings['about_title'] : 'Building Trust Through Decades of Service' ?></h2>
                        </div>
                        <p><?= isset($settings['about_text']) ? nl2br($settings['about_text']) : 'Founded in 2020...' ?></p>
                        <div class="btns">
                            <div class="btn-style"><a href="<?= site_url('about') ?>">More About Us..</a></div>
                        </div>
                        <div class="signature">
                            <img src="<?= base_url(isset($settings['signature_image']) ? $settings['signature_image'] : 'assets/images/about/img-1.png') ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about-area end-->
    <!-- practice-area start -->
    <div class="practice-area  ptb-100-70">
        <div class="container">
            <div class="col-12">
                <div class="section-title-1 text-center">
                    <span>Area Of Practice</span>
                    <h2>How Can We Help You</h2>
                    <p>Our experienced legal team provides comprehensive representation across a wide range of
practice areas, ensuring expert counsel for your specific needs</p>
                </div>
            </div>
            <div class="row">
                <?php if(!empty($practice)): foreach($practice as $p): ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="practice-section">
                        <div class="practices-wrapper">
                            <div class="practices-icon-wrapper" style="overflow: hidden; display: flex; align-items: center; justify-content: center; background: #fff;">
                                <div class="practice-dot">
                                   <div class="dots"></div>
                                </div>
                                <?php if(!empty($p['image'])): ?>
                                    <img src="<?= base_url($p['image']) ?>" alt="<?= $p['title'] ?>" style="width: 100%; height: 100%; object-fit: cover; ">
                                <?php else: ?>
                                    <i class="fi flaticon-law"></i>
                                <?php endif; ?>
                            </div>
                            <div class="practice-content">
                                <h2><?= $p['title'] ?></h2>
                                <div class="description-content"><?= $p['description'] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
    <!-- practice-area end -->
      <!-- case studiess area start -->
    <div class="studies-area section-padding">
        <div class="container">
            <!-- studies area start -->
            <div class="col-l2">
                <div class="section-title-1 text-center">
                    <span>Here Our Best Work</span>
                    <h2>Our Resent Case Studies</h2>
                </div>
            </div>
            <div class="col-12">
                <div class="studies-menu text-center">
                    <button class="active" data-filter="*">All</button>
                    <?php if(!empty($case_categories)): foreach($case_categories as $cat): ?>
                        <button data-filter=".<?= $cat['slug'] ?>"><?= $cat['name'] ?></button>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="row grid">
                <?php if(!empty($case_studies)): foreach($case_studies as $cs): ?>
                <div class="col-lg-4 col-md-6 col-sm-6 grid-item <?= $cs['category_slug'] ?>">
                    <div class="studies-item">
                        <div class="studies-single">
                            <img src="<?= base_url($cs['image']) ?>" alt="">
                        </div>
                        <a href="<?= site_url('case_studies_details/'.$cs['slug']) ?>" class="overlay-text">
                            <div class="text-inner">
                                <p class="sub"><?= $cs['category_name'] ?></p>
                                <h3><?= $cs['title'] ?></h3>
                            </div>
                        </a>  
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
    <!-- case studiess area end -->  
     <!--why choose us-->
     <div class="counter-area why-choose">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="why-choose-in">
                        <span>Why Choose Us</span>
                        <h1>Dedicated to Your Success</h1>
                        <p>For over 35 years, Sterling & Associates has been the trusted choice for individuals and businesses seeking exceptional legal representation. Our commitment to excellence and client satisfaction sets us apart.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="counter-grids">
                        <?php if(!empty($counters)): foreach($counters as $counter): ?>
                        <div class="grid">
                            <div>
                                <h2><span class="odometer" data-count="<?= intval($counter['count_value']) ?>">00</span><?= preg_replace('/[0-9]/', '', $counter['count_value']) ?></h2>
                            </div>
                            <p><?= $counter['title'] ?></p>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>      
    <!--Testimonial Area Start-->
    <div class="testimonial-area section-padding">
        <div class="container">
            <div class="row">
                <div class="testimonial-active">
                    <?php if(!empty($testimonials)): foreach($testimonials as $testimonial): ?>
                    <div class="my-testimonial">
                        <div class="inner-content">
                            <div class="content">
                                <div class="image-box"><img src="<?= base_url($testimonial['image']) ?>" alt="" /></div>
                                <div class="quote-icon"><i class="fi flaticon-right-quote"></i></div>
                                <h4><?= $testimonial['name'] ?></h4>
                                <div class="designation"><?= $testimonial['designation'] ?></div>
                                <div class="text"><?= $testimonial['message'] ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>
    </div>
    <!--Testimonial Area End-->
    <!-- .contact area start -->
    <div class="contact-area section-padding" id="consultation-form">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-text">
                        <h2><?= isset($settings['contact_section_title']) ? $settings['contact_section_title'] : 'Are You Interest To Contact With Us?' ?></h2>
                        <p><?= isset($settings['contact_section_hours']) ? nl2br($settings['contact_section_hours']) : 'Mon – Thur: 8:00 AM – 9:00 PM<br>Friday: 2:00 PM – 6:00 PM<br>Saturday: 8:AM – 9:30 PM<br>ONLINE APPOINTMENT: 24/7' ?></p>
                        <div class="contact-sub">
                            <div class="contact-icon">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                            </div>
                            <div class="contact-c">
                                <h4>Our Location</h4>
                                <span><?= isset($settings['contact_address']) ? $settings['contact_address'] : 'Office no 3...' ?></span>
                            </div>
                        </div>
                        <div class="contact-sub">
                            <div class="contact-icon">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="contact-c">
                                <h4>Phone</h4>
                                <span><?= isset($settings['contact_phone']) ? $settings['contact_phone'] : '+92 322 4490008' ?></span>
                            </div>
                        </div>
                        <div class="contact-sub">
                            <div class="contact-icon">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </div>
                            <div class="contact-c">
                                <h4>Email</h4>
                                <span><?= isset($settings['contact_email']) ? $settings['contact_email'] : 'legallaw669@gmail.com' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-7 col-md-12 col-sm-12">
                    <div class="contact-content">
                        <div class="contact-form">
                            <form class="contact-validation-active" id="contact-form">
                                <div class="half-col">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name *" required>
                                </div>
                                <div class="half-col">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone *" required>
                                </div>
                                <div class="half-col">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email *" required>
                                </div>
                                <div class="half-col">
                                    <select name="practice_category_id" id="practice_category_id" class="form-control" required onchange="updateFee(this)">
                                        <option value="" disabled selected>-- Select Practice Area --</option>
                                        <?php if(!empty($practice_areas)): foreach($practice_areas as $pa): ?>
                                        <option value="<?= $pa['id'] ?>" data-fee="<?= number_format($pa['consultation_fee'] ?? 0, 2) ?>">
                                            <?= $pa['title'] ?><?= ($pa['consultation_fee'] > 0) ? ' — Rs. '.number_format($pa['consultation_fee'], 0) : '' ?>
                                        </option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                </div>
                                <div>
                                    <textarea class="form-control" name="note" id="note" placeholder="Case Description..."></textarea>
                                </div>

                                <!-- Payment Method + Fee Summary -->
                                <div id="payment-section" style="width:100%; margin: 18px 0 10px;">
                                    <!-- Fee summary card (shown when a category with fee is selected) -->
                                    <div id="payment-fee-summary" style="display:none; margin-bottom:14px; padding:14px 16px; background:linear-gradient(135deg,rgba(188,147,85,0.2),rgba(188,147,85,0.05)); border:1px solid rgba(188,147,85,0.4); border-radius:8px;">
                                        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                                            <div>
                                                <div style="color:#aaa; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Selected Category</div>
                                                <div id="summary-category" style="color:#fff; font-size:14px; font-weight:600; margin-top:2px;">—</div>
                                            </div>
                                            <div style="text-align:right;">
                                                <div style="color:#aaa; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Consultation Fee</div>
                                                <div id="summary-fee" style="color:#bc9355; font-size:22px; font-weight:700; margin-top:2px;">Rs. 0</div>
                                            </div>
                                        </div>
                                        <div style="margin-top:10px; padding-top:10px; border-top:1px solid rgba(188,147,85,0.2); color:#aaa; font-size:12px;">
                                            <i class="fa fa-info-circle" style="color:#bc9355;"></i>&nbsp; Select your preferred payment method below to pay this amount
                                        </div>
                                    </div>
                                    <!-- Free notice (shown for free categories) -->
                                    <div id="payment-free-notice" style="display:none; margin-bottom:14px; padding:10px 14px; background:rgba(46,204,64,0.08); border:1px solid rgba(46,204,64,0.3); border-radius:8px; color:#aaa; font-size:13px;">
                                        <i class="fa fa-check-circle" style="color:#2ecc40;"></i>&nbsp; This consultation is <strong style="color:#2ecc40;">free of charge</strong>. No payment required.
                                    </div>
                                    <p style="color:#ccc; margin-bottom:10px; font-size:14px;"><i class="fa fa-credit-card"></i>&nbsp; Select Payment Method</p>
                                    <div class="payment-methods-grid">
                                        <?php
                                        $methods = [
                                            ['id'=>'easypaisa',   'label'=>'EasyPaisa',    'icon'=>'assets/images/payments/easypaisa.svg'],
                                            ['id'=>'jazzcash',    'label'=>'JazzCash',     'icon'=>'assets/images/payments/jazzcash.svg'],
                                            ['id'=>'paypal',      'label'=>'PayPal',       'icon'=>'assets/images/payments/paypal.svg'],
                                            ['id'=>'credit_card', 'label'=>'Credit Card',  'icon'=>'assets/images/payments/credit_card.svg'],
                                            ['id'=>'pioneer',     'label'=>'Payoneer',     'icon'=>'assets/images/payments/pioneer.svg'],
                                        ];
                                        foreach($methods as $m): ?>
                                        <label class="payment-method-card" for="pm_<?= $m['id'] ?>">
                                            <input type="radio" name="payment_method" id="pm_<?= $m['id'] ?>" value="<?= $m['id'] ?>" required>
                                            <span class="pm-inner">
                                                <img src="<?= base_url($m['icon']) ?>" alt="<?= $m['label'] ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                <span class="pm-fallback" style="display:none;"><i class="fa fa-credit-card"></i></span>
                                                <span class="pm-name"><?= $m['label'] ?></span>
                                            </span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <input type="hidden" name="attorney_id" value="">
                                <div class="submit-btn-wrapper">
                                    <button type="submit" class="theme-btn" id="appt-submit-btn">Book Appointment</button>
                                    <div id="loader" style="display:none;">
                                        <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                                    </div>
                                </div>
                                <div class="clearfix error-handling-messages">
                                    <div id="success" style="display:none;">Thank you</div>
                                    <div id="error" style="display:none;">Error occurred while sending. Please try again.</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .contact area end -->

    <style>
    .payment-methods-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        width: 100%;
    }
    .payment-method-card {
        cursor: pointer;
        flex: 1 1 calc(20% - 10px);
        min-width: 80px;
    }
    .payment-method-card input[type="radio"] { display: none; }
    .pm-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px 8px;
        border: 2px solid rgba(255,255,255,0.1);
        border-radius: 8px;
        background: rgba(255,255,255,0.04);
        transition: all 0.25s ease;
        gap: 6px;
    }
    .pm-inner img { width: 40px; height: 28px; object-fit: contain; }
    .pm-name { font-size: 11px; color: #ccc; text-align: center; }
    .payment-method-card input:checked + .pm-inner {
        border-color: #bc9355;
        background: rgba(188,147,85,0.15);
        box-shadow: 0 0 0 2px rgba(188,147,85,0.3);
    }
    .payment-method-card input:checked + .pm-inner .pm-name { color: #bc9355; font-weight: 600; }
    .payment-method-card:hover .pm-inner { border-color: #bc9355; }
    </style>

    <script>
    function updateFee(sel) {
        var opt      = sel.options[sel.selectedIndex];
        var fee      = parseFloat(opt.getAttribute('data-fee') || 0);
        var catName  = opt.text.split(' —')[0].trim(); // category name without the fee part
        var feeSum   = document.getElementById('payment-fee-summary');
        var freeNote = document.getElementById('payment-free-notice');

        if (fee > 0) {
            document.getElementById('summary-category').innerText = catName;
            document.getElementById('summary-fee').innerText = 'Rs. ' + fee.toLocaleString('en-PK', {minimumFractionDigits: 0, maximumFractionDigits: 0});
            feeSum.style.display   = 'block';
            freeNote.style.display = 'none';
        } else if (sel.value) {
            // Category selected but fee is 0 = free
            feeSum.style.display   = 'none';
            freeNote.style.display = 'block';
        } else {
            feeSum.style.display   = 'none';
            freeNote.style.display = 'none';
        }
    }

    window.addEventListener('load', function() {
        var form = document.getElementById('contact-form');
        if (!form) return;
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var name     = document.getElementById('name').value.trim();
            var phone    = document.getElementById('phone').value.trim();
            var email    = document.getElementById('email').value.trim();
            var cat      = document.getElementById('practice_category_id').value;
            var note     = document.getElementById('note').value.trim();
            var pmEl     = document.querySelector('input[name="payment_method"]:checked');

            if (!name || !phone || !email || !cat) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon:'warning', title:'Missing Fields', text:'Please fill all required fields.', confirmButtonColor:'#bc9355' });
                } return;
            }
            if (!pmEl) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ icon:'warning', title:'Payment Method Required', text:'Please select a payment method.', confirmButtonColor:'#bc9355' });
                } return;
            }

            var btn = document.getElementById('appt-submit-btn');
            btn.disabled = true; btn.innerText = 'Submitting...';
            document.getElementById('loader').style.display = 'block';

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= base_url("submit_appointment") ?>', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onload = function() {
                btn.disabled = false; btn.innerText = 'Book Appointment';
                document.getElementById('loader').style.display = 'none';
                try {
                    var res = JSON.parse(xhr.responseText);
                    if (res.status === 'success') {
                        form.reset();
                        document.getElementById('payment-fee-summary').style.display = 'none';
                        document.getElementById('payment-free-notice').style.display = 'none';
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon:'success', title:'Appointment Booked!', text: res.message || 'We will contact you shortly.', confirmButtonColor:'#bc9355' });
                        }
                    } else {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ icon:'error', title:'Error', text: res.message || 'Something went wrong.', confirmButtonColor:'#bc9355' });
                        }
                    }
                } catch(err) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ icon:'error', title:'Error', text:'Something went wrong. Please try again.', confirmButtonColor:'#bc9355' });
                    }
                }
            };
            xhr.onerror = function() {
                btn.disabled = false; btn.innerText = 'Book Appointment';
                document.getElementById('loader').style.display = 'none';
            };
            var params = 'name=' + encodeURIComponent(name)
                + '&phone=' + encodeURIComponent(phone)
                + '&email=' + encodeURIComponent(email)
                + '&practice_category_id=' + encodeURIComponent(cat)
                + '&note=' + encodeURIComponent(note)
                + '&payment_method=' + encodeURIComponent(pmEl.value)
                + '&attorney_id=';
            xhr.send(params);
        });
    });
    </script>
    <!-- .contact area start -->
     <!-- expert-area start -->
    <div class="team-area ptb-100-70">
        <div class="container">
            <div class="col-l2">
                <div class="section-title-1  text-center">
                    <span>Meet Our Experts</span>
                    <h2>Qualified Attorneys</h2>
                </div>
            </div>
            <div class="team-active owl-carousel">
                <?php if(!empty($teams)): foreach(array_chunk($teams, 3) as $team_chunk): ?>
                <div class="team-item">
                    <div class="row">
                        <?php foreach($team_chunk as $team): ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="team-single">
                              <a href="<?= site_url('attorney/'.$team['slug']) ?>">  <div class="team-img">
                                    <img src="<?= base_url($team['image']) ?>" alt="">
                                    <div class="social-1st">
                                        <ul>
                                            <?php if($team['facebook']): ?><li><a href="<?= $team['facebook'] ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php endif; ?>
                                            <?php if($team['twitter']): ?><li><a href="<?= $team['twitter'] ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php endif; ?>
                                            <?php if($team['linkedin']): ?><li><a href="<?= $team['linkedin'] ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php endif; ?>
                                        </ul>
                                    </div>
                                </div></a>
                                <div class="team-content text-center">
                                    <h4><a href="<?= site_url('attorney/'.$team['slug']) ?>" style="color: inherit; text-decoration: none;"><?= $team['name'] ?></a></h4>
                                    <span><?= $team['designation'] ?></span>
                                    <p><!-- description not in db yet, maybe add later --></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
    <!-- expert-area end -->
    <!-- .counter-area start -->
    <div class="counter-area">
        <div class="container">
            <div class="row">
                <div class="consulting-area">
                    <span>Now Offering Online Consultations</span>
                     <br clear="all">
                    <h1><?= isset($settings['consultation_title']) ? $settings['consultation_title'] : 'Ready to Discuss Your Case?' ?></h1>
                     <br clear="all">
                    <p><?= isset($settings['consultation_text']) ? nl2br($settings['consultation_text']) : 'Don’t wait to protect your rights...' ?>
                    </p>
                     <br clear="all">
                    <a href="">Call Now : <?= isset($settings['contact_phone']) ? $settings['contact_phone'] : '+92 322 4490008' ?></a>
                    <a href="">Book Online Consultation</a>
                     <br clear="all">
                </div>
                 <br clear="all">
            </div>
             <br clear="all">
        </div>
        <br clear="all">
    </div>
    <!-- .counter-area end -->
    <!-- blog-area start -->
    <div class="blog-area section-padding">
        <div class="container">
            <div class="col-l2">
                <div class="section-title-1 text-center">
                    <span>From Our Blog</span>
                    <h2>Latest News</h2>
                </div>
            </div>
            <div class="row">
                <?php if(!empty($blogs)): foreach($blogs as $blog): ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="blog-item">
                        <div class="blog-img">
                            <a href="<?= site_url('blog_detail/'.$blog['slug']) ?>">
                                <img src="<?= base_url($blog['image']) ?>" alt="<?= $blog['title'] ?>">
                            </a>
                        </div>
                        <div class="blog-content">
                            <h3><a href="<?= site_url('blog_detail/'.$blog['slug']) ?>"><?= $blog['title'] ?></a></h3>
                            <ul class="post-meta">
                                <li><img src="https://ui-avatars.com/api/?name=<?= urlencode($blog['author']) ?>&background=bc9355&color=fff" alt="" style="border-radius: 50%; width: 20px;"></li>
                                <li><a href="#"><?= $blog['author'] ?></a></li>
                                <li> <?= date('M d, Y', strtotime($blog['date_published'])) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
    <!-- blog-area start -->
    <!-- .footer-area start -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const cat = urlParams.get('cat');
            
            if(cat) {
                setTimeout(() => {
                    const filterSelector = '.' + cat;
                    const filterBtn = document.querySelector(`.studies-menu button[data-filter="${filterSelector}"]`);
                    if(filterBtn) {
                        filterBtn.click();
                        const studiesSection = document.querySelector('.studies-area');
                        if(studiesSection) {
                            studiesSection.scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                }, 500);
            }
        });
    </script>



