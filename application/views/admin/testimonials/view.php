<div class="content-header">
    <h1>
        Testimonial Details
        <small>View information and client feedback for this testimonial</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Testimonial Overview</h3>
                <a href="<?= base_url('admin/testimonials') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th>ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $testimonial['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Client Photo</th>
                        <td>
                            <img src="<?= base_url($testimonial['image']) ?>" class="img-thumbnail rounded shadow-sm" style="max-width: 200px;">
                        </td>
                    </tr>
                    <tr>
                        <th>Client Name</th>
                        <td><strong><?= $testimonial['name'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Designation / Role</th>
                        <td><span class="text-muted"><?= $testimonial['designation'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Client Feedback</th>
                        <td>
                            <div class="p-3 bg-light rounded italic" style="border-left: 4px solid #d0a15e; font-style: italic;">
                                "<?= nl2br($testimonial['comment']) ?>"
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Visibility Status</th>
                        <td>
                            <?php if($testimonial['is_active'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/testimonial_edit/'.$testimonial['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Testimonial</a>
            </div>
        </div>
    </div>
</div>
