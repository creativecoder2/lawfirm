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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="name" value="<?= $team['name'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Slug (Optional)</label>
                                        <input type="text" class="form-control" name="slug" value="<?= isset($team['slug']) ? $team['slug'] : '' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" name="designation" value="<?= $team['designation'] ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input type="text" class="form-control" name="experience" value="<?= isset($team['experience']) ? $team['experience'] : '' ?>" placeholder="e.g. 10 Years">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" name="email" value="<?= isset($team['email']) ? $team['email'] : '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone" value="<?= isset($team['phone']) ? $team['phone'] : '' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Education</label>
                                <textarea class="form-control" name="education" rows="2"><?= isset($team['education']) ? $team['education'] : '' ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Languages</label>
                                <input type="text" class="form-control" name="languages" value="<?= isset($team['languages']) ? $team['languages'] : '' ?>">
                            </div>

                            <div class="form-group">
                                <label>Personal Bio (Rich Text)</label>
                                <textarea class="form-control editor" name="bio" rows="5"><?= isset($team['bio']) ? $team['bio'] : '' ?></textarea>
                            </div>
                            
                            <h4>Social Links</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Facebook URL</label>
                                        <input type="text" class="form-control" name="facebook" value="<?= $team['facebook'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Twitter URL</label>
                                        <input type="text" class="form-control" name="twitter" value="<?= $team['twitter'] ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>LinkedIn URL</label>
                                        <input type="text" class="form-control" name="linkedin" value="<?= $team['linkedin'] ?>">
                                    </div>
                                </div>
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
