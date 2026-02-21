<div class="content-header">
    <h1>
        Sliders
        <small>Manage homepage sliders with drag-and-drop reordering</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Slider List</h3>
                <a href="<?= base_url('admin/slider_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Slider</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger m-4"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="sliders">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="150">Image</th>
                        <th>Title</th>
                        <th>Information</th>
                        <th width="150">Status</th>
                        <th width="200">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($sliders as $slider): ?>
                    <tr data-id="<?= $slider['id'] ?>" data-priority="<?= isset($slider['priority']) ? $slider['priority'] : 0 ?>">
                        <td><?= $slider['id'] ?></td>
                        <td>
                            <img src="<?= base_url($slider['image']) ?>" class="img-thumbnail" style="max-height: 60px;">
                        </td>
                        <td>
                            <strong><?= $slider['title'] ?></strong>
                        </td>
                        <td>
                            <span class="text-muted small"><?= $slider['subtitle'] ?></span>
                        </td>
                        <td>
                            <?php if($slider['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/slider_status/'.$slider['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/slider_status/'.$slider['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/slider_view/'.$slider['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/slider_edit/'.$slider['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/slider_delete/'.$slider['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($slider['priority']) ? $slider['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
