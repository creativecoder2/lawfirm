<div class="content-header">
    <h1>
        Case Categories
        <small>Organize case studies into professional categories</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Category List</h3>
                <a href="<?= base_url('admin/case_category_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Category</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="case_categories">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Name</th>
                            <th>URL Slug</th>
                            <th width="150">Status</th>
                            <th width="200">Actions</th>
                            <th style="display:none;" class="priority-col">Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($categories)): foreach($categories as $cat): ?>
                        <tr data-id="<?= $cat['id'] ?>" data-priority="<?= isset($cat['priority']) ? $cat['priority'] : 0 ?>">
                            <td><?= $cat['id'] ?></td>
                            <td>
                                <strong><?= $cat['name'] ?></strong>
                            </td>
                            <td>
                                <code class="small"><?= $cat['slug'] ?></code>
                            </td>
                            <td>
                                <?php if($cat['is_active'] == 1): ?>
                                    <a href="<?= base_url('admin/case_category_status/'.$cat['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                                <?php else: ?>
                                    <a href="<?= base_url('admin/case_category_status/'.$cat['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('admin/case_category_view/'.$cat['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                    <a href="<?= base_url('admin/case_category_edit/'.$cat['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= base_url('admin/case_category_delete/'.$cat['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                            <td style="display:none;"><?= isset($cat['priority']) ? $cat['priority'] : 0 ?></td>
                        </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
