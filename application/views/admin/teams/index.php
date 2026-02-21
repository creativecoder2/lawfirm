<div class="content-header">
    <h1>
        Team Members
        <small>Manage law firm partners and associates</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Team List</h3>
                <a href="<?= base_url('admin/team_add') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Team Member</a>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger m-4"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <table class="table table-striped table-hover table-datatable" data-table="teams">
                    <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th width="80">Image</th>
                        <th>Member Info</th>
                        <th>Social Profiles</th>
                        <th width="120">Status</th>
                        <th width="180">Actions</th>
                        <th style="display:none;" class="priority-col">Priority</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($teams as $team): ?>
                    <tr data-id="<?= $team['id'] ?>" data-priority="<?= isset($team['priority']) ? $team['priority'] : 0 ?>">
                        <td><?= $team['id'] ?></td>
                        <td>
                            <img src="<?= base_url($team['image']) ?>" class="img-thumbnail rounded" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>
                            <div class="font-weight-bold"><?= $team['name'] ?></div>
                            <small class="text-muted"><?= $team['designation'] ?></small>
                        </td>
                        <td>
                            <div class="d-flex gap-2" style="font-size: 16px; color: #64748b;">
                                <?php if($team['facebook']): ?><i class="fa fa-facebook-square" title="Facebook"></i> <?php endif; ?>
                                <?php if($team['twitter']): ?><i class="fa fa-twitter-square" title="Twitter"></i> <?php endif; ?>
                                <?php if($team['linkedin']): ?><i class="fa fa-linkedin-square" title="LinkedIn"></i> <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <?php if($team['is_active'] == 1): ?>
                                <a href="<?= base_url('admin/team_status/'.$team['id'].'/0') ?>" class="btn btn-success btn-sm">Active</a>
                            <?php else: ?>
                                <a href="<?= base_url('admin/team_status/'.$team['id'].'/1') ?>" class="btn btn-danger btn-sm">Inactive</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('admin/team_view/'.$team['id']) ?>" class="btn btn-info btn-sm" title="View"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('admin/team_edit/'.$team['id']) ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="<?= base_url('admin/team_delete/'.$team['id']) ?>" class="btn btn-danger btn-sm delete-confirm" title="Delete"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                        <td style="display:none;"><?= isset($team['priority']) ? $team['priority'] : 0 ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
