<div class="content-header">
    <h1>
        About Us Features
        <small>Manage the benefit items on the About page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Features List</h3>
                <a href="<?= site_url('admin/about_feature_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New Feature</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="about_features">
                    <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Icon</th>
                            <th>Subtitle (Top Text)</th>
                            <th>Title (Main Text)</th>
                            <th width="100">Priority</th>
                            <th width="150">Actions</th>
                            <th style="display:none;" class="priority-col">Priority</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($features as $f): ?>
                        <tr data-id="<?= $f['id'] ?>" data-priority="<?= $f['priority'] ?>">
                            <td><?= $f['id'] ?></td>
                            <td><i class="<?= $f['icon'] ?> fa-2x text-primary"></i> <br><small><?= $f['icon'] ?></small></td>
                            <td><?= $f['subtitle'] ?></td>
                            <td><strong><?= $f['title'] ?></strong></td>
                            <td><?= $f['priority'] ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= site_url('admin/about_feature_edit/'.$f['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="<?= site_url('admin/about_feature_delete/'.$f['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                                </div>
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
