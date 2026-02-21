<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Testimonial
            <small>Edit testimonial</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Testimonial</h3>
                        <a href="<?= base_url('admin/testimonials') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>
                    <?= form_open_multipart('admin/testimonial_edit/'.$testimonial['id']) ?>
                        <div class="box-body">
                           <div class="form-group">
                                <label>Current Image</label><br>
                                <img src="<?= base_url($testimonial['image']) ?>" width="100"><br>
                                <label>Change Image (Leave empty to keep current)</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?= $testimonial['name'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" name="designation" value="<?= $testimonial['designation'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea class="form-control editor" name="message" rows="5" required><?= $testimonial['message'] ?></textarea>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Testimonial</button>
                            <a href="<?= base_url('admin/testimonials') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
