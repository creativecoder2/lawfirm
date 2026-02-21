<div class="content-header">
    <h1>
        Newsletter Subscribers
        <small>Manage your audience and send updates</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Subscriber List</h3>
                <a href="<?= site_url('admin/subscriber_send_email') ?>" class="btn btn-primary btn-sm pull-right">
                    <i class="fa fa-paper-plane"></i> Send Email to All
                </a>
            </div>
            <div class="box-body p-0">
                <table class="table table-striped table-hover mt-3" id="dataTable">
                    <thead>
                        <tr>
                            <th width="50" class="text-center">ID</th>
                            <th>Email Address</th>
                            <th>Subscribed On</th>
                            <th width="200" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($subscribers)): foreach($subscribers as $s): ?>
                        <tr>
                            <td class="text-center"><?= $s['id'] ?></td>
                            <td><strong><?= $s['email'] ?></strong></td>
                            <td><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
                            <td class="text-right">
                                <a href="<?= site_url('admin/subscriber_send_email/'.$s['id']) ?>" class="btn btn-info btn-xs mr-2">
                                    <i class="fa fa-envelope"></i> Reply
                                </a>
                                <a href="javascript:void(0)" onclick="confirmDeleteSub(<?= $s['id'] ?>)" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDeleteSub(id) {
    Swal.fire({
        title: 'Remove Subscriber?',
        text: "They will no longer receive your updates.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, remove them!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?= site_url('admin/subscriber_delete/') ?>" + id;
        }
    })
}
</script>
