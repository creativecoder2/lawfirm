<div class="content-header">
    <h1>
        Team Member Details
        <small>View professional profile and contact details for this team member</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Member Profile</h3>
                <a href="<?= base_url('admin/teams') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            <div class="box-body no-padding">
                <table class="table detail-table">
                    <tr>
                        <th width="200">ID</th>
                        <td><span class="badge bg-light text-dark">#<?= $team['id'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Profile Image</th>
                        <td>
                            <img src="<?= base_url($team['image']) ?>" class="img-thumbnail rounded shadow-sm" style="max-width: 200px;">
                        </td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td><strong><?= $team['name'] ?></strong></td>
                    </tr>
                    <tr>
                        <th>Designation</th>
                        <td><span class="badge bg-info p-2" style="background: #e0f2fe; color: #0369a1;"><?= $team['designation'] ?></span></td>
                    </tr>
                    <tr>
                        <th>Social Profiles</th>
                        <td>
                            <div class="d-flex gap-3">
                                <?php if($team['facebook']): ?>
                                    <a href="<?= $team['facebook'] ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="Facebook"><i class="fa fa-facebook"></i></a>
                                <?php endif; ?>
                                <?php if($team['twitter']): ?>
                                    <a href="<?= $team['twitter'] ?>" target="_blank" class="btn btn-sm btn-outline-info" title="Twitter"><i class="fa fa-twitter"></i></a>
                                <?php endif; ?>
                                <?php if($team['linkedin']): ?>
                                    <a href="<?= $team['linkedin'] ?>" target="_blank" class="btn btn-sm btn-outline-primary" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                                <?php endif; ?>
                            </div>
                            <div class="mt-2 small text-muted">
                                <div><i class="fa fa-link"></i> FB: <?= $team['facebook'] ?: 'N/A' ?></div>
                                <div><i class="fa fa-link"></i> TW: <?= $team['twitter'] ?: 'N/A' ?></div>
                                <div><i class="fa fa-link"></i> LI: <?= $team['linkedin'] ?: 'N/A' ?></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Work Status</th>
                        <td>
                            <?php if($team['is_active'] == 1): ?>
                                <span class="badge bg-success">Active Member</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?= base_url('admin/team_edit/'.$team['id']) ?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit Member Profile</a>
            </div>
        </div>
    </div>
</div>
