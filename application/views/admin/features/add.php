<div class="content-header">
    <h1>
        Add Action Card
        <small>Create a new card for the Home page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Card Details</h3>
            </div>
            <div class="box-body">
                <form action="<?= site_url('admin/feature_add') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Image (Required)</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                        <small class="text-muted">Upload a high-quality icon or image (PNG/SVG/JPG).</small>
                    </div>
                    <div class="form-group">
                        <label>Title (Main Text, e.g. "Book Appointment")</label>
                        <input type="text" name="title" class="form-control" placeholder="Book Appointment" required>
                    </div>
                    <div class="form-group">
                        <label>Target Link (Website URL)</label>
                        <input type="text" name="link" class="form-control" placeholder="e.g. #consultation-form or https://google.com" value="#">
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <input type="number" name="priority" class="form-control" value="0">
                    </div>
                    <div class="box-footer" style="padding-left:0;">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Action Card</button>
                        <a href="<?= site_url('admin/features') ?>" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
