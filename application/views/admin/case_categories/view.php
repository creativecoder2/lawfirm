<div class="content-header">
    <h1>
        Case Category Details
        <small>View organizational details for this case study category</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Category Overview</h3>
                <a href="<?= base_url('admin/case_categories') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th width="200">Category ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $category['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Category Name</th>
                        <td><strong><?= $category['name'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>URL Slug</th>
                        <td><code><?= $category['slug'] ?></code></td>
                    </tr>
                    <tr>
                        <th>Selection Status</th>
                        <td>
                            <?php if($category['is_active'] == 1): ?>
                                <span class="badge bg-success">Active</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/case_category_edit/'.$category['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Category</a>
            </div>
        </div>
    </div>
</div>
