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
    <div class="features-area">
        <div class="container">
            <div class="row">
                <?php if(!empty($features)): foreach($features as $feature): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-p">
                    <a href="<?= !empty($feature['link']) ? $feature['link'] : '#' ?>" class="features-link-wrapper" style="text-decoration: none; display: block;">
                        <div class="features-item-2 h-100" style="transition: all 0.3s ease;">
                            <div class="features-icon">
                                <i class="<?= $feature['icon'] ?>"></i>
                            </div>
                            <div class="features-content">
                                <p style="margin-bottom: 5px;"><?= $feature['subtitle'] ?></p>
                                <h3 style="margin-bottom: 10px;"><?= $feature['title'] ?></h3>
                                <div class="click-here" style="color: #d0a15e; font-weight: 600; font-size: 14px;">
                                    Click here <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </a>
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
                            <li>
                                <?php 
                                    $v_href = !empty($settings['video_file']) ? base_url($settings['video_file']) : (isset($settings['video_url']) ? $settings['video_url'] : 'https://www.youtube.com/embed/uQBL7pSAXR8?autoplay=1');
                                    $v_type = !empty($settings['video_file']) ? 'video' : 'iframe';
                                ?>
                                <a href="<?= $v_href ?>" class="video-btn" data-type="<?= $v_type ?>">
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
                        <h2>Book your Appointment</h2>
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
                            <form class="appointment-validation-active" id="cms-appointment-form">
                                <input type="hidden" name="_token" id="_token" value="<?= md5(uniqid(mt_rand(), true)) ?>">
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
                                        <option value="0" data-fee="0" selected>Free Consultation</option>
                                        <?php if(!empty($practice_areas)): foreach($practice_areas as $pa): ?>
                                        <option value="<?= $pa['id'] ?>" data-fee="<?= number_format($pa['consultation_fee'] ?? 0, 2) ?>">
                                            <?= $pa['title'] ?>
                                        </option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <small id="fee-notice-text" style="display:block; margin-top:5px; color:#bc9355; font-size:12px; font-style:italic;">
                                        Note: Some legal Cases may require a professional consultation fee.
                                    </small>
                                </div>
                                <div>
                                    <textarea class="form-control" name="note" id="note" placeholder="Case Description..."></textarea>
                                </div>

                                <!-- Payment Method + Fee Summary -->
                                <div id="payment-section-container" style="display:none; width:100%; margin: 18px 0 10px;">
                                    <!-- Fee summary card (shown when a category with fee is selected) -->
                                    <div id="payment-fee-summary" style="display:none; margin-bottom:14px; padding:14px 16px; background:linear-gradient(135deg,rgba(188,147,85,0.2),rgba(188,147,85,0.05)); border:1px solid rgba(188,147,85,0.4); border-radius:8px;">
                                        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                                            <div>
                                                <div style="color:#aaa; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Selected Category</div>
                                                <div id="summary-category" style="color:#fff; font-size:14px; font-weight:600; margin-top:2px;">—</div>
                                            </div>
                                            <div style="text-align:right;">
                                                <div style="color:#aaa; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Consultation Fee</div>
                                                <div id="summary-fee" style="color:#bc9355; font-size:22px; font-weight:700; margin-top:2px;">PKR 0</div>
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
                                            ['id'=>'paypro', 'label'=>'PayPro', 'icon'=>'https://paypro.com.pk/wp-content/uploads/2022/08/cropped-Logo_Blue.png']
                                        ];
                                        foreach($methods as $m): ?>
                                        <label class="payment-method-card" for="pm_<?= $m['id'] ?>">
                                            <input type="radio" name="payment_method" id="pm_<?= $m['id'] ?>" value="<?= $m['id'] ?>" checked>
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
                                    <!-- Messages now handled by SweetAlert (Swal) -->
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
    <style>
    /* Attorney Card Premium Styling */
    .cms-team-card {
        padding: 10px;
        transition: all 0.3s ease;
    }
    .cms-team-card .card-inner {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.03);
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .cms-team-card:hover .card-inner {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }
    .card-image-wrapper {
        position: relative;
        width: 100%;
        padding-top: 110%; /* Aspect ratio */
        overflow: hidden;
        background: #f8f9fa;
    }
    .card-image-wrapper img {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .cms-team-card:hover img {
        transform: scale(1.05);
    }
    .social-hover {
        position: absolute;
        bottom: -40px;
        left: 0; width: 100%;
        background: rgba(188,147,85,0.9);
        display: flex;
        justify-content: center;
        padding: 8px 0;
        transition: bottom 0.3s ease;
    }
    .cms-team-card:hover .social-hover {
        bottom: 0;
    }
    .social-hover ul {
        display: flex;
        gap: 15px;
        margin: 0; padding: 0;
        list-style: none;
    }
    .social-hover li a {
        color: #fff;
        font-size: 14px;
        transition: opacity 0.2s;
    }
    .social-hover li a:hover { opacity: 0.8; }
    
    .card-content {
        padding: 20px 15px;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .card-content h4 {
        margin: 0 0 5px;
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }
    .card-content h4 a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s;
    }
    .card-content h4 a:hover { color: #bc9355; }
    .card-content .designation {
        font-size: 13px;
        color: #bc9355;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Override Owl Carousel for this section - removed overflow visible to hide peeking items */
    .team-area .owl-item {
        transition: transform 0.3s ease;
    }

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
        var catName  = opt.text.trim();
        var feeSum   = document.getElementById('payment-fee-summary');
        var freeNote = document.getElementById('payment-free-notice');
        var paySec   = document.getElementById('payment-section-container');

        if (fee > 0) {
            document.getElementById('summary-category').innerText = catName;
            document.getElementById('summary-fee').innerText = 'PKR ' + fee.toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 0});
            feeSum.style.display   = 'block';
            freeNote.style.display = 'none';
            paySec.style.display   = 'block'; // Show payment methods
        } else if (sel.value) {
            // Category selected but fee is 0 = free
            feeSum.style.display   = 'none';
            freeNote.style.display = 'block';
            paySec.style.display   = 'none'; // Hide payment methods for free categories
        } else {
            feeSum.style.display   = 'none';
            freeNote.style.display = 'none';
            paySec.style.display   = 'none';
        }
    }

    window.addEventListener('load', function() {
        var form = document.getElementById('cms-appointment-form');
        if (!form) return;

        // Initialize fee on load for the default "Free Consultation"
        var sel = document.getElementById('practice_category_id');
        if(sel) updateFee(sel);

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

            // check if fee is > 0
            var opt = document.getElementById('practice_category_id').options[document.getElementById('practice_category_id').selectedIndex];
            var fee = parseFloat(opt.getAttribute('data-fee') || 0);
            
            if (fee > 0 && !pmEl) {
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
                        if (res.redirect) {
                            window.location.href = res.redirect;
                            return;
                        }
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
                + '&payment_method=' + encodeURIComponent(pmEl ? pmEl.value : '')
                + '&attorney_id='
                + '&_token=' + encodeURIComponent(document.getElementById('_token').value);
            xhr.send(params);
        });
    });
    </script>
    <!-- .contact area start -->
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

            // Case Studies Infinite Scroll Logic
            var $grid = jQuery('.grid');
            if ($grid.length) {
                var currentLimit = 4;
                var currentFilter = '*';

                function updateCaseStudiesFilter() {
                    $grid.isotope({
                        filter: function() {
                            var $this = jQuery(this);
                            var isMatched = (currentFilter === '*') || $this.is(currentFilter);
                            if (!isMatched) return false;

                            // Find the index among items that match currentFilter
                            var selector = (currentFilter === '*') ? '.grid-item' : '.grid-item' + currentFilter;
                            var index = $grid.find(selector).index($this);
                            return index < currentLimit;
                        }
                    });
                }

                // Wait for imagesLoaded (handled in script.js, but we override here)
                $grid.imagesLoaded(function() {
                    updateCaseStudiesFilter();
                });

                // Override filter menu click
                jQuery('.studies-menu').off('click', 'button');
                jQuery('.studies-menu').on('click', 'button', function() {
                    jQuery('.studies-menu button').removeClass('active');
                    jQuery(this).addClass('active');
                    
                    currentFilter = jQuery(this).attr('data-filter');
                    currentLimit = 4; // Reset limit when filter changes
                    updateCaseStudiesFilter();
                    
                    // Trigger a layout update
                    $grid.isotope('layout');
                });

                // Scroll to Load More
                var isHandlingScroll = false;
                jQuery(window).on('scroll', function() {
                    if (isHandlingScroll) return;
                    
                    var totalMatching = (currentFilter === '*') ? 
                        $grid.find('.grid-item').length : 
                        $grid.find('.grid-item' + currentFilter).length;
                    
                    if (currentLimit >= totalMatching) return;

                    var scrollY = jQuery(window).scrollTop() + jQuery(window).height();
                    var sectionBottom = jQuery('.studies-area').offset().top + jQuery('.studies-area').outerHeight();

                    if (scrollY > sectionBottom - 150) {
                        isHandlingScroll = true;
                        setTimeout(function() {
                            currentLimit += 4;
                            updateCaseStudiesFilter();
                            isHandlingScroll = false;
                        }, 200); // Small debounce for smoother behavior
                    }
                });
            }

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



