<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Team Member
            <small>Edit team member</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Team Member</h3>
                        <a href="<?= base_url('admin/teams') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>
                    <?= form_open_multipart('admin/team_edit/'.$team['id']) ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Current Image</label><br>
                                <img src="<?= base_url($team['image']) ?>" width="100"><br>
                                <label>Change Image (Leave empty to keep current)</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?= $team['name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" value="<?= $team['designation'] ?>" required>
                            </div>
                            
                            <h4>Social Links</h4>
                            <div class="form-group">
                                <label>Facebook URL</label>
                                <input type="text" class="form-control" name="facebook" value="<?= $team['facebook'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Twitter URL</label>
                                <input type="text" class="form-control" name="twitter" value="<?= $team['twitter'] ?>">
                            </div>
                            <div class="form-group">
                                <label>LinkedIn URL</label>
                                <input type="text" class="form-control" name="linkedin" value="<?= $team['linkedin'] ?>">
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Team Member</button>
                            <a href="<?= base_url('admin/teams') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
