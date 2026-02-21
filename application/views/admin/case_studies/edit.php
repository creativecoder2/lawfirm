<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block;">Edit Case Study</h4>
                    <a href="<?= base_url('admin/case_studies') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/case_study_edit/'.$case_study['id']) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="<?= $case_study['title'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" value="<?= $case_study['subtitle'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($case_study['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= $cat['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control editor" rows="10"><?= isset($case_study['description']) ? $case_study['description'] : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <br>
                            <img src="<?= base_url($case_study['image']) ?>" width="100" class="mb-2">
                            <input type="file" name="image" class="form-control">
                            <small>Leave blank to keep current image</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
