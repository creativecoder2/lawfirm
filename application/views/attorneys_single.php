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

                    <div class="contact-area contact-area-2 card border-0 shadow-sm p-4" style="background: #f9f9f9; border-radius: 10px;">
                        <h2 class="mb-4" style="font-weight: 700;">Contact Me</h2>
                        <div class="contact-form">
                            <form method="post" action="<?= site_url('welcome/submit_appointment') ?>" class="contact-validation-active" id="contact-form">
                                <input type="hidden" name="attorney_id" value="<?= $attorney['id'] ?>">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required style="padding: 12px;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required style="padding: 12px;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone" style="padding: 12px;">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Address" style="padding: 12px;">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <textarea class="form-control" name="note" id="note" rows="4" placeholder="Case Description..." required style="padding: 12px;"></textarea>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-warning" style="background: #d0a15e; border: none; padding: 12px 30px; font-weight: 600; color: #fff;">Get Appointment</button>
                                        <div id="loader" class="mt-2" style="display: none;">
                                            <i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="message-status mt-3"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
    <!-- Attorneys-content-section end -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#contact-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);
                var loader = $('#loader');
                var status = $('.message-status');

                loader.show();
                status.html('');

                $.ajax({
                    type: "POST",
                    url: form.attr('action'),
                    data: form.serialize(),
                    dataType: "json",
                    success: function(response) {
                        loader.hide();
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Your appointment has been submitted successfully. We will contact you shortly.',
                                confirmButtonColor: '#d0a15e'
                            });
                            form[0].reset();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message
                            });
                        }
                    },
                    error: function() {
                        loader.hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong. Please try again later.'
                        });
                    }
                });
            });
        });
    </script>



