<div class="content-header">
    <h1>
        Landmark Cases
        <small>Manage legal documents and historical case records</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Landmark List</h3>
                <a href="<?= base_url('admin/landmark_add') ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add Landmark</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger m-4"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-datatable" data-table="landmarks">
                        <thead>
                            <tr>
                                <th width="80">ID</th>
                                <th>Title</th>
                                <th>PDF File</th>
                                <th width="120">Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($landmarks)): foreach($landmarks as $row): ?>
                                <tr>
                                    <td>#<?= $row['id'] ?></td>
                                    <td class="font-weight-bold"><?= $row['title'] ?></td>
                                    <td>
                                        <a href="<?= base_url($row['pdf']) ?>" target="_blank" class="text-danger">
                                            <i class="fa fa-file-pdf-o"></i> View PDF
                                        </a>
                                    </td>
                                    <td>
                                        <?php if($row['is_active'] == 1): ?>
                                            <a href="<?= base_url('admin/landmark_status/'.$row['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('admin/landmark_status/'.$row['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= base_url('admin/landmark_edit/'.$row['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a href="<?= base_url('admin/landmark_delete/'.$row['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
