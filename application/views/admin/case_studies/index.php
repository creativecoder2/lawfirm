<div class="content-header">
    <h1>
        Case Studies
        <small>Showcase of our legal expertise and success stories</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Case Study List</h3>
                <a href="<?= base_url('admin/case_study_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Case Study</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger m-4"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="case_studies">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="120">Project Image</th>
                        <th>Case Information</th>
                        <th>Category</th>
                        <th width="120">Status</th>
                        <th width="180">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($case_studies as $cs): ?>
                    <tr data-id="<?= $cs['id'] ?>" data-priority="<?= isset($cs['priority']) ? $cs['priority'] : 0 ?>">
                        <td><?= $cs['id'] ?></td>
                        <td>
                            <img src="<?= base_url($cs['image']) ?>" class="img-thumbnail rounded" style="max-height: 60px;">
                        </td>
                        <td>
                            <div class="font-weight-bold"><?= $cs['title'] ?></div>
                            <small class="text-muted"><?= $cs['subtitle'] ?></small>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark p-2 border"><?= $cs['category_name'] ?></span>
                        </td>
                        <td>
                            <?php if($cs['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/case_study_status/'.$cs['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/case_study_status/'.$cs['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/case_study_view/'.$cs['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/case_study_edit/'.$cs['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/case_study_delete/'.$cs['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($cs['priority']) ? $cs['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
