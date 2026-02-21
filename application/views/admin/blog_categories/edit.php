<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Blog Category</h3>
        <a href="<?= base_url('admin/blog_categories') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
    </div>
    <?= form_open('admin/blog_category_edit/'.$category['id']) ?>
        <div class="box-body">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" class="form-control" name="name" value="<?= $category['name'] ?>" required>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update Category</button>
        </div>
    <?= form_close() ?>
</div>
