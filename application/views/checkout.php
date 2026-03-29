<?php
$twocheckout_merchant_code = isset($settings['twocheckout_merchant_code']) ? $settings['twocheckout_merchant_code'] : '';
?>

<!-- .breadcumb-area start -->
<div class="breadcumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->

<div class="checkout-area section-padding" style="background: #fdfdfd;">
    <div class="container">
        <div class="row">
            <!-- Left Side: Summary -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h4 class="mb-0" style="color: #333; font-weight: 700;"><i class="fa fa-info-circle text-gold"></i> Appointment Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small text-uppercase">Client Name</label>
                                <p class="h6 mb-0 font-weight-bold text-dark"><?= $appointment['name'] ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small text-uppercase">Phone Number</label>
                                <p class="h6 mb-0 font-weight-bold text-dark"><?= $appointment['phone'] ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="text-muted small text-uppercase">Email Address</label>
                                <p class="h6 mb-0 text-dark"><?= $appointment['email'] ?: '—' ?></p>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-12 text-center py-4 my-2" style="background: rgba(188,147,85,0.05); border-radius: 8px; border: 1px dashed rgba(188,147,85,0.3);">
                                <label class="text-muted small text-uppercase">Consultation Category</label>
                                <h4 class="text-dark mb-1 font-weight-bold"><?= $appointment['category_name'] ?? 'General Consultation' ?></h4>
                                <h2 style="color: #bc9355; font-weight: 800;">PKR <?= number_format($appointment['consultation_fee'] ?? 0, 2) ?></h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label class="text-muted small text-uppercase">Case Description & Notes</label>
                                <div class="p-3 bg-light border-radius-8" style="font-size: 14px; border-left: 3px solid #dee2e6;">
                                    <?= nl2br($appointment['note'] ?? 'No notes provided.') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h4 class="mb-0" style="color: #333; font-weight: 700;"><i class="fa fa-credit-card text-gold"></i> Selected Payment Method</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex align-items-center p-3" style="background: #f8f9fa; border-radius: 8px; border: 1px solid #eee;">
                            <div class="payment-icon mr-3">
                                <?php 
                                $pm = $appointment['payment_method'] ?? 'twocheckout';
                                $icon_url = ($pm === 'paypro') ? 'https://paypro.com.pk/wp-content/uploads/2022/08/cropped-Logo_Blue.png' : base_url('assets/images/payments/' . $pm . '.svg');
                                ?>
                                <img src="<?= $icon_url ?>" alt="<?= $pm ?>" style="height: 40px; width: 60px; object-fit: contain;" onerror="this.src='https://cdn-icons-png.flaticon.com/512/337/337946.png';">
                            </div>
                            <div>
                                <h5 class="mb-0 text-capitalize"><?= str_replace('_', ' ', $pm) ?></h5>
                                <span class="text-success small"><i class="fa fa-lock"></i> Secure Transaction</span>
                            </div>
                            <div class="ml-auto">
                                <a href="<?= site_url('welcome/free_consultation?edit=true') ?>" class="btn btn-sm btn-outline-secondary">Change</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Pay Button -->
            <div class="col-lg-5">
                <div class="card border-0 shadow sticky-top" style="border-radius: 16px; top: 100px; border-top: 5px solid #bc9355;">
                    <div class="card-body text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/2489/2489756.png" alt="Payment" style="width: 80px; margin-bottom: 25px;">
                        <h3 class="font-weight-bold mb-2">Ready to Secure?</h3>
                        <p class="text-muted px-3">Confirm your booking by completing the payment process below.</p>
                        
                        <div class="divider my-4" style="height: 1px; background: #eee;"></div>
                        
                        <div class="payment-actions px-3">
                            <?php if(isset($appointment['payment_method']) && $appointment['payment_method'] === 'paypro'): ?>
                                <button id="paypro-button" class="btn btn-block py-3 mt-3" style="background:#00a2e8; color:#fff;">
                                    Pay with PayPro
                                </button>
                                
                                <script>
                                document.getElementById('paypro-button').addEventListener('click', function(e) {
                                    e.preventDefault();
                                    var btn = this;
                                    btn.disabled = true;
                                    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
                                    
                                    $.ajax({
                                        url: '<?= site_url("welcome/process_paypro/" . ($appointment["uuid"] ?? "")) ?>',
                                        type: 'POST',
                                        dataType: 'json',
                                        success: function(res) {
                                            if (res.status === 'success' && res.redirect) {
                                                window.location.href = res.redirect;
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Payment Error',
                                                    text: res.message || 'Could not initiate PayPro checkout.',
                                                });
                                                btn.disabled = false;
                                                btn.innerHTML = 'Pay with PayPro';
                                            }
                                        },
                                        error: function() {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Network Error',
                                                text: 'Failed to connect to the server.'
                                            });
                                            btn.disabled = false;
                                            btn.innerHTML = 'Pay with PayPro';
                                        }
                                    });
                                });
                                </script>
                            <?php else: ?>
                                <div class="alert alert-info">
                                    No direct payment method selected. Please contact support.
                                </div>
                            <?php endif; ?>
                            
                            <div class="mt-4">
                                <p class="small text-muted mt-2"><i class="fa fa-lock"></i> 100% Secure & Encrypted Checkout</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-gold { color: #bc9355; }
.btn-gold { background: #bc9355; color: #fff; font-weight: 700; border-radius: 8px; border: none; transition: transform 0.2s; }
.btn-gold:hover { background: #a37f48; color: #fff; transform: translateY(-2px); }
.shadow-sm { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; }
.shadow { box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important; }
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
