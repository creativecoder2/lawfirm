<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Management</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= site_url('admin/menu_add') ?>" class="btn btn-primary">Add New Menu</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped datatable-reorder" data-update-url="<?= site_url('admin/update_order/menus') ?>">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th style="display:none;" class="priority-col">Priority</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menus as $menu): ?>
                                <tr data-id="<?= $menu['id'] ?>">
                                    <td><?= $menu['title'] ?></td>
                                    <td><?= $menu['link'] ?></td>
                                    <td>
                                        <span class="badge badge-<?= $menu['is_active'] ? 'success' : 'danger' ?>">
                                            <?= $menu['is_active'] ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td><?= $menu['priority'] ?></td>
                                    <td>
                                        <a href="<?= site_url('admin/menu_edit/' . $menu['id']) ?>" class="btn btn-sm btn-info">Edit</a>
                                        <a href="<?= site_url('admin/menu_delete/' . $menu['id']) ?>" class="btn btn-sm btn-danger delete-confirm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
