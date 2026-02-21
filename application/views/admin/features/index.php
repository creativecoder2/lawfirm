<div class="content-header">
    <h1>
        Features
        <small>Manage homepage features with icons and professional typography</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Feature List</h3>
                <a href="<?= base_url('admin/feature_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Feature</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="features">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="100">Icon</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th width="150">Status</th>
                        <th width="200">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($features as $feature): ?>
                    <tr data-id="<?= $feature['id'] ?>" data-priority="<?= isset($feature['priority']) ? $feature['priority'] : 0 ?>">
                        <td><?= $feature['id'] ?></td>
                        <td>
                            <div class="text-center p-2 rounded" style="background: #f8fafc; color: #d0a15e; font-size: 20px;">
                                <i class="<?= $feature['icon'] ?>"></i>
                            </div>
                        </td>
                        <td>
                            <strong><?= $feature['title'] ?></strong>
                        </td>
                        <td>
                            <span class="text-muted small"><?= $feature['subtitle'] ?></span>
                        </td>
                        <td>
                            <?php if($feature['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/feature_status/'.$feature['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/feature_status/'.$feature['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/feature_view/'.$feature['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/feature_edit/'.$feature['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/feature_delete/'.$feature['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($feature['priority']) ? $feature['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
