<div class="content-header">
    <h1>
        Testimonials
        <small>Manage client feedback and success stories</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Testimonial List</h3>
                <a href="<?= base_url('admin/testimonial_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Testimonial</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger m-4"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="testimonials">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="80">Image</th>
                        <th>Client Info</th>
                        <th>Feedback</th>
                        <th width="120">Status</th>
                        <th width="180">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($testimonials as $testimonial): ?>
                    <tr data-id="<?= $testimonial['id'] ?>" data-priority="<?= isset($testimonial['priority']) ? $testimonial['priority'] : 0 ?>">
                        <td><?= $testimonial['id'] ?></td>
                        <td>
                            <img src="<?= base_url($testimonial['image']) ?>" class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="font-weight-bold"><?= $testimonial['name'] ?></div>
                            <small class="text-muted"><?= $testimonial['designation'] ?></small>
                        </td>
                        <td>
                            <span class="text-muted small"><?= strlen($testimonial['message']) > 120 ? substr($testimonial['message'], 0, 120).'...' : $testimonial['message'] ?></span>
                        </td>
                        <td>
                            <?php if($testimonial['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/testimonial_status/'.$testimonial['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/testimonial_status/'.$testimonial['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/testimonial_view/'.$testimonial['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/testimonial_edit/'.$testimonial['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/testimonial_delete/'.$testimonial['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($testimonial['priority']) ? $testimonial['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
