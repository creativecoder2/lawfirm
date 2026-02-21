<div class="content-header">
    <h1>
        Add About Feature
        <small>Create a new benefit item for the About page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Feature Details</h3>
            </div>
            <div class="box-body">
                <form action="<?= site_url('admin/about_feature_add') ?>" method="post">
                    <div class="form-group">
                        <label>Icon Class (e.g. fi flaticon-balance)</label>
                        <input type="text" name="icon" class="form-control" placeholder="fi flaticon-icon" required>
                        <small class="text-muted text-block">Browse icons at <a href="https://flaticon.com" target="_blank">Flaticon</a> or use font-awesome (e.g. fa fa-star)</small>
                    </div>
                    <div class="form-group">
                        <label>Subtitle (Top Text)</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="e.g. Get Free">
                    </div>
                    <div class="form-group">
                        <label>Title (Main Text)</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Expert Advice" required>
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <input type="number" name="priority" class="form-control" value="0">
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Feature</button>
                        <a href="<?= site_url('admin/about_features') ?>" class="btn btn-default">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
