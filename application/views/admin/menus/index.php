<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Management</h1>
                </div>
               
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped table-datatable" data-table="menus">
                        <thead>
                            <tr>
                                <th width="50">ID</th>
                                <th>Title</th>
                                <th style="display:none;" class="priority-col">Priority</th>
                                <th>Header</th>
                                <th>Footer</th>
                                <th width="100">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($menus as $menu): ?>
                                <tr data-id="<?= $menu['id'] ?>">
                                    <td><?= $menu['id'] ?></td>
                                    <td><?= $menu['title'] ?></td>
                                    <td style="display:none;"><?= $menu['priority'] ?></td>
                                    <td>
                                        <?php if($menu['is_active'] == 1): ?>
                                            <a href="<?= site_url('admin/menu_status/' . $menu['id'] . '/0') ?>" class="btn btn-sm btn-success" title="Click to Disable in Header"><i class="fa fa-check-circle"></i> Enabled</a>
                                        <?php else: ?>
                                            <a href="<?= site_url('admin/menu_status/' . $menu['id'] . '/1') ?>" class="btn btn-sm btn-danger" title="Click to Enable in Header"><i class="fa fa-times-circle"></i> Disabled</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($menu['show_in_footer'] == 1): ?>
                                            <a href="<?= site_url('admin/menu_footer_status/' . $menu['id'] . '/0') ?>" class="btn btn-sm btn-success" title="Click to Hide from Footer"><i class="fa fa-toggle-on"></i> Show</a>
                                        <?php else: ?>
                                            <a href="<?= site_url('admin/menu_footer_status/' . $menu['id'] . '/1') ?>" class="btn btn-sm btn-outline-secondary" title="Click to Show in Footer"><i class="fa fa-toggle-off"></i> Hide</a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons text-center">
                                            <a href="<?= site_url('admin/menu_edit/' . $menu['id']) ?>" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                        </div>
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
