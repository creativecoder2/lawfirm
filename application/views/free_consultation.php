<!-- .breadcumb-area start -->
<div class="breadcumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Free Consultation</h2>
                    <ul>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><span>Free Consultation</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->

<!-- .upper-white-section start -->
<div class="about-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span style="color: #bc9355; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;">Consultation Details</span>
                    <h2 style="font-size: 36px; font-weight: 700; margin-top: 10px; color: #333;">
                        <?= isset($settings['free_consultation_title']) ? $settings['free_consultation_title'] : 'Get a Free Consultation' ?>
                    </h2>
                    <div style="width: 80px; height: 3px; background: #bc9355; margin: 20px auto;"></div>
                    <p style="font-size: 18px; line-height: 1.8; color: #666; max-width: 800px; margin: 0 auto;">
                        <?= isset($settings['free_consultation_desc']) ? nl2br($settings['free_consultation_desc']) : 'Our dedicated legal team is here to provide you with the guidance and support you need. Schedule your free consultation today to discuss your case with one of our experienced attorneys.' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .upper-white-section end -->

<!-- .contact area start -->
<div class="contact-area section-padding" style="background: #231b0e; color: #fff;">
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

    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="contact-text">
                    <h2><?= isset($settings['free_consultation_form_title']) ? $settings['free_consultation_form_title'] : 'Book your Appointment' ?></h2>
                    <p><?= isset($settings['contact_page_text']) ? nl2br($settings['contact_page_text']) : 'Contact us today for a free legal consultation. Our expert attorneys are ready to help you with your legal needs.' ?></p>
                    <div class="contact-sub">
                        <div class="contact-icon">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                        </div>
                        <div class="contact-c">
                            <h4>Our Location</h4>
                            <span><?= isset($settings['contact_address']) ? $settings['contact_address'] : 'Office no 3 2nd floor, Kareem chamber, road, Mozang Chungi, Lahore, 54000' ?></span>
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
                <div class="contact-form">
                    <form method="post" action="<?= site_url('welcome/submit_appointment') ?>" id="cms-appointment-form">
                        <input type="hidden" name="_token" value="<?= md5(uniqid(mt_rand(), true)) ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="name" id="name" class="cms-input" placeholder="Your Name" value="<?= $prefill['name'] ?? '' ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" name="phone" id="phone" class="cms-input" placeholder="Phone" value="<?= $prefill['phone'] ?? '' ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="email" name="email" id="email" class="cms-input" placeholder="Email" value="<?= $prefill['email'] ?? '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="practice_category_id" id="practice_category_id" class="cms-input" required onchange="updateFee(this)">
                                    <option value="0" data-fee="0" <?= (isset($prefill['practice_category_id']) && $prefill['practice_category_id'] == 0) ? 'selected' : '' ?>>Free Consultation</option>
                                    <?php if(!empty($practice_areas)): foreach($practice_areas as $pa): ?>
                                    <option value="<?= $pa['id'] ?>" data-fee="<?= number_format($pa['consultation_fee'] ?? 0, 2) ?>" <?= (isset($prefill['practice_category_id']) && $prefill['practice_category_id'] == $pa['id']) ? 'selected' : '' ?>>
                                        <?= $pa['title'] ?>
                                    </option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <small id="fee-notice-text" style="display:block; margin-top:-15px; margin-bottom: 15px; color:#bc9355; font-size:12px; font-style:italic;">
                                    Note: Some legal Cases may require a professional consultation fee.
                                </small>
                            </div>
                            <div class="col-12 mb-3">
                                <textarea class="cms-input" name="note" id="note" placeholder="Case Description..." required style="height: 120px;"><?= $prefill['note'] ?? '' ?></textarea>
                            </div>

                            <!-- Payment Selection -->
                            <div class="col-12">
                                <div id="payment-section-container" style="display:none; width:100%; margin: 10px 0 20px;">
                                    <div id="payment-fee-summary" style="display:none; margin-bottom:14px; padding:14px 16px; background:rgba(188,147,85,0.05); border:1px solid rgba(188,147,85,0.2); border-radius:8px;">
                                        <div style="display:flex; justify-content:space-between; align-items:center;">
                                            <div>
                                                <div style="color:#ccc; font-size:11px; text-transform:uppercase;">Selected Category</div>
                                                <div id="summary-category" style="color:#fff; font-size:14px; font-weight:600;">—</div>
                                            </div>
                                            <div style="text-align:right;">
                                                <div style="color:#ccc; font-size:11px; text-transform:uppercase;">Fee</div>
                                                <div id="summary-fee" style="color:#bc9355; font-size:20px; font-weight:700;">$ 0</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="payment-free-notice" style="display:none; margin-bottom:14px; padding:10px 14px; background:rgba(46,204,64,0.05); border:1px solid rgba(46,204,64,0.2); border-radius:8px; color:#fff; font-size:13px;">
                                        <i class="fa fa-check-circle" style="color:#2ecc40;"></i>&nbsp; This consultation is <strong style="color:#2ecc40;">free of charge</strong>.
                                    </div>

                                    <p style="color:#ccc; margin-bottom:10px; font-size:14px; font-weight:600;"><i class="fa fa-credit-card"></i>&nbsp; Select Payment Method</p>
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

                            <div class="col-12 text-center">
                                <button type="submit" class="theme-btn" id="appt-submit-btn" style="background: #bc9355; border: none; padding: 12px 40px; font-weight: 600; color: #fff;">Get Appointment</button>
                                <div id="loader" class="mt-2" style="display: none;">
                                    <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .contact area end -->

<!-- .lower-white-section start -->
<div class="practice-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2 style="font-size: 32px; font-weight: 700; color: #333;">
                        <?= isset($settings['free_consultation_footer_title']) ? $settings['free_consultation_footer_title'] : 'Why Choose Our Legal Services?' ?>
                    </h2>
                    <div style="width: 60px; height: 3px; background: #bc9355; margin: 15px auto;"></div>
                    <p style="font-size: 16px; line-height: 1.7; color: #777; max-width: 750px; margin: 0 auto;">
                        <?= isset($settings['free_consultation_footer_desc']) ? nl2br($settings['free_consultation_footer_desc']) : 'We are committed to delivering excellence in every case we handle. Our approach combines legal expertise with personalized attention to ensure your rights are protected.' ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .lower-white-section end -->

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

        if (!name || !phone || !cat) {
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
                btn.prop('disabled', false).text('Get Appointment');
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
                    $('#payment-section-container').hide();
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
                btn.prop('disabled', false).text('Get Appointment');
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

<?php if($this->session->flashdata('success')): ?>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '<?= $this->session->flashdata('success') ?>',
        confirmButtonColor: '#bc9355'
    });
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '<?= $this->session->flashdata('error') ?>',
        confirmButtonColor: '#bc9355'
    });
<?php endif; ?>
</script>
