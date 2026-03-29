<div class="content-wrapper">
    <section class="content-header">
        <h1>Bulk Add Videos <small>Video Gallery</small></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= base_url('admin/gallery') ?>">Video Gallery</a></li>
            <li class="active">Bulk Add</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Step 1: Select Videos</h3>
            </div>
            
            <div class="box-body">
                <div id="upload-step-1">
                    <div class="well text-center" style="border: 2px dashed #ddd; cursor: pointer;" onclick="document.getElementById('video-selector').click()">
                        <i class="fa fa-cloud-upload fa-3x text-muted"></i>
                        <h4>Click to select multiple videos (.mp4, .webm)</h4>
                        <input type="file" id="video-selector" multiple accept="video/mp4,video/webm" style="display:none;">
                    </div>
                </div>

                <form action="<?= base_url('admin/gallery_bulk_add') ?>" method="POST" enctype="multipart/form-data" id="bulk-form" style="display:none;">
                    <div id="video-list-container">
                        <!-- Dynamic rows will be here -->
                    </div>
                    
                    <div class="box-footer">
                        <button type="submit" name="submit" value="1" class="btn btn-primary pull-right btn-lg">
                            <i class="fa fa-save"></i> Save All Videos
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
document.getElementById('video-selector').addEventListener('change', function(e) {
    const files = e.target.files;
    if (files.length === 0) return;

    const container = document.getElementById('video-list-container');
    const form = document.getElementById('bulk-form');
    const step1 = document.getElementById('upload-step-1');
    
    container.innerHTML = ''; // Clear previous
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const row = document.createElement('div');
        row.className = 'video-item pb-4 mb-4';
        row.style = "border-bottom: 1px solid #eee; padding-bottom: 20px;";
        
        // Generate unique names for each input to handle in controller
        // Note: PHP needs specific indexing for multiple files if sent alongside other arrays
        // We will use a DataTransfer object or just keep them in the input
        
        row.innerHTML = `
            <div class="row">
                <div class="col-md-2 text-center">
                    <div style="background:#f4f4f4; height:100px; display:flex; align-items:center; justify-content:center; border-radius:8px;">
                        <i class="fa fa-file-video-o fa-2x text-muted"></i>
                    </div>
                    <small class="text-muted text-truncate d-block mt-2">${file.name}</small>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title[]" class="form-control" value="${file.name.split('.').slice(0, -1).join('.')}" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description[]" class="form-control" rows="2" placeholder="Video description..."></textarea>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Priority</label>
                        <input type="number" name="priority[]" class="form-control" value="0">
                    </div>
                </div>
            </div>
        `;
        container.appendChild(row);
    }
    
    // Move the actual files to hidden inputs inside the form
    // Since we can't easily programmatically set FileList on a single input,
    // we use the original input but move it into the form
    form.appendChild(this); // Move the file input into the form
    this.name = 'video[]'; // Ensure it has the correct name for PHP array handling
    
    step1.style.display = 'none';
    form.style.display = 'block';
});
</script>
