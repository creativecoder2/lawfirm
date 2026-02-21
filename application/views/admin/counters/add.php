<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Counter
            <small>Add homepage counter</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New Counter</h3>
                        <a href="<?= base_url('admin/counters') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?= form_open('admin/counter_add') ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Icon Class (e.g., fi flaticon-employee)</label>
                                <input type="text" class="form-control" name="icon" required>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="form-group">
                                <label>Count Value</label>
                                <input type="text" class="form-control" name="count_value" required>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Add Counter</button>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
