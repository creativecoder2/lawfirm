<div class="content-header">
    <h1>
        Practice Area Details
        <small>View comprehensive details and icon for this legal practice area</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Area Overview</h3>
                <a href="<?= base_url('admin/practice') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th>Area ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $practice['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Main Image</th>
                        <td>
                            <?php if(!empty($practice['image'])): ?>
                                <img src="<?= base_url($practice['image']) ?>" alt="" style="max-width: 300px; border: 1px solid #ddd; padding: 5px;">
                            <?php else: ?>
                                <span class="text-muted">No Image Uploaded</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Area Title</th>
                        <td><strong><?= $practice['title'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Detailed Description</th>
                        <td><?= nl2br($practice['description']) ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <?php if($practice['is_active'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/practice_edit/'.$practice['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Area</a>
            </div>
        </div>
    </div>
</div>
