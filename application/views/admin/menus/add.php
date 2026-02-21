<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Menu Item</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= site_url('admin/menus') ?>" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('admin/menu_add') ?>" method="post">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required placeholder="e.g. Home, Services">
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input type="text" name="link" class="form-control" placeholder="e.g. about or leave empty for Home">
                            <small class="text-muted">Use relative paths (e.g. contact) or absolute URLs.</small>
                        </div>
                        <div class="form-group">
                            <label>Priority</label>
                            <input type="number" name="priority" class="form-control" value="0">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
