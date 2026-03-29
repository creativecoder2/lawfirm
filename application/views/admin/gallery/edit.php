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
                                <input type="file" name="video" id="video_input" class="form-control">
                                <p class="help-block">Leave blank if you don't want to change the video. Max: 50MB.</p>
                                <div class="mt-2 text-center" style="background:#000; padding:15px; border-radius:8px; border: 2px dashed #444;">
                                    <!-- Cache Buster: v1.02 -->
                                    <button type="button" id="capture_thumb" class="btn btn-warning btn-block mb-3" style="font-weight:bold; color:#000;">
                                        <i class="fa fa-camera"></i> STEP 1: CLICK TO CAPTURE PREVIEW
                                    </button>
                                    <video id="video_preview" width="100%" controls style="border-radius:5px; max-width:350px;">
                                        <source src="<?= base_url($video['video_path']) ?>" type="video/mp4">
                                    </video>
                                    <div id="capture_status" class="mt-2 small text-warning" style="font-weight:bold;"></div>
                                </div>
                            </div>
                            <canvas id="thumb_canvas" style="display:none;"></canvas>
                            <input type="hidden" name="captured_thumb" id="captured_thumb_input">
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

<script>
document.getElementById('capture_thumb').addEventListener('click', function() {
    const video = document.getElementById('video_preview');
    const canvas = document.getElementById('thumb_canvas');
    const input = document.getElementById('captured_thumb_input');
    const status = document.getElementById('capture_status');

    if (video.readyState >= 2) {
        // Set canvas dimensions to match video
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        // Draw the current frame
        const ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        // Convert to base64
        const dataURL = canvas.toDataURL('image/jpeg', 0.8);
        input.value = dataURL;
        
        status.innerHTML = '<div class="alert alert-success" style="margin-top:10px;"><i class="fa fa-check"></i> PREVIEW CAPTURED! Now click "Update Video" below to save.</div>';
        
        // Visual feedback (border flash)
        video.style.border = '2px solid #00c0ef';
        setTimeout(() => video.style.border = 'none', 300);
    } else {
        status.innerText = 'Video not ready. Play it for a second first.';
    }
});

// Also handle local file preview if a new video is selected
document.getElementById('video_input').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const url = URL.createObjectURL(file);
        const video = document.getElementById('video_preview');
        video.src = url;
        video.load();
        document.getElementById('capture_status').innerText = 'New video loaded. Move to any frame and click Capture.';
    }
});
</script>
