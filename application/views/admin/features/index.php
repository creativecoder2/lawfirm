<div class="content-header">
    <h1>
        Home Action Cards
        <small>Manage the "Book Appointment", "Join Team", etc. cards on the Home page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Action Cards List</h3>
                <div class="box-tools">
                    <a href="<?= site_url('admin/feature_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Action Card</a>
                </div>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-bordered table-striped table-hover table-datatable" data-table="features">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th width="80">Icon</th>
                            <th>Title / Subtitle</th>
                            <th>Link</th>
                            <th width="80">Status</th>
                            <th width="100">Priority</th>
                            <th width="150">Actions</th>
                            <th style="display:none;" class="priority-col">Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($features as $f): ?>
                        <tr data-id="<?= $f['id'] ?>" data-priority="<?= $f['priority'] ?>">
                            <td><?= $f['id'] ?></td>
                            <td class="text-center">
                                <i class="<?= $f['icon'] ?> fa-2x text-primary"></i>
                                <br><small class="text-muted"><?= $f['icon'] ?></small>
                            </td>
                            <td>
                                <small class="text-uppercase text-muted"><?= $f['subtitle'] ?></small>
                                <h4 style="margin: 5px 0 0 0;"><strong><?= $f['title'] ?></strong></h4>
                            </td>
                            <td><code><?= $f['link'] ?></code></td>
                            <td>
                                <?php if($f['is_active']): ?>
                                    <a href="<?= site_url('admin/feature_status/'.$f['id'].'/0') ?>" class="btn btn-xs btn-success"><i class="fa fa-check"></i> Active</a>
                                <?php else: ?>
                                    <a href="<?= site_url('admin/feature_status/'.$f['id'].'/1') ?>" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> Inactive</a>
                                <?php endif; ?>
                            </td>
                            <td><?= $f['priority'] ?></td>
                            <td>
                                <a href="<?= site_url('admin/feature_edit/'.$f['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= site_url('admin/feature_delete/'.$f['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                            <td style="display:none;"><?= $f['priority'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
