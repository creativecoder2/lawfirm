<div class="content-header">
    <h1>
        About Us Content
        <small>Update the main information on your About Us page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Editing About Us Information</h3>
            </div>
            
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success m-4"><?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="box-body">
                <form action="<?= site_url('admin/about_us') ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Main Title</label>
                                <input type="text" name="title" class="form-control" value="<?= $about['title'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Subtitle (Optional)</label>
                                <input type="text" name="subtitle" class="form-control" value="<?= $about['subtitle'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Video URL (YouTube Embed Link)</label>
                                <input type="text" name="video_url" class="form-control" value="<?= $about['video_url'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>About Image</label>
                                <input type="file" name="image" class="form-control">
                                <?php if($about['image']): ?>
                                    <div class="mt-2 text-center border p-2 bg-light">
                                        <img src="<?= base_url($about['image']) ?>" alt="" style="max-height: 120px;">
                                        <p class="mb-0 mt-1 small text-muted">Current Main Image</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Signature Image</label>
                                <input type="file" name="signature_image" class="form-control">
                                <?php if($about['signature_image']): ?>
                                    <div class="mt-2 text-center border p-2 bg-light">
                                        <img src="<?= base_url($about['signature_image']) ?>" alt="" style="max-height: 80px;">
                                        <p class="mb-0 mt-1 small text-muted">Current Signature</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control editor" rows="8" required><?= $about['description'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
