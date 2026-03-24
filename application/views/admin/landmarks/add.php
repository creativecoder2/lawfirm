<div class="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 style="display: inline-block;">Add Landmark Case</h4>
                    <a href="<?= base_url('admin/landmarks') ?>" class="btn btn-default pull-right btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 20px;">
                        <li role="presentation" class="active"><a href="#single" aria-controls="single" role="tab" data-toggle="tab">Single Upload</a></li>
                        <li role="presentation"><a href="#bulk" aria-controls="bulk" role="tab" data-toggle="tab">Bulk Upload</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Single Upload Pane -->
                        <div role="tabpanel" class="tab-pane active" id="single">
                            <form action="<?= base_url('admin/landmark_add') ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Enter landmark title">
                                </div>
                                <div class="form-group">
                                    <label>PDF File</label>
                                    <input type="file" name="pdf" class="form-control" required accept=".pdf">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="is_active" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Landmark</button>
                            </form>
                        </div>

                        <!-- Bulk Upload Pane -->
                        <div role="tabpanel" class="tab-pane" id="bulk">
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> After selecting files, you can edit their titles below.
                            </div>
                            <form action="<?= base_url('admin/landmark_bulk_add') ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Select Multiple PDF Files</label>
                                    <input type="file" id="bulk-pdfs" name="pdfs[]" class="form-control" multiple accept=".pdf" required>
                                    <p class="help-block">You can select multiple files at once.</p>
                                </div>
                                
                                <div id="bulk-preview" style="margin-top: 20px; display: none;">
                                    <h5>Review Titles</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Filename</th>
                                                <th>Title for Website</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bulk-list"></tbody>
                                    </table>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Start Bulk Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('bulk-pdfs').addEventListener('change', function() {
    const list = document.getElementById('bulk-list');
    const preview = document.getElementById('bulk-preview');
    list.innerHTML = '';
    
    if (this.files.length > 0) {
        preview.style.display = 'block';
        Array.from(this.files).forEach((file, index) => {
            const fileName = file.name;
            const cleanTitle = fileName.replace(/\.[^/.]+$/, "").replace(/[_-]/g, " ");
            
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td><small>${fileName}</small></td>
                <td>
                    <input type="text" name="titles[]" class="form-control input-sm" value="${cleanTitle}" required>
                </td>
            `;
            list.appendChild(tr);
        });
    } else {
        preview.style.display = 'none';
    }
});
</script>
