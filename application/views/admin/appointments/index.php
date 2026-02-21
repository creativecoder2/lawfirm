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
                                        <th>Contact</th>
                                        <th>Attorney</th>
                                        <th>Message</th>
                                        <th style="width: 120px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($appointments as $app): ?>
                                    <tr>
                                        <td><small><?= date('M d, Y', strtotime($app['created_at'])) ?></small></td>
                                        <td><strong><?= $app['name'] ?></strong></td>
                                        <td>
                                            <small><?= $app['email'] ?></small><br>
                                            <strong><?= $app['phone'] ?></strong>
                                        </td>
                                        <td><small><?= $app['attorney_name'] ?: 'General' ?></small></td>
                                        <td><div style="font-size: 12px; max-height: 50px; overflow-y: auto;"><?= nl2br($app['note']) ?></div></td>
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
