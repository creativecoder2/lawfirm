<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Contact Messages
            <small>All messages submitted through the website contact form</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-envelope-o"></i> Inbox</h3>
                    </div>
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" style="margin: 10px 15px;"><?= $this->session->flashdata('success') ?></div>
                    <?php endif; ?>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="messages-grid">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Message Preview</th>
                                        <th style="width:130px;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($messages as $msg): ?>
                                    <tr class="<?= !$msg['is_read'] ? 'warning' : '' ?>">
                                        <td><small><?= date('M d, Y', strtotime($msg['created_at'])) ?></small></td>
                                        <td>
                                            <strong><?= $msg['name'] ?></strong>
                                            <?php if(!$msg['is_read']): ?>
                                                <span class="label label-warning" style="margin-left:4px;">New</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <small><?= $msg['email'] ?></small><br>
                                            <strong><?= $msg['phone'] ?></strong>
                                        </td>
                                        <td><small><?= substr($msg['message'], 0, 80) ?>...</small></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="<?= site_url('admin/contact_view/'.$msg['id']) ?>" class="btn btn-info btn-sm" title="View Message"><i class="fa fa-eye"></i></a>
                                                <?php if($msg['phone']): 
                                                    $wa_msg = "Hello " . $msg['name'] . ", thank you for contacting us. Regarding: " . substr($msg['message'], 0, 50) . "...";
                                                    $wa_url = "https://wa.me/" . preg_replace('/[^0-9]/', '', $msg['phone']) . "?text=" . urlencode($wa_msg);
                                                ?>
                                                    <a href="<?= $wa_url ?>" target="_blank" class="btn btn-success btn-sm" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                                                <?php endif; ?>
                                                <a href="<?= site_url('admin/contact_delete/'.$msg['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
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
    $('#messages-grid').DataTable({
        "paging": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "order": [[0, 'desc']]
    });
});
</script>
