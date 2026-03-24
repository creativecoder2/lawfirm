<div class="content-header">
    <h1>
        Edit Page
        <small>Modify existing custom page</small>
    </h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Page Details: <?= $page['title'] ?></h3>
                <a href="<?= base_url('admin/pages') ?>" class="btn btn-default btn-sm pull-right">Back to List</a>
            </div>
            
            <div class="box-body">
                <form action="<?= base_url('admin/page_edit/'.$page['id']) ?>" method="post">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Page Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="<?= $page['title'] ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Custom Slug (Optional)</label>
                                <input type="text" name="slug" class="form-control" value="<?= $page['slug'] ?>">
                                <small class="text-muted">Slug used in URL: <code>/page/<?= $page['slug'] ?></code></small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Page Content</label>
                        <textarea name="content" class="form-control" id="editor" rows="20"><?= $page['content'] ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Show in Header</label>
                                <select name="show_in_header" class="form-control">
                                    <option value="0" <?= !$page['show_in_header'] ? 'selected' : '' ?>>Hide</option>
                                    <option value="1" <?= $page['show_in_header'] ? 'selected' : '' ?>>Show</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Show in Footer</label>
                                <select name="show_in_footer" class="form-control">
                                    <option value="0" <?= !$page['show_in_footer'] ? 'selected' : '' ?>>Hide</option>
                                    <option value="1" <?= $page['show_in_footer'] ? 'selected' : '' ?>>Show</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Accessibility</label>
                                <select name="is_active" class="form-control">
                                    <option value="1" <?= $page['is_active'] ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= !$page['is_active'] ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update Page</button>
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
