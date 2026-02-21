<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Counter
            <small>Edit homepage counter</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Counter</h3>
                        <a href="<?= base_url('admin/counters') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?= form_open('admin/counter_edit/'.$counter['id']) ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Icon Class (e.g., fi flaticon-employee)</label>
                                <input type="text" class="form-control" name="icon" value="<?= $counter['icon'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $counter['title'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Count Value</label>
                                <input type="text" class="form-control" name="count_value" value="<?= $counter['count_value'] ?>" required>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Counter</button>
                            <a href="<?= base_url('admin/counters') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
