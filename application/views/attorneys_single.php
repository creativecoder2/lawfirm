<!-- .breadcumb-area start -->
    <div class="breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2><?= $attorney['name'] ?></h2>
                        <ul>
                            <li><a href="<?= base_url() ?>">Home</a></li>
                            <li><span>Attorney Details</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- Attorneys-content-section start -->
    <div class="Attorneys-content-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="Attorneys-info card shadow-sm border-0 p-4 mb-4" style="background: #fdfdfd; border-radius: 8px;">
                        <div class="Attorneys-content mb-3 pb-2 border-bottom">
                            <h3 style="color: #2c3e50; font-size: 22px;">Important Information</h3>
                        </div>
                        <div class="info-outer">
                            <ul class="info list-unstyled mb-4">
                                <li class="mb-2"><strong class="text-secondary">Position: </strong> <?= $attorney['designation'] ?></li>
                                <?php if(!empty($attorney['experience'])): ?>
                                    <li class="mb-2"><strong class="text-secondary">Experience: </strong><?= $attorney['experience'] ?></li>
                                <?php endif; ?>
                                <?php if(!empty($attorney['email'])): ?>
                                    <li class="mb-2"><strong class="text-secondary">Email: </strong><?= $attorney['email'] ?></li>
                                <?php endif; ?>
                                <?php if(!empty($attorney['phone'])): ?>
                                    <li class="mb-2"><strong class="text-secondary">Phone: </strong><?= $attorney['phone'] ?></li>
                                <?php endif; ?>
                                <?php if(!empty($attorney['languages'])): ?>
                                    <li class="mb-2"><strong class="text-secondary">Languages: </strong><?= $attorney['languages'] ?></li>
                                <?php endif; ?>
                                <?php if(!empty($attorney['address'])): ?>
                                    <li class="mb-2"><strong class="text-secondary">Address: </strong><?= $attorney['address'] ?></li>
                                <?php endif; ?>
                            </ul>
                            <div class="social-links d-flex gap-3">
                                <?php if($attorney['facebook']): ?>
                                    <a href="<?= $attorney['facebook'] ?>" class="text-primary" style="font-size: 20px;"><i class="fa fa-facebook"></i></a>
                                <?php endif; ?>
                                <?php if($attorney['twitter']): ?>
                                    <a href="<?= $attorney['twitter'] ?>" class="text-info" style="font-size: 20px;"><i class="fa fa-twitter"></i></a>
                                <?php endif; ?>
                                <?php if($attorney['linkedin']): ?>
                                    <a href="<?= $attorney['linkedin'] ?>" class="text-primary" style="font-size: 20px;"><i class="fa fa-linkedin"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="exrienense-img mb-4 overflow-hidden" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                        <img src="<?= !empty($attorney['image']) ? base_url($attorney['image']) : base_url('assets/images/team/1.jpg') ?>" alt="<?= $attorney['name'] ?>" class="img-fluid w-100" style="object-fit: cover; max-height: 450px;">
                    </div>

                    <?php if(!empty($attorney['bio'])): ?>
                        <div class="exrienense-section mb-5">
                            <h2 class="mb-3" style="font-weight: 700;">Personal Experience & Bio</h2>
                            <div class="bio-content content-text" style="line-height: 1.8; color: #555;">
                                <?= $attorney['bio'] ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(!empty($attorney['education'])): ?>
                        <div class="education-section mb-5">
                            <h2 class="mb-3" style="font-weight: 700;">Education</h2>
                            <div class="edu-items">
                                <?php 
                                $edu_lines = explode("\n", $attorney['education']);
                                foreach($edu_lines as $line): if(trim($line)): ?>
                                    <span class="d-block mb-2" style="font-size: 16px; color: #555;">
                                        <i class="fa fa-caret-right mr-2" style="color: #d0a15e;"></i>
                                        <?= trim($line) ?>
                                    </span>
                                <?php endif; endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="participated-cases mb-5">
                        <h2 class="mb-4" style="font-weight: 700;">Participated Cases</h2>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="case-item shadow-sm p-3 text-center" style="background: #fff; border-radius: 8px;">
                                    <h4 style="font-size: 16px; color: #d0a15e;">Corporate</h4>
                                    <p class="mb-0" style="font-weight: 600;">General Service</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="case-item shadow-sm p-3 text-center" style="background: #fff; border-radius: 8px;">
                                    <h4 style="font-size: 16px; color: #d0a15e;">General</h4>
                                    <p class="mb-0" style="font-weight: 600;">Personal Issue</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="case-item shadow-sm p-3 text-center" style="background: #fff; border-radius: 8px;">
                                    <h4 style="font-size: 16px; color: #d0a15e;">Business</h4>
                                    <p class="mb-0" style="font-weight: 600;">Accounting</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Attorneys-content-section end -->

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
                <div class="col-lg-12">
                    <div class="contact-area-dark" style="background: transparent; color: #fff;">
                        <h2 class="mb-4 text-center" style="font-weight: 700; color: #fff;">Book your Appointment</h2>
                        <div class="contact-form">
                            <form method="post" action="<?= site_url('welcome/submit_appointment') ?>" id="cms-appointment-form">
                                <input type="hidden" name="_token" value="<?= md5(uniqid(mt_rand(), true)) ?>">
                                <input type="hidden" name="attorney_id" value="<?= $attorney['id'] ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="name" id="name" class="cms-input" placeholder="Your Name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="email" name="email" id="email" class="cms-input" placeholder="Your Email" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="phone" id="phone" class="cms-input" placeholder="Your Phone" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <select name="practice_category_id" id="practice_category_id" class="cms-input" required onchange="updateFee(this)">
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
                                    <div class="col-12 mb-3">
                                        <textarea class="cms-input" name="note" id="note" rows="4" placeholder="Case Description..." required style="height: auto;"></textarea>
                                    </div>

                                    <!-- Payment Selection (Same as Home) -->
                                    <div class="col-12">
                                        <div id="payment-section-container" style="display:none; width:100%; margin: 10px 0 20px;">
                                            <!-- Fee summary card -->
                                            <div id="payment-fee-summary" style="display:none; margin-bottom:14px; padding:14px 16px; background:rgba(188,147,85,0.05); border:1px solid rgba(188,147,85,0.2); border-radius:8px;">
                                                <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px;">
                                                    <div>
                                                        <div style="color:#777; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Selected Category</div>
                                                        <div id="summary-category" style="color:#333; font-size:14px; font-weight:600; margin-top:2px;">—</div>
                                                    </div>
                                                    <div style="text-align:right;">
                                                        <div style="color:#777; font-size:11px; text-transform:uppercase; letter-spacing:1px;">Consultation Fee</div>
                                                        <div id="summary-fee" style="color:#bc9355; font-size:22px; font-weight:700; margin-top:2px;">$ 0</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Free notice -->
                                            <div id="payment-free-notice" style="display:none; margin-bottom:14px; padding:10px 14px; background:rgba(46,204,64,0.05); border:1px solid rgba(46,204,64,0.2); border-radius:8px; color:#555; font-size:13px;">
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
    </div>
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

            // Check fee
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
    </script>



