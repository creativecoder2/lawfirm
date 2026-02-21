<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>About Us</h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>About</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->

    <!--features start -->
    <div class="features-area ">
        <div class="container">
            <div class="row">
                <?php foreach($about_features as $af): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-p">
                    <div class="features-item-2">
                        <div class="features-icon">
                            <i class="<?= $af['icon'] ?>"></i>
                        </div>
                        <div class="features-content">
                            <p><?= $af['subtitle'] ?></p>
                            <h3><?= $af['title'] ?></h3>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
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
                       <img src="<?= base_url($about['image']) ?>" alt=""> 
                    </div>
                    <div class="video-btn">
                        <ul>
                            <li><a href="<?= $about['video_url'] ?>" class="video-btn" data-type="iframe">
                            <i class="fi flaticon-play-button"></i>
                            </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="about-content">
                        <div class="section-title">
                            <h2><?= $about['title'] ?></h2>
                            <?php if($about['subtitle']): ?><span><?= $about['subtitle'] ?></span><?php endif; ?>
                        </div>
                        <p><?= nl2br($about['description']) ?></p>
                        <div class="signature">
                            <img src="<?= base_url($about['signature_image']) ?>" alt="">
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
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="practice-section">
                        <div class="practices-wrapper">
                            <div class="practices-icon-wrapper">
                                <div class="practice-dot">
                                   <div class="dots"></div>
                                </div>
                                <i class="fi flaticon-grandparents"></i>
                            </div>
                            <div class="practice-content">
                                <h2>Family Law</h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="practice-section">
                        <div class="practices-wrapper">
                            <div class="practices-icon-wrapper">
                                <div class="practice-dot">
                                   <div class="dots dots-2"></div>
                                </div>
                                <i class="fi flaticon-wounded"></i>
                            </div>
                            <div class="practice-content">
                                <h2>Personal Injury</h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="practice-section">
                        <div class="practices-wrapper">
                            <div class="practices-icon-wrapper">
                                <div class="practice-dot">
                                   <div class="dots"></div>
                                </div>
                                <i class="fi flaticon-manager"></i>
                            </div>
                            <div class="practice-content">
                                <h2>Business Law</h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="practice-section">
                        <div class="practices-wrapper">
                            <div class="practices-icon-wrapper">
                                <div class="practice-dot">
                                   <div class="dots"></div>
                                </div>
                                <i class="fi flaticon-mafia"></i>
                            </div>
                            <div class="practice-content">
                                <h2>Criminal Law</h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="practice-section">
                        <div class="practices-wrapper">
                            <div class="practices-icon-wrapper">
                                <div class="practice-dot">
                                   <div class="dots"></div>
                                </div>
                                <i class="fi flaticon-graduation-hat"></i>
                            </div>
                            <div class="practice-content">
                                <h2>Education Law</h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="practice-section">
                        <div class="practices-wrapper">
                            <div class="practices-icon-wrapper">
                                <div class="practice-dot">
                                   <div class="dots"></div>
                                </div>
                                <i class="fi flaticon-house"></i>
                            </div>
                            <div class="practice-content">
                                <h2>Real Estate Law</h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- practice-area end -->
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
                                <span>Office no 3 2nd floor, Kareem chamber, road, Mozang Chungi, Lahore, 54000</span>
                            </div>
                        </div>
                        <div class="contact-sub">
                            <div class="contact-icon">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <div class="contact-c">
                                <h4>Phone</h4>
                                <span>+92 322 4490008</span>
                            </div>
                        </div>
                        <div class="contact-sub">
                            <div class="contact-icon">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </div>
                            <div class="contact-c">
                                <h4>Email</h4>
                                <span>legallaw669@gmail.com</span>
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
    <!--Testimonial Area Start-->
    <div class="testimonial-area section-padding">
        <div class="container">
            <div class="row">
                <div class="testimonial-active">
                    <!--Testimonial Block-->
                    <div class="my-testimonial">
                        <div class="inner-content">
                            <div class="content">
                                <div class="image-box"><img src="<?= base_url('assets/images/testimonials/1.png') ?>" alt="" /></div>
                                <div class="quote-icon"><i class="fi flaticon-right-quote"></i></div>
                                <h4>Ahmad Naeem</h4>
                                <div class="designation">Tax Law Client</div>
                                <div class="text">I highly recommend Muhammad Mazz Ahmad for Criminal and Tax cases. They handled all my cases with exceptional knowledge and communication, keeping me informed every step of the way. Mazz was incredibly responsive and empathetic, making a stressful time much easier.</div>
                            </div>
                        </div>
                    </div>
                    <div class="my-testimonial">
                        <div class="inner-content">
                            <div class="content">
                                <div class="image-box"><img src="<?= base_url('assets/images/testimonials/2.png') ?>" alt="" /></div>
                                <div class="quote-icon"><i class="fi flaticon-right-quote"></i></div>
                                <h4>Uzair Afridi</h4>
                                <div class="designation">Family law</div>
                                <div class="text">Great Experience with Legal Eagle Law Firm Legal Eagle Law Firm is professional, knowledgeable, and reliable. They explained everything clearly and handled my case efficiently. The team was responsive and supportive throughout the process.</div>
                            </div>
                        </div>
                    </div>
                    <div class="my-testimonial">
                        <div class="inner-content">
                            <div class="content">
                                <div class="image-box"><img src="<?= base_url('assets/images/testimonials/3.png') ?>" alt="" /></div>
                                <div class="quote-icon"><i class="fi flaticon-right-quote"></i></div>
                                <h4>Rana Awais</h4>
                                <div class="designation">Customer Title</div>
                                <div class="text">Great Experience with Legal Eagle Law Firm Highly professional law firm delivering accurate legal opinions with integrity, clarity, timely guidance, and client-focused expertise in law firm industry</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Testimonial Area End-->



