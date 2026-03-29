<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Add Video
            <small>Upload a new video to the gallery</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <form role="form" method="post" action="<?= site_url('admin/gallery_add') ?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Video Title</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Enter description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Video File (Vertical/TikTok style recommended)</label>
                                <input type="file" name="video" class="form-control" required>
                                <p class="help-block">Allowed: mp4, webm, ogg. Max size: 50MB.</p>
                            </div>
                            <div class="form-group">
                                <label>Priority</label>
                                <input type="number" class="form-control" name="priority" value="0">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Upload Video</button>
                            <a href="<?= site_url('admin/gallery') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
