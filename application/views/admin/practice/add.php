<div class="content-header">
    <h1>
        Add Practice Area
        <small>Define a new legal service area for the website</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area Details</h3>
                <a href="<?= base_url('admin/practice') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            
            <form action="<?= base_url('admin/practice_add') ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" placeholder="e.g. Criminal Law" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Slug (URL Identifier - Auto-generated if empty)</label>
                                <input type="text" class="form-control" name="slug" placeholder="e.g. criminal-law">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subtitle (Top Heading)</label>
                        <input type="text" class="form-control" name="subtitle" placeholder="e.g. Professional Legal Help">
                    </div>
                    <div class="form-group">
                        <label>Main Image (For the detail page)</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Short Summary (Rich Text)</label>
                        <textarea class="form-control editor" name="description" rows="3" required></textarea>
                        <small class="text-muted">Appears in the list and top of detail page.</small>
                    </div>
                    <div class="form-group">
                        <label>Services Included (Rich Text)</label>
                        <textarea class="form-control editor" name="services" rows="5"></textarea>
                        <small class="text-muted">Appears in the "Our Services Include" section.</small>
                    </div>
                    <div class="form-group">
                        <label>Consultation Fee (Rs.)</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="consultation_fee" placeholder="e.g. 5000 — leave 0 if free">
                        <small class="text-muted">This fee will be shown when a visitor selects this category in the appointment form.</small>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Practice Area</button>
                    <a href="<?= base_url('admin/practice') ?>" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
