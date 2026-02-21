<div class="content-header">
    <h1>
        Slider Details
        <small>View complete information for this homepage slider</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Slider Overview</h3>
                <a href="<?= base_url('admin/sliders') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th>Slider ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $slider['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Preview Image</th>
                        <td>
                            <img src="<?= base_url($slider['image']) ?>" class="img-thumbnail rounded shadow-sm" style="max-width: 400px;">
                        </td>
                    </tr>
                    <tr>
                        <th>Primary Title</th>
                        <td><strong><?= $slider['title'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Subtitle / Description</th>
                        <td><?= $slider['subtitle'] ?></td>
                    </tr>
                    <tr>
                        <th>Button Text</th>
                        <td><?= $slider['button_text'] ?></td>
                    </tr>
                    <tr>
                        <th>Button Link</th>
                        <td><code><?= $slider['button_link'] ?></code></td>
                    </tr>
                    <tr>
                        <th>Visibility Status</th>
                        <td>
                            <?php if($slider['is_active'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/slider_edit/'.$slider['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Slider</a>
            </div>
        </div>
    </div>
</div>
