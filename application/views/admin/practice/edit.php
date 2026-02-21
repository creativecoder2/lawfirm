<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Practice Area
            <small>Edit practice area</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Practice Area</h3>
                        <a href="<?= base_url('admin/practice') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <?= form_open('admin/practice_edit/'.$practice['id']) ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Icon Class (e.g., fi flaticon-mafia)</label>
                                <input type="text" class="form-control" name="icon" value="<?= $practice['icon'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $practice['title'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control editor" name="description" rows="5" required><?= $practice['description'] ?></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Practice Area</button>
                            <a href="<?= base_url('admin/practice') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
