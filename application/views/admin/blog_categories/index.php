<div class="box">
    <div class="box-header">
        <h3 class="box-title">Blog Categories</h3>
        <a href="<?= base_url('admin/blog_category_add') ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add New Category</a>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-datatable" data-table="blog_categories">
                <thead>
                    <tr>
                        <th width="50" class="text-center">ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th class="priority-col text-center" width="80">Priority</th>
                        <th class="text-center" width="100">Status</th>
                        <th class="text-center" width="120">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $cat): ?>
                    <tr data-id="<?= $cat['id'] ?>" data-priority="<?= $cat['priority'] ?>">
                        <td class="text-center"><?= $cat['id'] ?></td>
                        <td><strong><?= $cat['name'] ?></strong></td>
                        <td><code><?= $cat['slug'] ?></code></td>
                        <td class="text-center">
                            <span class="btn btn-default btn-xs" style="cursor: move;"><?= $cat['priority'] ?></span>
                        </td>
                        <td class="text-center">
                            <?php if($cat['is_active']): ?>
                                <a href="<?= base_url('admin/blog_category_status/'.$cat['id'].'/0') ?>" class="btn btn-success btn-xs">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/blog_category_status/'.$cat['id'].'/1') ?>" class="btn btn-danger btn-xs">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons justify-content-center">
                                <a href="<?= base_url('admin/blog_category_edit/'.$cat['id']) ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/blog_category_delete/'.$cat['id']) ?>" class="btn btn-danger btn-xs delete-confirm"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
