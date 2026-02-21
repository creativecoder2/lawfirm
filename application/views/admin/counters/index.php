<div class="content-header">
    <h1>
        Counters
        <small>Showcase achievement metrics on the homepage</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Counter List</h3>
                <a href="<?= base_url('admin/counter_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Counter</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="counters">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="100">Icon</th>
                        <th>Counter Title</th>
                        <th>Target Value</th>
                        <th width="120">Status</th>
                        <th width="180">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($counters as $c): ?>
                    <tr data-id="<?= $c['id'] ?>" data-priority="<?= isset($c['priority']) ? $c['priority'] : 0 ?>">
                        <td><?= $c['id'] ?></td>
                        <td>
                            <div class="text-center p-2 rounded" style="background: #f8fafc; color: #d0a15e; font-size: 20px;">
                                <i class="<?= $c['icon'] ?>"></i>
                            </div>
                        </td>
                        <td>
                            <strong><?= $c['title'] ?></strong>
                        </td>
                        <td>
                            <span class="badge badge-info p-2" style="background: #e0f2fe; color: #0369a1; font-weight: 700; font-size: 14px;"><?= $c['count_value'] ?></span>
                        </td>
                        <td>
                            <?php if($c['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/counter_status/'.$c['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/counter_status/'.$c['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/counter_view/'.$c['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/counter_edit/'.$c['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/counter_delete/'.$c['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($c['priority']) ? $c['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
