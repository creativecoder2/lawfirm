<div class="content-header">
    <h1>
        Edit Action Card
        <small>Update the card for the Home page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Card Details</h3>
            </div>
            <div class="box-body">
                <form action="<?= site_url('admin/feature_edit/'.$feature['id']) ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group text-center" style="background: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px;">
                        <label style="display:block;">Current Image</label>
                        <?php if(!empty($feature['image'])): ?>
                            <img src="<?= base_url($feature['image']) ?>" style="max-width: 150px; max-height: 150px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                        <?php else: ?>
                            <i class="<?= $feature['icon'] ?> fa-4x text-muted"></i>
                            <p class="text-muted">No image uploaded (using legacy icon: <?= $feature['icon'] ?>)</p>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Change Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Leave blank to keep the current image.</small>
                    </div>

                    <div class="form-group">
                        <label>Title (Main Text)</label>
                        <input type="text" name="title" class="form-control" value="<?= $feature['title'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Target Link (Website URL)</label>
                        <input type="text" name="link" class="form-control" value="<?= $feature['link'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <input type="number" name="priority" class="form-control" value="<?= $feature['priority'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1" <?= $feature['is_active'] ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= !$feature['is_active'] ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="box-footer" style="padding-left:0;">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Action Card</button>
                        <a href="<?= site_url('admin/features') ?>" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
