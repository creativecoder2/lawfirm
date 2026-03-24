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
    <div class="contact-area section-padding" style="background: #231b0e; color: #fff;">
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
                    <style>
                    /* Sync Styles from Home */
                    .payment-methods-grid { display: flex; flex-wrap: wrap; gap: 10px; width: 100%; }
                    .payment-method-card { cursor: pointer; flex: 1 1 calc(20% - 10px); min-width: 80px; }
                    .payment-method-card input[type="radio"] { display: none; }
                    .pm-inner { display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 10px 8px; border: 2px solid rgba(255,255,255,0.1); border-radius: 8px; background: rgba(255,255,255,0.05); transition: all 0.25s ease; gap: 6px; }
                    .pm-inner img { width: 40px; height: 28px; object-fit: contain; filter: brightness(0) invert(1); }
                    .pm-name { font-size: 11px; color: #ccc; text-align: center; }
                    .payment-method-card input:checked + .pm-inner { border-color: #bc9355; background: rgba(188,147,85,0.2); box-shadow: 0 0 0 2px rgba(188,147,85,0.3); }
                    .payment-method-card input:checked + .pm-inner .pm-name { color: #fff; font-weight: 600; }
                    .payment-method-card:hover .pm-inner { border-color: #bc9355; }
                    .pm-fallback { color: #bc9355; font-size: 20px; }

                    .cms-input {
                        background: rgba(255, 255, 255, 0.1);
                        height: 50px;
                        padding: 6px 15px;
                        color: #fff;
                        border: 1px solid rgba(255, 255, 255, 0.1);
                        border-radius: 5px;
                        width: 100%;
                        margin-bottom: 20px;
                        transition: all 0.3s;
                    }
                    .cms-input:focus {
                        outline: none;
                        background: rgba(255, 255, 255, 0.15);
                        border-color: #bc9355;
                    }
                    .cms-input::placeholder { color: rgba(255, 255, 255, 0.5); }
                    .cms-input select option { background: #231b0e; color: #fff; }
                    #practice_category_id option { background: #231b0e; color: #fff; }
                    </style>

                    <div class="contact-content p-4" style="background: #231b0e; border-radius: 10px; color: #fff;">
                        <div class="contact-form">
                            <form method="post" action="<?= site_url('welcome/submit_appointment') ?>" id="cms-appointment-form">
                                <input type="hidden" name="_token" value="<?= md5(uniqid(mt_rand(), true)) ?>">
                                <div class="half-col">
                                    <input type="text" name="name" id="name" class="cms-input" placeholder="Your Name" required>
                                </div>
                                <div class="half-col">
                                    <input type="text" name="phone" id="phone" class="cms-input" placeholder="Phone" required>
                                </div>
                                <div class="half-col">
                                    <input type="email" name="email" id="email" class="cms-input" placeholder="Email">
                                </div>
                                <div class="half-col">
                                    <select name="practice_category_id" id="practice_category_id" class="cms-input" required onchange="updateFee(this)">
                                        <option value="0" data-fee="0" selected>Free Consultation</option>
                                        <?php if(!empty($practice_areas)): foreach($practice_areas as $pa): ?>
                                        <option value="<?= $pa['id'] ?>" data-fee="<?= number_format($pa['consultation_fee'] ?? 0, 2) ?>">
                                            <?= $pa['title'] ?>
                                        </option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <small id="fee-notice-text" style="display:block; margin-top:-15px; margin-bottom: 15px; color:#bc9355; font-size:12px; font-style:italic;">
                                        Note: Some legal Cases may require a professional consultation fee.
                                    </small>
                                </div>
                                <div>
                                    <textarea class="cms-input" name="note" id="note" placeholder="Case Description..." required style="height: 120px;"></textarea>
                                </div>

                                <!-- Payment Selection -->
                                <div style="padding: 0 15px;">
                                    <div id="payment-section-container" style="display:none; width:100%; margin: 10px 0 20px;">
                                        <!-- Fee summary -->
                                        <div id="payment-fee-summary" style="display:none; margin-bottom:14px; padding:14px 16px; background:rgba(188,147,85,0.05); border:1px solid rgba(188,147,85,0.2); border-radius:8px;">
                                            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                                                <div>
                                                    <div style="color:#777; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Category</div>
                                                    <div id="summary-category" style="color:#333; font-size:14px; font-weight:600; margin-top:2px;">—</div>
                                                </div>
                                                <div style="text-align:right;">
                                                    <div style="color:#777; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Fee</div>
                                                    <div id="summary-fee" style="color:#bc9355; font-size:22px; font-weight:700; margin-top:2px;">$ 0</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Free notice -->
                                        <div id="payment-free-notice" style="display:none; margin-bottom:14px; padding:10px 14px; background:rgba(46,204,64,0.05); border:1px solid rgba(46,204,64,0.2); border-radius:8px; color:#555; font-size:13px;">
                                            <i class="fa fa-check-circle" style="color:#2ecc40;"></i>&nbsp; This consultation is <strong style="color:#2ecc40;">free</strong>.
                                        </div>
                                        
                                        <p style="color:#444; margin-bottom:10px; font-size:14px; font-weight:600;"><i class="fa fa-credit-card"></i>&nbsp; Payment Method</p>
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
                                </div>

                                <div class="submit-btn-wrapper">
                                    <button type="submit" id="appt-submit-btn" class="theme-btn">Appointment</button>
                                    <div id="loader" style="display:none;">
                                        <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .contact area end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        document.getElementById('summary-fee').innerText = '$ ' + fee.toLocaleString('en-US', {minimumFractionDigits: 0, maximumFractionDigits: 0});
        feeSum.style.display   = 'block';
        freeNote.style.display = 'none';
        paySec.style.display   = 'block';
    } else if (sel.value !== "") {
        feeSum.style.display   = 'none';
        freeNote.style.display = 'block';
        paySec.style.display   = 'none';
    } else {
        feeSum.style.display   = 'none';
        freeNote.style.display = 'none';
        paySec.style.display   = 'none';
    }
}

$(document).ready(function() {
    // Initialize initial state
    var sel = $('#practice_category_id')[0];
    if(sel) updateFee(sel);

    $('#cms-appointment-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        
        var name  = $('#name').val().trim();
        var phone = $('#phone').val().trim();
        var cat   = $('#practice_category_id').val();
        var pmEl  = $('input[name="payment_method"]:checked').val();

        if (!name || !phone || cat === null) {
             Swal.fire({ icon:'warning', title:'Missing Fields', text:'Please fill all required fields.', confirmButtonColor:'#bc9355' });
             return;
        }

        var opt = $('#practice_category_id option:selected');
        var fee = parseFloat(opt.attr('data-fee') || 0);

        if (fee > 0 && !pmEl) {
            Swal.fire({ icon:'warning', title:'Payment Method Required', text:'Please select a payment method.', confirmButtonColor:'#bc9355' });
            return;
        }

        var btn = $('#appt-submit-btn');
        var loader = $('#loader');

        btn.prop('disabled', true).text('Submitting...');
        loader.show();

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            dataType: "json",
            success: function(response) {
                btn.prop('disabled', false).text('Appointment');
                loader.hide();
                if (response.status === 'success') {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                        return;
                    }
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonColor: '#bc9355'
                    });
                    form[0].reset();
                    updateFee($('#practice_category_id')[0]);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                        confirmButtonColor: '#bc9355'
                    });
                }
            },
            error: function() {
                btn.prop('disabled', false).text('Appointment');
                loader.hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again later.',
                    confirmButtonColor: '#bc9355'
                });
            }
        });
    });
});
</script>
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



