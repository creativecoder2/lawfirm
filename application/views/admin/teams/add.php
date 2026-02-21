<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Team Member
            <small>Add new team member</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Team Member</h3>
                        <a href="<?= base_url('admin/teams') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?= form_open_multipart('admin/team_add') ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Slug (Optional - auto-generated if empty)</label>
                                        <input type="text" class="form-control" name="slug">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Designation</label>
                                        <input type="text" class="form-control" name="designation" required placeholder="e.g. Senior Partner">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input type="text" class="form-control" name="experience" placeholder="e.g. 10 Years">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" name="phone">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Education</label>
                                <textarea class="form-control" name="education" rows="2" placeholder="e.g. LL.B from XYZ University"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Languages</label>
                                <input type="text" class="form-control" name="languages" placeholder="e.g. English, French, Urdu">
                            </div>

                            <div class="form-group">
                                <label>Personal Bio (Rich Text)</label>
                                <textarea class="form-control editor" name="bio" rows="5"></textarea>
                            </div>
                            
                            <h4>Social Links</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Facebook URL</label>
                                        <input type="text" class="form-control" name="facebook">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Twitter URL</label>
                                        <input type="text" class="form-control" name="twitter">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>LinkedIn URL</label>
                                        <input type="text" class="form-control" name="linkedin">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Add Team Member</button>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
