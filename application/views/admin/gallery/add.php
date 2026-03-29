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
                                <input type="file" name="video" id="video_input" class="form-control" required>
                                <p class="help-block">Allowed: mp4, webm, ogg. Max size: 50MB.</p>
                                <div id="preview_container" style="display:none; background:#000; padding:10px; border-radius:5px; text-center">
                                    <video id="video_preview" width="250" controls style="border-radius:5px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);"></video>
                                    <br>
                                    <button type="button" id="capture_thumb" class="btn btn-sm btn-info mt-2">
                                        <i class="fa fa-camera"></i> Capture First Frame as Thumbnail
                                    </button>
                                    <div id="capture_status" class="mt-1 small text-info"></div>
                                </div>
                            </div>
                            <canvas id="thumb_canvas" style="display:none;"></canvas>
                            <input type="hidden" name="captured_thumb" id="captured_thumb_input">
                            <div class="form-group">
                                <label>Video Thumbnail (Optional Manually)</label>
                                <input type="file" name="thumbnail" class="form-control">
                                <p class="help-block">Leave blank to use captured frame or site logo.</p>
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

<script>
document.getElementById('video_input').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const url = URL.createObjectURL(file);
        const video = document.getElementById('video_preview');
        const container = document.getElementById('preview_container');
        video.src = url;
        video.load();
        container.style.display = 'block';
        document.getElementById('capture_status').innerText = 'Video loaded. Move to any frame and click Capture.';
    }
});

document.getElementById('capture_thumb').addEventListener('click', function() {
    const video = document.getElementById('video_preview');
    const canvas = document.getElementById('thumb_canvas');
    const input = document.getElementById('captured_thumb_input');
    const status = document.getElementById('capture_status');

    if (video.readyState >= 2) {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        const dataURL = canvas.toDataURL('image/jpeg', 0.8);
        input.value = dataURL;
        status.innerHTML = '<i class="fa fa-check"></i> Frame captured! Will be saved on upload.';
        status.className = 'mt-1 small text-success';
        video.style.border = '2px solid #00c0ef';
        setTimeout(() => video.style.border = 'none', 300);
    } else {
        status.innerText = 'Video not ready. Wait a moment.';
    }
});
</script>
