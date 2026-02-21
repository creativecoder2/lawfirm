<div class="content-header">
    <h1>
        Practice Areas
        <small>Manage law firm practice areas with custom icons</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Practice Areas List</h3>
                <a href="<?= base_url('admin/practice_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Area</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="practice_areas">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="100">Icon</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th width="150">Status</th>
                        <th width="200">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($practice as $p): ?>
                    <tr data-id="<?= $p['id'] ?>" data-priority="<?= isset($p['priority']) ? $p['priority'] : 0 ?>">
                        <td><?= $p['id'] ?></td>
                        <td>
                            <div class="text-center p-2 rounded" style="background: #f8fafc; color: #d0a15e; font-size: 20px;">
                                <i class="<?= $p['icon'] ?>"></i>
                            </div>
                        </td>
                        <td>
                            <strong><?= $p['title'] ?></strong>
                        </td>
                        <td>
                            <span class="text-muted small"><?= strlen($p['description']) > 100 ? substr($p['description'], 0, 100).'...' : $p['description'] ?></span>
                        </td>
                        <td>
                            <?php if($p['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/practice_status/'.$p['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/practice_status/'.$p['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/practice_view/'.$p['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/practice_edit/'.$p['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/practice_delete/'.$p['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($p['priority']) ? $p['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
