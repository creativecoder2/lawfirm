<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Slider
            <small>Edit homepage slider</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Slider</h3>
                        <a href="<?= base_url('admin/sliders') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>
                    <?= form_open_multipart('admin/slider_edit/'.$slider['id']) ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Current Image</label><br>
                                <img src="<?= base_url($slider['image']) ?>" width="150"><br>
                                <label>Change Image (Leave empty to keep current)</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $slider['title'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Subtitle / Description</label>
                                <textarea class="form-control editor" name="subtitle" rows="5" required><?= $slider['subtitle'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Button Text</label>
                                <input type="text" class="form-control" name="button_text" value="<?= $slider['button_text'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Button Link</label>
                                <input type="text" class="form-control" name="button_link" value="<?= $slider['button_link'] ?>">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Slider</button>
                            <a href="<?= base_url('admin/sliders') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
