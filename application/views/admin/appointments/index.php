<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Appointments
            <small>Manage appointment requests</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Appointment List</h3>
                    </div>
                    <div class="box-body">
                        <?php if($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                        <?php endif; ?>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="appointments-grid">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Client</th>
                                        <th>Category / Fee</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Transaction</th>
                                        <th>Attorney</th>
                                        <th>Message</th>
                                        <th style="width: 100px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($appointments as $app): ?>
                                    <tr>
                                        <td><small><?= date('M d, Y', strtotime($app['created_at'])) ?></small></td>
                                        <td>
                                            <strong><?= $app['name'] ?></strong><br>
                                            <small><?= $app['email'] ?></small><br>
                                            <small><?= $app['phone'] ?></small>
                                        </td>
                                        <td>
                                            <small>
                                                <?php 
                                                if($app['practice_category_id'] == 0) echo 'Free Consultation';
                                                else echo $app['practice_title'] ?: 'General';
                                                ?>
                                            </small><br>
                                            <?php if($app['consultation_fee']): ?>
                                                <strong class="text-primary">$ <?= number_format($app['consultation_fee'], 0) ?></strong>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($app['payment_method']): 
                                                $pm_labels = ['paypro'=>'PayPro','twocheckout'=>'2Checkout','easypaisa'=>'EasyPaisa','jazzcash'=>'JazzCash','paypal'=>'PayPal','credit_card'=>'Card','pioneer'=>'Payoneer','manual'=>'Manual'];
                                                $pm = $app['payment_method'];
                                                $pm_colors = ['paypro'=>'#bc9355','twocheckout'=>'#bc9355','easypaisa'=>'#2ecc40','jazzcash'=>'#e31f26','paypal'=>'#003087','credit_card'=>'#1a1f71','pioneer'=>'#FF4800','manual'=>'#607D8B'];
                                                $pm_icons  = ['paypro'=>'fa-credit-card','twocheckout'=>'fa-credit-card','easypaisa'=>'fa-mobile','jazzcash'=>'fa-mobile','paypal'=>'fa-paypal','credit_card'=>'fa-credit-card','pioneer'=>'fa-globe','manual'=>'fa-money'];
                                                $color = $pm_colors[$pm] ?? '#777';
                                                $label = $pm_labels[$pm] ?? ucfirst($pm);
                                                $icon  = $pm_icons[$pm] ?? 'fa-money';
                                            ?>
                                                <span style="display:inline-block; background:<?= $color ?>; color:#fff; padding:4px 10px; border-radius:4px; font-size:11px; font-weight:600; letter-spacing:0.3px;">
                                                    <i class="fa <?= $icon ?>"></i> <?= $label ?>
                                                </span>
                                            <?php else: ?>
                                                <span style="display:inline-block; background:#e0e0e0; color:#777; padding:4px 10px; border-radius:4px; font-size:11px;">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php 
                                            $ps = $app['payment_status'] ?? 'pending';
                                            $ps_map = [
                                                'paid'    => ['bg'=>'#e8f5e9','color'=>'#2e7d32','icon'=>'fa-check-circle','label'=>'Paid'],
                                                'pending' => ['bg'=>'#fff8e1','color'=>'#f57f17','icon'=>'fa-clock-o','label'=>'Pending'],
                                                'failed'  => ['bg'=>'#ffebee','color'=>'#c62828','icon'=>'fa-times-circle','label'=>'Failed'],
                                                'free'    => ['bg'=>'#e3f2fd','color'=>'#1565c0','icon'=>'fa-gift','label'=>'Free'],
                                            ];
                                            $s = $ps_map[$ps] ?? ['bg'=>'#f5f5f5','color'=>'#777','icon'=>'fa-question','label'=>ucfirst($ps)];
                                            ?>
                                            <span style="display:inline-block; background:<?= $s['bg'] ?>; color:<?= $s['color'] ?>; padding:4px 10px; border-radius:4px; font-size:11px; font-weight:600;">
                                                <i class="fa <?= $s['icon'] ?>"></i> <?= $s['label'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($app['transaction_id'] && $app['transaction_id'] !== '—'): ?>
                                                <code style="background:#f5f5f5; padding:3px 8px; border-radius:3px; font-size:11px; color:#333;"><?= $app['transaction_id'] ?></code>
                                            <?php else: ?>
                                                <span style="color:#ccc;">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><small><?= $app['attorney_name'] ?: 'General' ?></small></td>
                                        <td><div style="font-size: 11px; max-height: 50px; overflow-y: auto;"><?= nl2br($app['note'] ?? '') ?></div></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="<?= site_url('admin/appointment_view/'.$app['id']) ?>" class="btn btn-info btn-sm" title="View Details"><i class="fa fa-eye"></i></a>
                                                
                                                <?php if($app['phone']): 
                                                    $wa_message = "Hello " . $app['name'] . ", regarding your appointment: " . substr($app['note'], 0, 50) . "...";
                                                    $wa_url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $app['phone']) . "?text=" . urlencode($wa_message);
                                                ?>
                                                    <a href="<?= $wa_url ?>" target="_blank" class="btn btn-success btn-sm" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                                                <?php endif; ?>
                                                
                                                <a href="<?= site_url('admin/appointment_delete/'.$app['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#appointments-grid').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false
    });
});
</script>
