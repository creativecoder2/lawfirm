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
                            <div class="practices-icon-wrapper">
                                <div class="practice-dot">
                                   <div class="dots"></div>
                                </div>
                                <i class="<?= $p['icon'] ?>"></i>
                            </div>
                            <div class="practice-content">
                                <h2><?= $p['title'] ?></h2>
                                <p><?= $p['description'] ?></p>
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
    <div class="contact-area section-padding">
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
                            <form method="post" class="contact-validation-active" id="contact-form">
                                <div class="half-col">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="half-col">
                                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                                </div>
                                <div class="half-col">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="half-col">
                                <select name="address" id="address" class="form-control">
                                    <option disabled selected>Family Law</option>
                                    <option>Criminal Law</option>
                                    <option>Business Law</option>
                                    <option>Personal Injury</option>
                                    <option>Education Law</option>
                                    <option>Drugs Crime</option>
                                </select>
                                </div>
                                <div>
                                    <textarea class="form-control" name="note"  id="note" placeholder="Case Description..."></textarea>
                                </div>
                                <div class="submit-btn-wrapper">
                                    <button type="submit" class="theme-btn">Appointment</button>
                                    <div id="loader">
                                        <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                                    </div>
                                </div>
                                <div class="clearfix error-handling-messages">
                                    <div id="success">Thank you</div>
                                    <div id="error"> Error occurred while sending email. Please try again later. </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                              <a href="<?= site_url('attorneys_single') ?>">  <div class="team-img">
                                    <img src="<?= base_url($team['image']) ?>" alt="">
                                    <div class="social-1st">
                                        <ul>
                                            <?php if($team['facebook']): ?><li><a href="<?= $team['facebook'] ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li><?php endif; ?>
                                            <?php if($team['twitter']): ?><li><a href="<?= $team['twitter'] ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li><?php endif; ?>
                                            <?php if($team['linkedin']): ?><li><a href="<?= $team['linkedin'] ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li><?php endif; ?>
                                        </ul>
                                    </div>
                                </div></a>
                                <div class="team-content">
                                    <h4><?= $team['name'] ?></h4>
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



