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
                            <?php if(!empty($appointment['practice_category_id'])): ?>
                            <tr>
                                <th style="background: #f9f9f9;">Practice Category</th>
                                <td><?= isset($appointment['practice_title']) ? $appointment['practice_title'] : '—' ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($appointment['consultation_fee'])): ?>
                            <tr>
                                <th style="background: #f9f9f9;">Consultation Fee</th>
                                <td><strong>Rs. <?= number_format($appointment['consultation_fee'], 0) ?></strong></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($appointment['payment_method'])): ?>
                            <tr>
                                <th style="background: #f9f9f9;">Payment Method</th>
                                <td>
                                    <?php
                                    $pm_labels = ['easypaisa'=>'EasyPaisa','jazzcash'=>'JazzCash','paypal'=>'PayPal','credit_card'=>'Credit Card','pioneer'=>'Payoneer'];
                                    $pm = $appointment['payment_method'];
                                    $pm_colors = ['easypaisa'=>'#2ecc40','jazzcash'=>'#e31f26','paypal'=>'#003087','credit_card'=>'#1a1f71','pioneer'=>'#FF4800'];
                                    $color = $pm_colors[$pm] ?? '#777';
                                    $label = $pm_labels[$pm] ?? ucfirst($pm);
                                    ?>
                                    <span class="label" style="background:<?= $color ?>; font-size:13px; padding:5px 10px;">
                                        <?= $label ?>
                                    </span>
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
