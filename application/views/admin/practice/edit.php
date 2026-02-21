<div class="content-header">
    <h1>
        Edit Practice Area
        <small>Update details for legal service area</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editing Area: <?= $practice['title'] ?></h3>
                <a href="<?= base_url('admin/practice') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back to List</a>
            </div>
            
            <form action="<?= base_url('admin/practice_edit/'.$practice['id']) ?>" method="post" enctype="multipart/form-data">
                <?= form_open_multipart('admin/practice_edit/'.$practice['id']) ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $practice['title'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Slug (URL Identifier)</label>
                                <input type="text" class="form-control" name="slug" value="<?= $practice['slug'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subtitle (Top Heading)</label>
                        <input type="text" class="form-control" name="subtitle" value="<?= isset($practice['subtitle']) ? $practice['subtitle'] : '' ?>" placeholder="e.g. Professional Legal Help">
                    </div>
                    <div class="form-group">
                        <label>Main Image (For the detail page)</label>
                        <input type="file" name="image" class="form-control">
                        <?php if(!empty($practice['image'])): ?>
                            <div class="mt-2">
                                <img src="<?= base_url($practice['image']) ?>" alt="" style="max-width: 200px; border: 1px solid #ddd; padding: 5px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Short Summary (Rich Text)</label>
                        <textarea class="form-control editor" name="description" rows="3" required><?= $practice['description'] ?></textarea>
                        <small class="text-muted">Appears in the list and top of detail page.</small>
                    </div>
                    <div class="form-group">
                        <label>Services Included (Rich Text)</label>
                        <textarea class="form-control editor" name="services" rows="5"><?= isset($practice['services']) ? $practice['services'] : '' ?></textarea>
                        <small class="text-muted">Appears in the "Our Services Include" section.</small>
                    </div>
                    <div class="form-group">
                        <label>Consultation Fee (Rs.)</label>
                        <input type="number" step="0.01" min="0" class="form-control" name="consultation_fee" value="<?= isset($practice['consultation_fee']) ? $practice['consultation_fee'] : '0' ?>" placeholder="e.g. 5000 — leave 0 if free">
                        <small class="text-muted">This fee will be shown when a visitor selects this category in the appointment form.</small>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Practice Area</button>
                    <a href="<?= base_url('admin/practice') ?>" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
