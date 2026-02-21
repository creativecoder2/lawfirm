<div class="content-header">
    <h1>
        Feature Details
        <small>View detailed information and icon for this homepage feature</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Feature Overview</h3>
                <a href="<?= base_url('admin/features') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th>Feature ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $feature['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Icon Preview</th>
                        <td>
                            <div class="text-center p-3 rounded d-inline-block" style="background: #f8fafc; color: #d0a15e; font-size: 32px; min-width: 80px;">
                                <i class="<?= $feature['icon'] ?>"></i>
                            </div>
                            <div class="mt-2 small text-muted">Class: <code><?= $feature['icon'] ?></code></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td><strong><?= $feature['title'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Subtitle / Description</th>
                        <td><?= $feature['subtitle'] ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if($feature['is_active'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/feature_edit/'.$feature['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Feature</a>
            </div>
        </div>
    </div>
</div>
