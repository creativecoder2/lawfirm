<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Video
            <small>Update video details</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <form role="form" method="post" action="<?= site_url('admin/gallery_edit/'.$video['id']) ?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Video Title</label>
                                <input type="text" class="form-control" name="title" value="<?= $video['title'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description" rows="3"><?= $video['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Change Video File (Optional)</label>
                                <input type="file" name="video" class="form-control">
                                <p class="help-block">Leave blank if you don't want to change the video. Max: 50MB.</p>
                                <div class="mt-2">
                                    <video width="200" controls>
                                        <source src="<?= base_url($video['video_path']) ?>" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Change Thumbnail (Optional)</label>
                                <input type="file" name="thumbnail" class="form-control">
                                <p class="help-block">Leave blank to keep current thumbnail. Recommended: 1080x1920 JPG/PNG.</p>
                                <?php if(!empty($video['thumbnail'])): ?>
                                <div class="mt-2 text-center" style="background:#f0f0f0; padding:10px; border-radius:5px;">
                                    <img src="<?= base_url($video['thumbnail']) ?>" style="max-height: 150px; border-radius:10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                    <p class="small text-muted mt-2">Current Thumbnail</p>
                                </div>
                                <?php else: ?>
                                <div class="mt-2 text-center" style="background:#f0f0f0; padding:10px; border-radius:5px;">
                                    <p class="small text-muted">No custom thumbnail uploaded.</p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Priority</label>
                                <input type="number" class="form-control" name="priority" value="<?= $video['priority'] ?>">
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Update Video</button>
                            <a href="<?= site_url('admin/gallery') ?>" class="btn btn-default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
