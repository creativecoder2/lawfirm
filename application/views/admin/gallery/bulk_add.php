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
                <h3 class="box-title">Upload Multiple Videos</h3>
            </div>
            <form action="<?= base_url('admin/gallery_bulk_add') ?>" method="POST" enctype="multipart/form-data">
                <div class="box-body" id="bulk-container">
                    <div class="video-item pb-3 mb-3" style="border-bottom: 2px solid #eee; padding-bottom: 20px;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Video File *</label>
                                    <input type="file" name="video[]" class="form-control" required accept="video/mp4,video/webm">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title[]" class="form-control" placeholder="Video Title">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description[]" class="form-control" rows="1" placeholder="Short description"></textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Priority</label>
                                    <input type="number" name="priority[]" class="form-control" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-default" id="add-more"><i class="fa fa-plus"></i> Add More Rows</button>
                    <button type="submit" name="submit" value="1" class="btn btn-primary pull-right">Upload All Videos</button>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
document.getElementById('add-more').addEventListener('click', function() {
    const container = document.getElementById('bulk-container');
    const newItem = container.children[0].cloneNode(true);
    // Clear inputs in cloned item
    newItem.querySelectorAll('input').forEach(input => {
        if(input.type !== 'number') input.value = '';
    });
    newItem.querySelectorAll('textarea').forEach(textarea => textarea.value = '');
    container.appendChild(newItem);
});
</script>
