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
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" required>
                            </div>
                            
                            <h4>Social Links</h4>
                            <div class="form-group">
                                <label>Facebook URL</label>
                                <input type="text" class="form-control" name="facebook">
                            </div>
                            <div class="form-group">
                                <label>Twitter URL</label>
                                <input type="text" class="form-control" name="twitter">
                            </div>
                            <div class="form-group">
                                <label>LinkedIn URL</label>
                                <input type="text" class="form-control" name="linkedin">
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
