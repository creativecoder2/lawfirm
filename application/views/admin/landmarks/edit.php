<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block;">Edit Landmark Case</h4>
                    <a href="<?= base_url('admin/landmarks') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/landmark_edit/'.$landmark['id']) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required value="<?= $landmark['title'] ?>">
                        </div>
                        <div class="form-group">
                            <label>PDF File</label>
                            <div class="mb-2">
                                <small class="text-muted">Current file: <a href="<?= base_url($landmark['pdf']) ?>" target="_blank"><?= basename($landmark['pdf']) ?></a></small>
                            </div>
                            <input type="file" name="pdf" class="form-control" accept=".pdf">
                            <p class="help-block">Leave empty to keep the current file.</p>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" <?= $landmark['is_active'] == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $landmark['is_active'] == 0 ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Landmark</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
