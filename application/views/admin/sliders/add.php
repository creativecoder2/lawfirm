<div class="content-header">
    <h1>
        Add Slider
        <small>Create a new professional banner for the homepage</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Slider Information</h3>
                <a href="<?= base_url('admin/sliders') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            
            <?php if(isset($error)): ?>
                <div class="alert alert-danger m-4"><?= $error ?></div>
            <?php endif; ?>

            <?= form_open_multipart('admin/slider_add') ?>
                <div class="box-body p-4">
                    <div class="form-group mb-4">
                        <label class="form-label">Slider Image <span class="text-danger">*</span></label>
                        <div class="custom-file-upload border rounded p-3 text-center bg-light">
                            <input type="file" name="image" required class="mb-2">
                            <div class="small text-muted">Recommended size: 1920x800px (JPG/PNG)</div>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="form-label">Primary Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-lg" name="title" required placeholder="Enter headline text...">
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="form-label">Subtitle / Description <span class="text-danger">*</span></label>
                        <textarea class="form-control editor" name="subtitle" rows="5" required placeholder="Enter supporting text..."></textarea>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="button_text" placeholder="e.g. Read More">
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Button Link URL</label>
                        <input type="text" class="form-control" name="button_link" placeholder="https://example.com/page">
                    </div>
                </div>

                <div class="box-footer bg-light p-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Confirm & Add Slider</button>
                    <a href="<?= base_url('admin/sliders') ?>" class="btn btn-link text-muted">Cancel</a>
                </div>
            <?= form_close() ?>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Help & Tips</h3>
            </div>
            <div class="box-body">
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="fa fa-info-circle text-info"></i> <strong>High Quality:</strong> Use professional photography for the best impact.
                    </li>
                    <li class="mb-3">
                        <i class="fa fa-info-circle text-info"></i> <strong>Concise Titles:</strong> Keep titles under 50 characters.
                    </li>
                    <li>
                        <i class="fa fa-info-circle text-info"></i> <strong>Reordering:</strong> You can drag boxes in the list view to change their order.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
