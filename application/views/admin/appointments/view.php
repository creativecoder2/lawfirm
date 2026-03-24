<div class="content-wrapper">
    <section class="content-header">
        <h1>
            View Appointment
            <small>Detailed information</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Client Details</h3>
                        <div class="box-tools pull-right">
                            <a href="<?= site_url('admin/appointments') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px; background: #f9f9f9;">Client Name</th>
                                <td><strong><?= $appointment['name'] ?></strong></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Email Address</th>
                                <td><?= $appointment['email'] ?></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Phone Number</th>
                                <td><?= $appointment['phone'] ?></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Address</th>
                                <td><?= $appointment['address'] ?: 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Requested Attorney</th>
                                <td><span class="label label-info"><?= $appointment['attorney_name'] ?: 'General Inquiry' ?></span></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Practice Category</th>
                                <td>
                                    <?php 
                                    if($appointment['practice_category_id'] == 0) echo 'Free Consultation';
                                    else echo $appointment['practice_title'] ?: '—';
                                    ?>
                                </td>
                            </tr>
                            <?php if(!empty($appointment['consultation_fee'])): ?>
                            <tr>
                                <th style="background: #f9f9f9;">Consultation Fee</th>
                                <td><strong>$ <?= number_format($appointment['consultation_fee'], 0) ?></strong></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($appointment['payment_method'])): ?>
                            <tr>
                                <th style="background: #f9f9f9;">Payment Method</th>
                                <td>
                                    <?php
                                    $pm_labels = ['paypro'=>'PayPro','twocheckout'=>'2Checkout','easypaisa'=>'EasyPaisa','jazzcash'=>'JazzCash','paypal'=>'PayPal','credit_card'=>'Credit Card','pioneer'=>'Payoneer','manual'=>'Manual Transfer'];
                                    $pm = $appointment['payment_method'];
                                    $pm_colors = ['paypro'=>'#bc9355','twocheckout'=>'#bc9355','easypaisa'=>'#2ecc40','jazzcash'=>'#e31f26','paypal'=>'#003087','credit_card'=>'#1a1f71','pioneer'=>'#FF4800','manual'=>'#607D8B'];
                                    $pm_icons  = ['paypro'=>'fa-credit-card','twocheckout'=>'fa-credit-card','easypaisa'=>'fa-mobile','jazzcash'=>'fa-mobile','paypal'=>'fa-paypal','credit_card'=>'fa-credit-card','pioneer'=>'fa-globe','manual'=>'fa-money'];
                                    $color = $pm_colors[$pm] ?? '#777';
                                    $label = $pm_labels[$pm] ?? ucfirst($pm);
                                    $icon  = $pm_icons[$pm] ?? 'fa-money';
                                    ?>
                                    <span style="display:inline-block; background:<?= $color ?>; color:#fff; padding:5px 14px; border-radius:5px; font-size:13px; font-weight:600;">
                                        <i class="fa <?= $icon ?>"></i> <?= $label ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th style="background: #f9f9f9;">Payment Status</th>
                                <td>
                                    <?php 
                                    $ps = $appointment['payment_status'] ?? 'pending';
                                    $ps_map = [
                                        'paid'    => ['bg'=>'#e8f5e9','color'=>'#2e7d32','icon'=>'fa-check-circle','label'=>'Paid'],
                                        'pending' => ['bg'=>'#fff8e1','color'=>'#f57f17','icon'=>'fa-clock-o','label'=>'Pending'],
                                        'failed'  => ['bg'=>'#ffebee','color'=>'#c62828','icon'=>'fa-times-circle','label'=>'Failed'],
                                        'free'    => ['bg'=>'#e3f2fd','color'=>'#1565c0','icon'=>'fa-gift','label'=>'Free'],
                                    ];
                                    $s = $ps_map[$ps] ?? ['bg'=>'#f5f5f5','color'=>'#777','icon'=>'fa-question','label'=>ucfirst($ps)];
                                    ?>
                                    <span style="display:inline-block; background:<?= $s['bg'] ?>; color:<?= $s['color'] ?>; padding:5px 14px; border-radius:5px; font-size:13px; font-weight:600;">
                                        <i class="fa <?= $s['icon'] ?>"></i> <?= $s['label'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php if(!empty($appointment['transaction_id'])): ?>
                            <tr>
                                <th style="background: #f9f9f9;">Transaction ID</th>
                                <td>
                                    <code style="background:#f5f5f5; padding:5px 12px; border-radius:4px; font-size:13px; color:#333; border:1px solid #e0e0e0;">
                                        <?= $appointment['transaction_id'] ?>
                                    </code>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <tr>
                                <th style="background: #f9f9f9;">Submission Date</th>
                                <td><?= date('F d, Y - H:i', strtotime($appointment['created_at'])) ?></td>
                            </tr>
                            <tr>
                                <th style="background: #f9f9f9;">Message/Note</th>
                                <td style="white-space: pre-wrap;"><?= $appointment['note'] ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="box-footer">
                        <?php if($appointment['phone']): 
                            $wa_message = "Hello " . $appointment['name'] . ", I'm following up on your appointment request...";
                            $wa_url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $appointment['phone']) . "?text=" . urlencode($wa_message);
                        ?>
                            <a href="<?= $wa_url ?>" target="_blank" class="btn btn-success"><i class="fa fa-whatsapp"></i> Chat on WhatsApp</a>
                        <?php endif; ?>
                        <a href="<?= site_url('admin/appointment_delete/'.$appointment['id']) ?>" class="btn btn-danger delete-confirm"><i class="fa fa-trash"></i> Delete Request</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
