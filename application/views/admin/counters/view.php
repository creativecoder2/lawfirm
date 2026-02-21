<div class="content-header">
    <h1>
        Counter Details
        <small>View performance metrics and icons for this homepage counter</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Counter Overview</h3>
                <a href="<?= base_url('admin/counters') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th width="200">Counter ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $counter['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Icon Preview</th>
                        <td>
                            <div class="text-center p-3 rounded d-inline-block" style="background: #f8fafc; color: #d0a15e; font-size: 32px; min-width: 80px;">
                                <i class="<?= $counter['icon'] ?>"></i>
                            </div>
                            <div class="mt-2 small text-muted">Class: <code><?= $counter['icon'] ?></code></div>
                        </td>
                    </tr>
                    <tr>
                        <th>Metric Title</th>
                        <td><strong><?= $counter['title'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Stat Value</th>
                        <td>
                            <span class="badge badge-info p-2" style="background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 16px;"><?= $counter['count_value'] ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Visibility Status</th>
                        <td>
                            <?php if($counter['is_active'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/counter_edit/'.$counter['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Counter</a>
            </div>
        </div>
    </div>
</div>
