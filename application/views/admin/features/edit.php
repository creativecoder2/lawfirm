<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Feature
            <small>Edit homepage feature</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Feature</h3>
                        <a href="<?= base_url('admin/features') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?= form_open('admin/feature_edit/'.$feature['id']) ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Icon Class (e.g., fi flaticon-employee)</label>
                                <input type="text" class="form-control" name="icon" value="<?= $feature['icon'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $feature['title'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Subtitle</label>
                                <input type="text" class="form-control" name="subtitle" value="<?= $feature['subtitle'] ?>" required>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Feature</button>
                            <a href="<?= base_url('admin/features') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
