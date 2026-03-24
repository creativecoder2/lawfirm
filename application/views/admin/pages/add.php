<div class="content-header">
    <h1>
        Add New Page
        <small>Create a new custom page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Page Details</h3>
                <a href="<?= base_url('admin/pages') ?>" class="btn btn-default btn-sm pull-right">Back to List</a>
            </div>
            
            <div class="box-body">
                <form action="<?= base_url('admin/page_add') ?>" method="post">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Page Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" required placeholder="e.g. Privacy Policy">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Custom Slug (Optional)</label>
                                <input type="text" name="slug" class="form-control" placeholder="e.g. privacy-policy">
                                <small class="text-muted">Leave empty to auto-generate from title.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Page Content</label>
                        <textarea name="content" class="form-control" id="editor" rows="20"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Show in Header</label>
                                <select name="show_in_header" class="form-control">
                                    <option value="0">Hide</option>
                                    <option value="1">Show</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Show in Footer</label>
                                <select name="show_in_footer" class="form-control">
                                    <option value="0">Hide</option>
                                    <option value="1">Show</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Accessibility</label>
                                <select name="is_active" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Create Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
